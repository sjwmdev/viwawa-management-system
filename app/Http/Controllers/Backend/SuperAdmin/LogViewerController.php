<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LogViewerController extends Controller
{
    public function index()
    {
        $logFile = storage_path('logs/laravel.log');
        $logs = [];

        if (File::exists($logFile)) {
            $logContent = File::get($logFile);
            $logs = $this->parseLogs($logContent);
        }

        return view('backend.superadmin.systemlogs.log-viewer', compact('logs'));
    }

    public function filter(Request $request)
    {
        $logFile = storage_path('logs/laravel.log');
        $logs = [];
        $level = strtoupper($request->input('level'));

        if (File::exists($logFile)) {
            $logContent = File::get($logFile);
            $allLogs = $this->parseLogs($logContent);

            if ($level) {
                $logs = array_filter($allLogs, function ($log) use ($level) {
                    return strpos($log['level'], $level) !== false;
                });
            } else {
                $logs = $allLogs;
            }
        }

        return view('backend.superadmin.systemlogs.log-viewer', compact('logs'));
    }


    private function parseLogs($logContent)
    {
        $logEntries = explode("\n", $logContent);
        $logs = [];

        foreach ($logEntries as $entry) {
            if (preg_match('/\[(.*?)\]\s(\w+)\.(.*?): (.*)/', $entry, $matches)) {
                $logs[] = [
                    'date' => $matches[1],
                    'level' => strtoupper($matches[2]),
                    'context' => $matches[3],
                    'message' => $matches[4],
                ];
            }
        }

        return array_reverse($logs); // Reverse to show latest logs first
    }

    /**
     * Delete all logs in the laravel.log file.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLogs()
    {
        try {
            $logFile = storage_path('logs/laravel.log');

            if (File::exists($logFile)) {
                File::put($logFile, ''); // Clear the log file
                Log::info('All logs have been deleted by user ID: ' . auth()->id());
            }

            return redirect()->route('superadmin.system.logs.index')->with('success', 'All logs have been deleted.');
        } catch (\Throwable $e) {
            Log::error('Error occurred in LogViewerController@deleteLogs: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->route('superadmin.system.logs.index')->withErrors(['error' => 'Error occurred while deleting logs: ' . $e->getMessage()]);
        }
    }
}
