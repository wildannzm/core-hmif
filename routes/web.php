<?php

use App\Livewire\Letter;
use App\Livewire\Finance;
use App\Livewire\Members;
use App\Livewire\Dashboard;
use App\Livewire\Main\Home;
use App\Livewire\Schedules;
use App\Livewire\Departments;
use App\Livewire\ContentPlans;
use App\Livewire\Main\Community;
use App\Livewire\Main\Structure;
use App\Livewire\Tix\Admin\Event;
use App\Livewire\AttendanceReport;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Tix\Admin\EventOrder;
use App\Livewire\Tix\Admin\EventDetail;
use App\Livewire\Tix\Admin\PaymentMethod;
use App\Livewire\Tix\Admin\EventAttendance;
use App\Livewire\Tix\Admin\EventCreateEdit;
use App\Livewire\Tix\User\TixHome;
use App\Livewire\Tix\User\DetailEvent;
use App\Livewire\Tix\User\CheckoutEvent;
use App\Livewire\Attendance\ScheduleAttendance;

Route::domain('internal.hmifunma.web.id')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    })->name('home');

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('departemen', Departments::class)->name('departments')->middleware('check.position:Ketua,Wakil Ketua');
        Route::get('anggota', Members::class)->name('members')->middleware('check.position:Ketua,Wakil Ketua');
        Route::get('jadwal', Schedules::class)->name('schedules');
        Route::get('absensi/{scheduleId}', ScheduleAttendance::class)->name('schedules.attendance');
        Route::get('absensi', AttendanceReport::class)->name('attendance')->middleware('check.position:Ketua,Wakil Ketua,Sekertaris');

        // Secretary routes - accessible by Ketua, Wakil Ketua, and Sekertaris
        Route::get('surat', Letter::class)->name('surat')
            ->middleware('check.position:Ketua,Wakil Ketua,Sekertaris');

        // Treasurer routes - accessible by Ketua, Wakil Ketua, and Bendahara
        Route::get('keuangan', Finance::class)->name('finance')
            ->middleware('check.position:Ketua,Wakil Ketua,Bendahara');

        // Kominfo routes - accessible by Ketua, Wakil Ketua, and all Kominfo department members
        Route::get('content-plan', ContentPlans::class)->name('content-plan')
            ->middleware('check.kominfo');

        // Tix Admin routes - accessible by Ketua, Wakil Ketua, and Tix Admin
        Route::prefix('events')->name('admin.events.')->group(function () {
            Route::get('/', Event::class)->name('index');
            Route::get('/create', EventCreateEdit::class)->name('create');
            Route::get('/{id}', EventDetail::class)->name('show');
            Route::get('/{id}/edit', EventCreateEdit::class)->name('edit');

            // Event-specific routes for orders and attendance
            Route::get('/orders/{eventId}', EventOrder::class)->name('orders');
            Route::get('/attendance/{eventId}', EventAttendance::class)->name('attendance');
        });
        Route::get('payment-methods', PaymentMethod::class)->name('admin.payment-methods')
            ->middleware('check.position:Ketua,Wakil Ketua,Bendahara');

        Route::redirect('pengaturan', 'pengaturan/profil');

        Route::get('pengaturan/profil', Profile::class)->name('settings.profile');
        Route::get('pengaturan/password', Password::class)->name('settings.password');
        Route::get('pengaturan/appearance', Appearance::class)->name('settings.appearance');
    });
});

Route::domain('tix.hmifunma.web.id')->group(function () {
    // User-facing TIX routes (Public)
    Route::get('/', TixHome::class)->name('tix.home');
    Route::get('/event/{slug}', DetailEvent::class)->name('tix.event.detail');
    Route::get('/checkout/{slug}', CheckoutEvent::class)->name('tix.event.checkout');
});


Route::domain('hmifunma.web.id')->group(function () {
    Route::get('/', Home::class)->name('main.home');
    Route::get('/struktural', Structure::class)->name('main.structure');
    Route::get('/komunitas', Community::class)->name('main.community');
    
    // Sitemap for SEO
    Route::get('/sitemap.xml', function () {
        $urls = [
            [
                'loc' => 'https://hmifunma.web.id/',
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'loc' => 'https://hmifunma.web.id/struktural',
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => 'https://hmifunma.web.id/komunitas',
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url['loc'] . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }
        
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    })->name('sitemap');
});

require __DIR__.'/auth.php';
