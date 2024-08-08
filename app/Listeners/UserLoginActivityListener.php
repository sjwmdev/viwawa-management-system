<?php

namespace App\Listeners;

use App\Models\UserLoginLogoutActivity;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class UserLoginActivityListener
{
    public function onUserLogin(Login $event)
    {
        $userActivity = new UserLoginLogoutActivity();
        $userActivity->user_id = $event->user->id;
        $userActivity->login_at = Carbon::now();
        $userActivity->is_active = true;
        $userActivity->save();
    }

    /**
     * Call the onUserLogin() method when a user logs in.
     *
     * @param \Illuminate\Auth\Events\Login $event
     * @return void
     */
    public function __invoke(Login $event)
    {
        $this->onUserLogin($event);
    }
}
