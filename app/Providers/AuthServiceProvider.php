<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-event', function ($user, Event $event) {
        });

        Gate::define('delete-event', function ($user, Event $event, Attendee $attendee) {

        });
    }
}
