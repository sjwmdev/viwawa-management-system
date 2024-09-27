<?php

namespace App\Http\Controllers\Frontend\Viwawa;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\ContributionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonthlyContributionController extends Controller
{

    /**
     * Display a listing of the member monthly contributions.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            // Get the selected year, month, and search query from the request
            $year = $request->get('year', now()->year);
            $month = $request->get('month', null);

            // Get the contribution type for "mwezi" (monthly contribution)
            $monthlyContributionType = ContributionType::where('identifier', 'mwezi')->firstOrFail();

            // Fetch contributions by member for the selected year and optionally by month
            $contributions = Contribution::where('contribution_type_id', $monthlyContributionType->id)
                ->whereYear('date', $year)
                ->when($month, function ($query, $month) {
                    return $query->whereMonth('date', $month);
                })
                ->with('member.user')
                ->get()
                ->groupBy('member.user.full_name')
                ->map(function ($memberContributions) {
                    // Map contributions by month
                    $monthlyContributions = [];
                    foreach ($memberContributions as $contribution) {
                        $monthlyContributions[$contribution->date->format('m')] = $contribution->paid_amount;
                    }
                    return $monthlyContributions;
                });

            return view('frontend.viwawa.contributions.monthly.index', compact('contributions', 'year', 'month'));
        } catch (\Exception $e) {
            Log::error('Error displaying frontend viwawa monthly contributions: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);

            return redirect()->back()->with('error', 'Imeshindwa kuonyesha taarifa za michango ya kila mwezi.');
        }
    }
}
