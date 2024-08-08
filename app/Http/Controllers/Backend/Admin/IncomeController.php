<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\IncomeType;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\IncomeRequest;
use Carbon\Carbon;

class IncomeController extends Controller
{
    /**
     * Display the Saturday incomes grouped by year and month.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function saturday(Request $request)
    {
        try {
            // Find the IncomeType for 'Sadaka ya Jumamosi'
            $incomeType = IncomeType::where('identifier', 'jumamosi')->firstOrFail();

            // Fetch all Saturday incomes grouped by year and month
            $incomes = Income::where('income_type_id', $incomeType->id)
                ->selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total_amount')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

            // Fetch the income type ID for "Sadaka ya Jumamosi"
            $incomeTypeId = $incomeType->id;

            return view('backend.admin.viwawa.incomes.saturday.index', compact('incomes', 'incomeTypeId'));
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error fetching Saturday incomes: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Kuna tatizo wakati wa kupata michango. Tafadhali jaribu tena.']);
        }
    }

    /**
     * Display the Saturday incomes details for a specific year and month.
     *
     * @param  int  $year
     * @param  int  $month
     * @return \Illuminate\View\View
     */
    public function saturdayDetails($year, $month)
    {
        try {
            // Find the IncomeType for 'Sadaka ya Jumamosi'
            $incomeType = IncomeType::where('identifier', 'jumamosi')->firstOrFail();

            // Fetch all Saturday incomes for the selected year and month
            $incomes = Income::where('income_type_id', $incomeType->id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->orderBy('date', 'asc')
                ->get();

            return view('backend.admin.viwawa.incomes.saturday.details', compact('incomes', 'year', 'month'));
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error fetching Saturday income details: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Kuna tatizo wakati wa kupata michango. Tafadhali jaribu tena.']);
        }
    }

    /**
     * Display the other incomes grouped by year and month.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function other(Request $request)
    {
        try {
            // Fetch the ID of the income type "vyanzovingine"
            $incomeTypeId = IncomeType::where('identifier', 'vyanzovingine')->firstOrFail()->id;

            // Fetch and group incomes of type other than 'sadaka ya jumamosi' by year and month
            $incomes = Income::where('income_type_id', $incomeTypeId)
                ->selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total_amount')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

            // Fetch all detailed 'other' incomes
            $details = Income::where('income_type_id', $incomeTypeId)
                ->orderBy('date', 'asc')
                ->get()
                ->groupBy(function ($income) {
                    return Carbon::parse($income->date)->format('Y-m');
                });

            return view('backend.admin.viwawa.incomes.other', compact('incomes', 'details', 'incomeTypeId'));
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error fetching other incomes: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Kuna tatizo wakati wa kupakua mapato. Tafadhali jaribu tena.']);
        }
    }

    /**
     * Store a new income.
     *
     * @param  \App\Http\Requests\IncomeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IncomeRequest $request)
    {
        try {
            // Create a new income record
            $income = Income::create($request->validated());

            Log::info('The income has been added, ' . $income);
            return redirect()->back()->with('success', 'Mapato yamehifadhiwa kikamilifu.');
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error storing income: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Kuna tatizo wakati wa kuhifadhi mapato. Tafadhali jaribu tena.']);
        }
    }

    /**
     * Update an existing income.
     *
     * @param  \App\Http\Requests\IncomeRequest  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IncomeRequest $request, Income $income)
    {
        try {
            // Update the specified income record
            $income->update($request->validated());

            Log::info('The income has been updated, ' . $income);
            return redirect()->back()->with('success', 'Mapato yamesasishwa kikamilifu.');
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error updating income: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Kuna tatizo wakati wa kusasisha mapato. Tafadhali jaribu tena.']);
        }
    }
}
