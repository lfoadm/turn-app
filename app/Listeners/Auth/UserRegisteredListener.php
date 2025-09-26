<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserRegisteredEvent;
use App\Mail\Auth\UserRegisteredMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserRegisteredListener implements ShouldQueue
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
    public function handle(UserRegisteredEvent $event): void
    {
        sleep(3);
        Mail::to($event->user->email)->send(new UserRegisteredMail($event->user));
    }
}
