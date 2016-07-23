<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNotification
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
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        // Mail::send();
        // $this->mailer->sendEmailNotification();
        \Mail::send('email.email_registered_notification',
            ['user' => $event->user], function ($message) use ($event) {
            $message->to($event->user->email, $event->user->name)->subject('Регистрация на '.
                config('app.site_domain'));
            // $message->to('bob@email.com', 'Bob')->from('local@jost.com')->subject('Привет!');
        });
        // var_dump('Notify '.$event->user->name.' send mail.');
    }
}
