<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Password')]
#[Layout('components.layouts.app')]

class Password extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Confirm password update with SweetAlert
     */
    public function confirmPasswordUpdate(): void
    {
        // Dispatch SweetAlert confirmation
        $this->dispatch('swal:confirm-password-update');
    }

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', PasswordRule::defaults(), 'confirmed'],
            ]);

            Auth::user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            $this->reset('current_password', 'password', 'password_confirmation');

            // Dispatch SweetAlert success notification
            $this->dispatch('swal:success', [
                'title' => 'Berhasil!',
                'text' => 'Kata sandi Anda berhasil diperbarui dengan aman.',
                'icon' => 'success'
            ]);

        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            
            // Get first error message
            $firstError = collect($e->errors())->flatten()->first();
            
            // Dispatch SweetAlert error notification
            $this->dispatch('swal:error', [
                'text' => $firstError ?: 'Kata sandi saat ini tidak valid atau kata sandi baru tidak memenuhi syarat keamanan.'
            ]);

            throw $e;
        } catch (\Exception $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            
            // Dispatch SweetAlert error notification for general errors
            $this->dispatch('swal:error', [
                'text' => 'Terjadi kesalahan tak terduga. Silakan coba lagi.'
            ]);

            throw $e;
        }
    }
}
