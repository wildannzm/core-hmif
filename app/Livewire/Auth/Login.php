<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        try {
            $this->validate();

            $this->ensureIsNotRateLimited();

            if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                RateLimiter::hit($this->throttleKey());

                // Dispatch SweetAlert error for failed login
                $this->dispatch('swal:error', [
                    'title' => 'Login Gagal!',
                    'text' => 'Email atau kata sandi yang Anda masukkan salah, silakan coba lagi.',
                    'icon' => 'error'
                ]);

                return;
            }

            RateLimiter::clear($this->throttleKey());
            Session::regenerate();

            // Dispatch SweetAlert success for successful login
            $this->dispatch('swal:success', [
                'title' => 'Login Berhasil!',
                'text' => 'Selamat datang di HMIF UNMA.',
                'icon' => 'success'
            ]);

            // Small delay to show the success message before redirect
            $this->dispatch('redirect-after-success');

        } catch (ValidationException $e) {
            // Handle validation errors with SweetAlert
            $errors = collect($e->errors())->flatten();
            $errorMessage = $errors->first() ?: 'Terjadi kesalahan validasi.';
            
            $this->dispatch('swal:error', [
                'title' => 'Data Tidak Valid!',
                'text' => $errorMessage,
                'icon' => 'error'
            ]);

            throw $e;
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = ceil($seconds / 60);

        // Dispatch SweetAlert for rate limiting
        $this->dispatch('swal:error', [
            'title' => 'Terlalu Banyak Percobaan!',
            'text' => "Anda telah melakukan terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.",
            'icon' => 'warning'
        ]);

        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.",
        ]);
    }

    /**
     * Get custom validation messages in Indonesian
     */
    protected function messages(): array
    {
        return [
            'email.required' => 'Alamat email harus diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.string' => 'Alamat email harus berupa teks.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
        ];
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
