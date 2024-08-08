<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log as LogFacade;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with member count, logs, and notifications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Fetch and count total number of users registered.
            $usersCount = User::count();

            // Fetch and count total number of roles registered.
            $rolesCount = Role::count();

            // Filter for logs from the last 7 days
            $startDate = Carbon::now()->subDays(7);
            $endDate = Carbon::now();
            $totalLogs = Log::whereBetween('created_at', [$startDate, $endDate])->count();

            // Fetch all notifications for the authenticated user, excluding deleted ones
            $notifications = Notification::where('auth_id', auth()->id())
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc')
                ->get();

            // Count the number of unread notifications for the authenticated user
            $unreadNotifications = Notification::where('auth_id', auth()->id())
                ->whereNull('read_at')
                ->count();

            return view('backend.superadmin.dashboard', compact('usersCount', 'rolesCount', 'totalLogs', 'notifications', 'unreadNotifications'));
        } catch (\Exception $e) {
            // Log any exceptions that occur
            LogFacade::error('Error loading superadmin dashboard data: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupakia data za dashibodi.');
        }
    }
}
