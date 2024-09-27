<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ChurchContribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChurchContributionController extends Controller
{

    /**
     * Display a listing of the church contributions.
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
            $search = $request->get('search', '');

            // Fetch distinct family names and their contributions grouped by month
            $contributions = ChurchContribution::where('year', $year)
                ->when($month, function ($query, $month) {
                    return $query->where('month', $month); // Filter by month if specified
                })
                ->when($search, function ($query, $search) {
                    return $query->where('family_name', 'like', '%' . $search . '%'); // Filter by family name
                })
                ->get()
                ->groupBy('family_name')
                ->map(function ($familyContributions) {
                    // Map contributions by month for each family
                    $monthlyContributions = [];
                    foreach ($familyContributions as $contribution) {
                        $monthlyContributions[$contribution->month] = $contribution->amount;
                    }
                    return $monthlyContributions;
                });

            return view('frontend.church.contributions.index', compact('contributions', 'year', 'month'));
        } catch (\Exception $e) {
            Log::error('Error displaying frontend church contributions: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Imeshindwa kuonyesha taarifa za michango ya kanisa.');
        }
    }
}
