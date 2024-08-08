<?php

namespace App\Http\Controllers\Backend\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as LaravelLog;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on the user role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::find(Auth::id());
            if (!$user) {
                return redirect()->route('login')->withErrors('Mtumiaji si halali. Tafadhali ingia tena.');
            }

            $roles = $user->roles()->pluck('name');

            if ($roles->isEmpty()) {
                return view('backend.dashboard.default');
            }

            $role = $roles->first();

            switch ($role) {
                case 'superadmin':
                    return app(\App\Http\Controllers\Backend\SuperAdmin\DashboardController::class)->index();
                case 'admin':
                    return app(\App\Http\Controllers\Backend\Admin\DashboardController::class)->index();
                case 'viwawa':
                    return redirect()->route('viwawa.dashboard')->with('success', 'Karibu kwenye dashboard ya Viwawa.');
                default:
                    return redirect()->route('guest.dashboard')->with('success', 'Karibu kwenye dashboard ya Wageni.');
            }
        } catch (\Exception $e) {
            LaravelLog::error('Error loading common dashboard: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->withErrors('Imeshindikana kupakia dashibodi. Tafadhali jaribu tena.');
        }
    }
}
