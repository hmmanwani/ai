<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mpdf\Mpdf;

class PDFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->singleton(Mpdf::class, function ($app) {
        //     return new Mpdf();
        // });
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
