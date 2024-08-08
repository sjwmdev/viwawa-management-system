<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Define the date range for the current year
            $currentYear = Carbon::now()->year;
            $currentMonthName = Carbon::now()->format('F'); // Full month name

            // Fetch contributions for display on the calendar
            $monthlyContributions = DB::table('contributions')
                ->selectRaw('DATE_FORMAT(date, "%Y-%m") as month, SUM(paid_amount) as total_amount, COUNT(DISTINCT member_id) as member_count')
                ->whereYear('date', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            return view('backend.admin.dashboard', [
                'currentMonthName' => $currentMonthName,
                'currentYear' => $currentYear,
                'monthlyContributions' => $monthlyContributions,
            ]);
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error loading admin dashboard data: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupakia data za dashibodi.');
        }
    }
}
