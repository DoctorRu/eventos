<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to all events attendees that event starts soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = \App\Models\Event::with('attendees.user')
        ->whereBetween('start_time', [now(), now()->addDay()])
        ->get();

        $eventsCount = $events->count();
        $eventLabel = Str::plural('event', $eventsCount);

        $this->info("Found {$eventsCount} {$eventLabel} events.");

        $events->each(
            fn($event) => $event->attendees->each(
                fn($attendee) => $this->info("Notifying the user {$attendee->user->id}")
            )
        );

        $this->info('Reminders sent.');
    }
}
