<?php

namespace App\Http\Controllers\Backend\Common;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Support\Facades\Log as LogFacade;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the logs.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Optional: Apply filters based on request parameters if needed
            $query = Log::query();

            // Pagination, 15 logs per page
            $logs = $query->get();

            return view('backend.common.logs.index', compact('logs'));
        } catch (\Exception $e) {
            LogFacade::error('Error fetching logs: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->route('common.dashboard')->withErrors('Imeshindikana kupakia orodha ya kumbukumbu. Tafadhali jaribu tena.');
        }
    }
}