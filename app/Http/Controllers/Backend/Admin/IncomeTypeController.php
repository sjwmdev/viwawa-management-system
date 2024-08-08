<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeTypeRequest;
use App\Models\IncomeType;
use Illuminate\Support\Facades\Log;

class IncomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $incomeTypes = IncomeType::all();
            return view('backend.admin.viwawa.incomes.type', compact('incomeTypes'));
        } catch (\Exception $e) {
            Log::error('Hitilafu katika kupata aina za kipato: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with(['error' => 'Hitilafu katika kupata aina za kipato.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IncomeTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeTypeRequest $request)
    {
        try {
            IncomeType::create($request->validated());
            return redirect()->back()->with('success', 'Aina ya kipato imeongezwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Hitilafu katika kuongeza aina ya kipato: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with(['error' => 'Hitilafu katika kuongeza aina ya kipato.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IncomeTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeTypeRequest $request, $id)
    {
        try {
            $incomeType = IncomeType::findOrFail($id);
            $incomeType->update($request->validated());
            return redirect()->back()->with('success', 'Aina ya kipato imesasishwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Hitilafu katika kusasisha aina ya kipato: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with(['error' => 'Hitilafu katika kusasisha aina ya kipato.'], 500);
        }
    }
}
