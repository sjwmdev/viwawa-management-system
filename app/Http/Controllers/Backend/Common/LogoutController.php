<?php

namespace App\Http\Controllers\Backend\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function perform()
    {
        try {
            Session::flush();
            Auth::logout();

            return redirect()->route('login.showLoginForm')->with('success', 'Umeondoka kwenye akaunti yako. Kwaheri 👋!');
        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->route('common.dashboard')->withErrors('Imeshindwa kutoka. Tafadhali jaribu tena.');
        }
    }
}
