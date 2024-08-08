<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Get the date from the request, defaulting to the start of the current month
            $date = $request->input('date', now()->startOfMonth()->format('Y-m-d'));
            // Retrieve all members
            $members = Member::all();

            // Fetch attendance records for the selected date
            $attendances = Attendance::whereDate('date', $date)->get()->keyBy('member_id');

            // Count present and absent members
            $presentCount = $attendances->filter(fn ($attendance) => $attendance->present)->count();
            $totalMembers = $members->count();
            $absentCount = $totalMembers - $presentCount;

            // Check if there are any attendances for the given date
            $attendancesExist = !$attendances->isEmpty();

            // Return the attendance index view with the data
            return view('backend.admin.viwawa.attendance.index', compact('members', 'attendances', 'date', 'presentCount', 'absentCount', 'totalMembers', 'attendancesExist'));
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error displaying attendance index: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Kuna tatizo wakati wa kuonyesha orodha ya mahudhurio.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            // Get the date from the request, defaulting to the start of the current month
            $date = $request->input('date', now()->startOfMonth()->format('Y-m-d'));
            // Retrieve all members
            $members = Member::all();

            // Return the attendance creation view with the data
            return view('backend.admin.viwawa.attendance.create', compact('members', 'date'));
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error displaying attendance creation form: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Kuna tatizo wakati wa kuonyesha fomu ya kuunda mahudhurio.');
        }
    }

    // A function to check if a date is a Saturday
    private function isSaturday($date)
    {
        return Carbon::parse($date)->isSaturday();
    }

    /**
     * Store the specified resource in database.
     *
     * @param  \App\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $data = $request->validate(
                [
                    'date' => 'required|date|before_or_equal:today',
                    'attendance' => 'required|array',
                    'attendance.*.member_id' => 'required|exists:members,id',
                    'attendance.*.present' => 'nullable|boolean',
                ],
                [
                    'date.before_or_equal' => 'Tarehe haiwezi kuwa kubwa kuliko ya leo.',
                    'attendance.*.member_id.exists' => 'Mwanachama haonekani kwenye rekodi.',
                    'attendance.*.present.boolean' => 'Thamani ya uwepo lazima iwe 1 au 0.',
                ],
            );

            // Check if the date is a Saturday
            if (!$this->isSaturday($data['date'])) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Tarehe iliyochaguliwa si Jumamosi. Tafadhali chagua Jumamosi ya mwezi.']);
            }

            $existingMembers = [];

            foreach ($data['attendance'] as $attendanceData) {
                $existingAttendance = Attendance::where('member_id', $attendanceData['member_id'])
                    ->where('date', $data['date'])
                    ->first();

                if ($existingAttendance) {
                    $member = Member::find($attendanceData['member_id']);
                    $existingMembers[] = $member->user->full_name;
                } else {
                    Attendance::create([
                        'member_id' => $attendanceData['member_id'],
                        'date' => $data['date'],
                        'present' => $attendanceData['present'] ?? 0,
                    ]);
                }
            }

            if (!empty($existingMembers)) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Wanachama waliotajwa tayari wamehifadhiwa kwa tarehe hiyo: ' . implode(', ', $existingMembers)]);
            }

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Mahudhurio yamehifadhiwa kwa mafanikio!');
        } catch (ValidationException $e) {
            // Handle validation exceptions
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error storing attendance: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Kuna tatizo wakati wa kuhifadhi mahudhurio.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validator = Validator::make(
                $request->all(),
                [
                    'present' => 'required|boolean',
                ],
                [
                    'present.required' => 'Tafadhali chagua hali ya mahudhurio.',
                    'present.boolean' => 'Thamani ya uwepo lazima iwe 1 au 0.',
                ],
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Find the attendance record
            $attendance = Attendance::findOrFail($id);

            // Update the attendance record
            $attendance->present = $request->input('present');
            $attendance->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Mahudhurio yamebadilishwa kwa mafanikio!');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Failed to update attendance record', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Kuna tatizo wakati wa kubadilisha mahudhurio. Tafadhali jaribu tena.');
        }
    }
}
