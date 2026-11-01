<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Laporan;
use App\Observers\LaporanObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Laporan::observe(LaporanObserver::class);
    }
}