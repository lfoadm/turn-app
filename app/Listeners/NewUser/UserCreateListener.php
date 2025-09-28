<?php

namespace App\Listeners\NewUser;

use App\Events\NewUser\UserCreateEvent;
use App\Mail\NewUser\UserCreateMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserCreateListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreateEvent $event): void
    {
        sleep(3);
        Mail::to($event->user->email)->send(new UserCreateMail($event->user, $event->temporaryPassword));
    }
}
