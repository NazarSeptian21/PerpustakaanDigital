<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// TAMBAHAN IMPORT
use App\Models\Peminjaman;
use App\Models\Review;
use App\Observers\ActivityObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // DAFTARKAN OBSERVER
        Peminjaman::observe(ActivityObserver::class);
        Review::observe(ActivityObserver::class);
    }
}
