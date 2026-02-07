<?php

namespace App\Providers;

use App\Services\TicketService\TicketService;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TicketService::class, function ($app) {});
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
