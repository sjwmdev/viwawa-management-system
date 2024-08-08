<?php

namespace App\Http\Controllers\Backend\Admin\Contributions;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Contribution;
use App\Models\ContributionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonthlyContributionController extends Controller
{
    /**
     * Display a listing of the monthly contributions for the specified year.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $currentYear = $request->get('year', date('Y'));
            $totalMembers = Member::count();

            // Fetch the contributions grouped by year, month, and member
            $contributions = Contribution::selectRaw('member_id, YEAR(date) as year, MONTH(date) as month, SUM(paid_amount) as total_paid, remaining_amount, status')
                ->with(['member.user'])
                ->whereYear('date', $currentYear)
                ->whereHas('contributionType', function ($query) {
                    $query->where('identifier', 'mwezi');
                })
                ->groupBy('member_id', 'year', 'month', 'remaining_amount', 'status')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->orderBy('member_id', 'asc')
                ->get();

            // Group contributions by month
            $months = $contributions->groupBy('month')->map(function ($monthGroup) use ($totalMembers) {
                return [
                    'members' => $monthGroup,
                    'count' => $monthGroup->count(),
                    'total_members' => $totalMembers,
                ];
            });

            // Fetch distinct years for the year dropdown
            $years = Contribution::selectRaw('DISTINCT YEAR(date) as year')->orderBy('year', 'asc')->pluck('year');

            return view('backend.admin.viwawa.contributions.monthly.index', compact('months', 'currentYear', 'years', 'totalMembers'));
        } catch (\Exception $e) {
            Log::error('Error fetching monthly contributions: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuleta taarifa za michango ya kila mwezi.');
        }
    }

    /**
     * Show the form for creating a new monthly contribution.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            $contributionTypes = ContributionType::all();
            $members = Member::with('user')->get();

            // Fetch the goal amount and ID for the contribution type name 'Mchango wa Mwezi' identifier "mwezi".
            $contributionType = ContributionType::where('identifier', 'mwezi')->first();
            $goalAmount = $contributionType->goal_amount ?? null;
            $contributionTypeId = $contributionType->id ?? null;

            return view('backend.admin.viwawa.contributions.monthly.create', compact('members', 'contributionTypes', 'goalAmount', 'contributionTypeId'));
        } catch (\Exception $e) {
            Log::error('Error fetching members for monthly contribution creation: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupakia ukurasa wa kuunda mchango wa kila mwezi.');
        }
    }

    /**
     * Show the form for editing the specified monthly contribution.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(Contribution $contribution)
    {
        try {
            $contributionTypes = ContributionType::all();
            $members = Member::with('user')->get();

            // Fetch the goal amount for the specific contribution type if available
            $goalAmount = $contribution->contributionType->goal_amount ?? null;

            return view('backend.admin.viwawa.contributions.monthly.edit', compact('contribution', 'contributionTypes', 'members', 'goalAmount'));
        } catch (\Exception $e) {
            Log::error('Error fetching monthly contribution for editing: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupakia ukurasa wa mchango wa kila mwezi.');
        }
    }

    /**
     * Display the details of monthly contributions for a specific year and month.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function details(Request $request)
    {
        try {
            $year = $request->get('year');
            $month = $request->get('month');

            $contributions = Contribution::with('member.user')
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();

            $totalPaidAmount = $contributions->sum('paid_amount');
            $totalRemainingAmount = $contributions->sum('remaining_amount');
            $overallExpectedAmount = $totalPaidAmount + $totalRemainingAmount;

            return view('backend.admin.viwawa.contributions.monthly.details', compact(
                'contributions',
                'year',
                'month',
                'totalPaidAmount',
                'totalRemainingAmount',
                'overallExpectedAmount'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching monthly contribution details: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuleta maelezo ya mchango wa mwezi.');
        }
    }

    /**
     * Generate a monthly report of contributions.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
        try {
            $years = Contribution::selectRaw('DISTINCT YEAR(date) as year')
                ->orderBy('year', 'desc')
                ->pluck('year')
                ->toArray();

            $currentYear = $request->get('year', $years ? $years[0] : null);

            $contributions = Contribution::selectRaw('member_id, YEAR(date) as year, MONTH(date) as month, SUM(paid_amount) as total_paid, remaining_amount, status')
                ->with(['member.user'])
                ->whereYear('date', $currentYear)
                ->whereHas('contributionType', function ($query) {
                    $query->where('identifier', 'mwezi');
                })
                ->groupBy('member_id', 'year', 'month', 'remaining_amount', 'status')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->orderBy('member_id', 'asc')
                ->get();

            $totalMembers = Member::count();

            return view('backend.admin.viwawa.contributions.monthly.report', compact('contributions', 'years', 'currentYear', 'totalMembers'));
        } catch (\Exception $e) {
            Log::error('Error generating monthly contribution report: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kutoa ripoti ya mchango wa mwezi.');
        }
    }
}
