<?php

namespace App\Listeners;

use App\Mail\SendPublishRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PublishVerifyListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {   
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user_email = [$event->user->email];
        $admin_emails = User::select('email')->where('admin', true)->get();
        Mail::to($user_email)->send(new SendPublishRequest)
    }
}
