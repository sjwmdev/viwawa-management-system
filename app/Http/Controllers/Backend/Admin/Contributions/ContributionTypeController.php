<?php

namespace App\Http\Controllers\Backend\Admin\Contributions;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionTypeRequest;
use App\Models\ContributionType;
use Illuminate\Support\Facades\Log;

class ContributionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $contributionTypes = ContributionType::all();
            return view('backend.admin.viwawa.contributions.type', compact('contributionTypes'));
        } catch (\Exception $e) {
            Log::error('Hitilafu katika kupata aina za mchango: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with(['error' => 'Hitilafu katika kupata aina za mchango.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContributionTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContributionTypeRequest $request)
    {
        try {
            ContributionType::create($request->validated());
            return redirect()->back()->with('success', 'Aina ya mchango imeongezwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Hitilafu katika kuongeza aina ya mchango: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with(['error' => 'Hitilafu katika kuongeza aina ya mchango.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ContributionTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContributionTypeRequest $request, $id)
    {
        try {
            $contributionType = ContributionType::findOrFail($id);
            $contributionType->update($request->validated());
            return redirect()->back()->with('success', 'Aina ya mchango imesasishwa kwa mafanikio.');
        } catch (\Exception $e) {
            Log::error('Hitilafu katika kusasisha aina ya mchango: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with(['error' => 'Hitilafu katika kusasisha aina ya mchango.']);
        }
    }
}
