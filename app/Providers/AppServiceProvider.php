<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\WorkshopOrder;
use App\Observers\WorkshopOrderObserver;

use App\Models\Notification;
use App\Observers\NotificationObserver;

use App\Models\TruckingOrder;
use App\Observers\SearchForTrucker;

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
        Notification::observe(NotificationObserver::class);
    }
}
