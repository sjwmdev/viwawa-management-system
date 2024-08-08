<?php

namespace App\Http\Controllers\Backend\Admin\Contributions;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionRequest;
use App\Models\ContributionType;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContributionController extends Controller
{
    /**
     * Store a newly created contribution in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContributionRequest $request)
    {
        try {
            $contributionType = ContributionType::findOrFail($request->contribution_type_id);
            $goal_amount = $contributionType->goal_amount;
            $paid_amount = $request->paid_amount;
            $remaining_amount = max(0, $goal_amount - $paid_amount);
            $status = $remaining_amount <= 0 ? 'completed' : 'partial';

            $contribution = Contribution::create([
                'contribution_type_id' => $request->contribution_type_id,
                'member_id' => $request->member_id,
                'paid_amount' => $paid_amount,
                'remaining_amount' => $remaining_amount,
                'date' => $request->date,
                'status' => $status,
            ]);

            Log::info('Contribution has been added, ' . $contribution);
            return redirect()->route('admin.monthly.contributions.edit', $contribution->id)->with('success', 'Mchango umeongezwa.');
        } catch (\Exception $e) {
            Log::error('Error storing contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kuongeza mchango.');
        }
    }

    /**
     * Update the specified contribution in storage.
     *
     * @param Request $request
     * @param Contribution $contribution
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContributionRequest $request, Contribution $contribution)
    {
        try {
            $contributionType = ContributionType::findOrFail($request->contribution_type_id);
            $goal_amount = $contributionType->goal_amount;
            $paid_amount = $request->paid_amount;
            $remaining_amount = max(0, $goal_amount - $paid_amount);
            $status = $remaining_amount <= 0 ? 'completed' : 'partial';

            $cont_updated = $contribution->update([
                'contribution_type_id' => $request->contribution_type_id,
                'member_id' => $request->member_id,
                'paid_amount' => $paid_amount,
                'remaining_amount' => $remaining_amount,
                'date' => $request->date,
                'status' => $status,
            ]);

            Log::info('Contribution has been updated, ' . $cont_updated);
            return redirect()->route('admin.monthly.contributions.edit', $contribution->id)->with('success', 'Mchango umebadilishwa.');
        } catch (\Exception $e) {
            Log::error('Error updating contribution: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->back()->with('error', 'Imeshindwa kubadilisha mchango.');
        }
    }
}
