<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ChurchContribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChurchContributionController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get the selected year, month, and search query from the request
            $year = $request->get('year', now()->year);
            $month = $request->get('month', null);
            $search = $request->get('search', '');

            // Query contributions by year and optionally by month
            $contributions = ChurchContribution::where('year', $year)
                ->when($month, function ($query, $month) {
                    return $query->where('month', $month); // Filter by month if specified
                })
                ->when($search, function ($query, $search) {
                    return $query->where('family_name', 'like', '%' . $search . '%'); // Filter by family name if search is present
                })
                ->orderBy('family_name')
                ->get();

                return view('frontend.church.contributions.index', compact('contributions', 'year', 'month'));
        } catch (\Exception $e) {
            // Log the error details for debugging purposes
            Log::error('Error displaying church contributions: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Imeshindwa kuonyesha taarifa za michango ya kanisa.');
        }
    }
}
