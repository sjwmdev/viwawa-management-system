<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\ModelCreated' => [
            'App\Listeners\ActivityLogListener',
        ],
        'App\Events\ModelUpdated' => [
            'App\Listeners\ActivityLogListener',
        ],
        'App\Events\ModelDeleted' => [
            'App\Listeners\ActivityLogListener',
        ],
        'App\Events\ModelRestored' => [
            'App\Listeners\ActivityLogListener',
        ],
        'App\Events\ModelForceDeleted' => [
            'App\Listeners\ActivityLogListener',
        ],
        \Illuminate\Auth\Events\Login::class => [
            'App\Listeners\UserLoginActivityListener',
        ],
        \Illuminate\Auth\Events\Logout::class => [
            'App\Listeners\UserLogoutActivityListener',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
