<?php

namespace App\Providers;

use App\Models\Checkbox;
use App\Models\Input;
use App\Models\Radio;
use App\Models\Select;
use App\Observers\CheckboxObserver;
use App\Observers\InputObserver;
use App\Observers\RadioObserver;
use App\Observers\SelectObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Input::observe(InputObserver::class);
        Checkbox::observe(CheckboxObserver::class);
        Select::observe(SelectObserver::class);
        Radio::observe(RadioObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
