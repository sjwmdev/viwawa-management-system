<?php

namespace App\Listeners;

use App\Models\UserLoginLogoutActivity;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;

class UserLogoutActivityListener
{

    public function onUserLogout(Logout $event)
    {
        $userActivity = UserLoginLogoutActivity::where('user_id', $event->user->id)
            ->orderBy('login_at', 'desc')
            ->first();

        if ($userActivity) {
            $userActivity->logout_at = Carbon::now();
            $userActivity->is_active = false;
            $userActivity->save();
        }
    }

    /**
     * Call the onUserLogout() method when a user logs out.
     *
     * @param \Illuminate\Auth\Events\Logout $event
     * @return void
     */
    public function __invoke(Logout $event)
    {
        $this->onUserLogout($event);
    }
}
