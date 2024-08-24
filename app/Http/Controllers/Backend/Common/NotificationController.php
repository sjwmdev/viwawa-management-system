<?php

namespace App\Http\Controllers\Backend\Common;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $notifications = Notification::where('auth_id', auth()->id())
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('backend.common.notifications.index', compact('notifications'));
        } catch (\Throwable $e) {
            Log::error('Error occurred in NotificationController@index: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Error occurred while fetching notifications: ' . $e->getMessage()]);
        }
    }

    /**
     * Get unread notifications for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadNotifications()
    {
        try {
            $notifications = Notification::where('auth_id', auth()->id())
                ->whereNull('read_at')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($notifications);
        } catch (\Throwable $e) {
            Log::error('Error occurred in NotificationController@getUnreadNotifications: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * Mark the specified notification as read.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Notification $notification)
    {
        try {
            $notification->markAsRead();

            return response()->json(['success' => true, 'message' => 'Arifa imetiwa alama kuwa imesomwa.']);
        } catch (\Throwable $e) {
            Log::error('Error occurred in NotificationController@markAsRead: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * Clear all notifications for the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAll(Request $request)
    {
        try {
            Notification::where('auth_id', auth()->id())->delete();

            return response()->json(['success' => true, 'message' => 'Arifa zote zimeondolewa.']);
        } catch (\Throwable $e) {
            Log::error('Error occurred in NotificationController@clearAll: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['success' => false, 'message' => 'Kuna tatizo limejitokeza: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified notification by marking it as deleted.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeNotification(Notification $notification)
    {
        try {
            $notification->update(['deleted_at' => now()]);

            return response()->json(['success' => true, 'message' => 'Arifa imeondolewa.']);
        } catch (\Throwable $e) {
            Log::error('Error occurred in NotificationController@removeNotification: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }
}
