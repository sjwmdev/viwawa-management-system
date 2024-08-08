<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MfukoBalanceController extends Controller
{
    /**
     * Display the mfuko balance index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Fetch the most recent balance record from the database
            $balance = DB::table('mfuko_balance')->orderBy('date', 'desc')->first();

            // Convert the date to a Carbon instance if a balance record is found
            if ($balance) {
                $balance->date = Carbon::parse($balance->date);

                // Pass the additional data to the view
                $data = [
                    'balance' => $balance,
                ];
            } else {
                $data = [
                    'balance' => null,
                ];
            }

            // Return the view with the balance data
            return view('backend.admin.viwawa.mfuko.index', $data);
        } catch (\Exception $e) {
            // Log the exception details for debugging purposes
            Log::error('Failed getting balance record: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);

            // Redirect back with an error message in Swahili
            return redirect()->back()->with('error', 'Imeshindikana kupata rekodi ya salio.');
        }
    }

    /**
     * Calculate the mfuko balance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateBalance(Request $request)
    {
        try {
            // Call the artisan command to calculate the balance
            Artisan::call('mfuko:calculate');

            // Redirect back with a success message in Swahili if the command executes without errors
            return response()->json(['status' => 'success', 'message' => 'Salio limehesabiwa kikamilifu.']);
        } catch (\Exception $e) {
            // Log the exception details for debugging purposes
            Log::error('Mfuko balance calculation error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            // Redirect back with an error message in Swahili if an exception occurs
            return response()->json(['status' => 'error', 'message' => 'Imeshindikana kupakua salio.']);
        }
    }
}
