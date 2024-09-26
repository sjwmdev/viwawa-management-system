<?php

namespace App\Http\Controllers\Backend\Admin\Contributions;

use App\Http\Controllers\Controller;
use App\Models\ChurchContribution as CC;
use App\Http\Requests\ChurchContributionRequest as CCR;
use App\Models\ContributionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChurchContributionController extends Controller
{
    // Base URL for routes and views
    private $routeBaseUrl = 'admin.church.contributions';
    private $viewBaseUrl = 'backend.admin.viwawa.contributions.church';

    /**
     * Display a listing of the church contributions for the specified year.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $year = $request->get('year', date('Y'));
            $month = $request->get('month', null);

            // Fetch church contributions with optional filtering by month and year
            $query = CC::where('year', $year);
            if ($month) {
                $query->where('month', $month);
            }

            $contributions = $query->get();

            // Calculate total contribution amount
            $totalAmount = $contributions->sum('amount');

            // Fetch all years and months for filtering
            $years = CC::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            return view($this->viewBaseUrl . '.index', compact('contributions', 'years', 'months', 'year', 'month', 'totalAmount'));
        } catch (\Exception $e) {
            Log::error('Error fetching church contributions: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuleta taarifa za michango ya kanisa.');
        }
    }

    /**
     * Show the form for creating a new church contribution.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        try {
            // Fetch all contribution types for the dropdown
            $contributionTypes = ContributionType::all();

            // Fetch the goal amount and ID for the contribution type 'Mchango wa Ujenzi' identified by "ujenzikanisa".
            $contributionType = ContributionType::where('identifier', 'ujenzikanisa')->first();
            $contributionTypeId = $contributionType->id ?? null;
            $goalAmount = $contributionType->goal_amount ?? null;

            // Check for family member ID (fmid) in the request and pluck family name
            $familyName = null;
            if ($request->has('fmid')) {
                $churchContribution = CC::find($request->fmid);
                if ($churchContribution) {
                    $familyName = $churchContribution->family_name;
                }
            }

            // Pass the family name and other data to the view
            return view($this->viewBaseUrl . '.create', compact('contributionTypes', 'contributionTypeId', 'goalAmount', 'familyName'));
        } catch (\Exception $e) {
            Log::error('Error loading form for creating church contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupakia ukurasa wa kuunda mchango wa kanisa.');
        }
    }

    /**
     * Store a newly created church contribution in storage.
     *
     * @param ChurchContributionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CCR $request)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Create a new church contribution
            $churchContribution = CC::create($data);

            // Redirect to the show page of the newly created record
            return redirect()->route($this->routeBaseUrl . '.show', $churchContribution->id)
            ->with('success', 'Mchango umehifadhiwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Error storing church contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuhifadhi mchango wa kanisa.');
        }
    }

    /**
     * Display the specified church contribution by family name, filtered by year and grouped by month.
     *
     * @param  string  $familyName
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function show(CC $kanisa, Request $request)
    {
        try {
            $routeBaseUrl = $this->routeBaseUrl;
            $year = $request->get('year', date('Y'));

            // Fetch the latest church contribution using its id
            $churchContribution = $kanisa;

            // Fetch contributions for the specific family using the id, filtered by year, and group by month
            $contributions = CC::where('family_name', $churchContribution->family_name)
            ->where('year', $year)
                ->orderBy('contribution_date', 'desc')  // Fetch latest contributions first
                ->get()
                ->groupBy('month');  // Group by month

            // Fetch available years for filtering
            $years = CC::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

            // Calculate total amount contributed for the year
            $totalAmount = $contributions->flatten()->sum('amount');

            // Use the first contribution to display the family details
            $latestContribution = $churchContribution;

            return view($this->viewBaseUrl . '.show', [
                'contributionsByMonth' => $contributions,
                'churchContribution' => $latestContribution,
                'years' => $years,
                'year' => $year,
                'totalAmount' => $totalAmount,
                'routeBaseUrl' => $routeBaseUrl,
            ]);
        } catch (\Exception $e) {
            Log::error('Error displaying church contribution details: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuonyesha taarifa za mchango wa kanisa.');
        }
    }

    /**
     * Show the form for editing the specified church contribution.
     *
     * @param ChurchContribution $churchContribution
     * @return \Illuminate\View\View
     */
    public function edit(CC $kanisa)
    {
        try {
            $churchContribution = $kanisa;

            // Fetch all contribution types for the dropdown
            $contributionTypes = ContributionType::all();

            // Fetch the goal amount for the specific contribution type if available
            $goalAmount = $kanisa->contributionType->goal_amount ?? null;

            return view($this->viewBaseUrl . '.edit', compact('churchContribution', 'contributionTypes', 'goalAmount'));
        } catch (\Exception $e) {
            Log::error('Error loading form for editing church contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupakia ukurasa wa kuhariri mchango wa kanisa.');
        }
    }

    /**
     * Update the specified church contribution in storage.
     *
     * @param ChurchContributionRequest $request
     * @param ChurchContribution $kanisa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CCR $request, CC $kanisa)
    {
        try {
            // Validate the request data
            $data = $request->validated();

            // Update the church contribution
            $kanisa->update($data);

            // Redirect to the show page of the updated record
            return redirect()->route($this->routeBaseUrl . '.show', $kanisa->id)
            ->with('success', 'Mchango umesasishwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Error updating church contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kusasisha mchango wa kanisa.');
        }
    }

    /**
     * Remove the specified church contribution from storage.
     *
     * @param ChurchContribution $churchContribution
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CC $kanisa)
    {
        try {
            // Delete the church contribution
            $kanisa->delete();

            return redirect()->route($this->routeBaseUrl . '.index')->with('success', 'Mchango umefutwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Error deleting church contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kufuta mchango wa kanisa.');
        }
    }
}
