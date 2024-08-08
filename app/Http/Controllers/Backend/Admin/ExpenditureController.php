<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the expenditures (matumizi).
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $expenditures = Expenditure::orderBy('date', 'desc')->get();
            $totalAmount = $expenditures->sum('amount');
            return view('backend.admin.viwawa.expenditures.index', compact('expenditures', 'totalAmount'));
        } catch (\Exception $e) {
            Log::error('Error fetching expenditures: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kupata matumizi.');
        }
    }

    /**
     * Store a newly created matumizi in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0',
                'date' => 'required|date',
                'description' => 'required',
            ]);

            $expenditures = Expenditure::create([
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
            ]);

            Log::info('Expenditure has been added, ' . $expenditures);
            return redirect()->back()->with('success', 'Matumizi yameongezwa.');
        } catch (\Exception $e) {
            Log::error('Error storing expenditure: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuongeza matumizi.');
        }
    }
}
