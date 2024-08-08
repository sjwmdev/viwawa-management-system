<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Fetch all members
            $members = Member::latest()->get();
            return view('backend.admin.viwawa.members.index', compact('members'));
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Error occured during fetching member information: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kuchukua taarifa za wanachama.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            // Display the form for creating a new member
            return view('backend.admin.viwawa.members.create');
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Failed to display members create page: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kuonesha fomu ya kuunda mwanachama.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        try {
            // Generate unique email and phone number if not provided
            $email = $request->email ?? $this->generateUniqueEmail();
            $phone_number = $request->phone_number ?? $this->generateUniquePhoneNumber();

            // Check if 'viwawa' role exists
            $viwawa = Role::where('name', 'viwawa')->first();
            if (!$viwawa) {
                return redirect()
                    ->route('admin.members.create')
                    ->withErrors(['error' => __('Jukumu la viwawa halipo. Tafadhali ongeza na ujaribu tena.')]);
            }

            // Create User
            $user = User::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => 'nenosiri', // The password is automatically hashed in the model.
            ]);

            // Assign the 'viwawa' role to the user
            $user->assignRole($viwawa);

            // Create Member
            $member = Member::create([
                'user_id' => $user->id,
                'gender' => $request->gender,
                'residence' => $request->residence,
                'occupation' => $request->occupation,
                'family_status' => $request->family_status,
            ]);

            Log::info('The new member has been created, ' . $member);
            return redirect()->route('admin.members.index')->with('success', 'Mwanachama amesajiliwa kikamilifu.');
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Failed to create a new member: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kuunda mwanachama.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        try {
            // Display the details of a specific member
            return view('backend.admin.viwawa.members.show', compact('member'));
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Failed to display members infomation in show page: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kuchukua taarifa za mwanachama.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        try {
            // Display the form for editing a member
            return view('backend.admin.viwawa.members.edit', compact('member'));
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Failed to display the member\'s edit page: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kuchukua taarifa za mwanachama kwa ajili ya kuhariri.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        try {
            // Generate unique email and phone number if not provided
            $email = $request->email ?? $member->user->email;
            $phone_number = $request->phone_number ?? $member->user->phone_number;

            // Check if 'viwawa' role exists
            $viwawa = Role::where('name', 'viwawa')->first();
            if (!$viwawa) {
                return redirect()
                    ->route('admin.members.edit')
                    ->withErrors(['error' => __('Jukumu la viwawa halipo. Tafadhali ongeza na ujaribu tena.')]);
            }

            // Update User
            $member->user->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $email,
                'phone_number' => $phone_number,
            ]);

            // Ensure the user still has the 'viwawa' role
            if (!$member->user->hasRole('viwawa')) {
                $member->user->assignRole($viwawa);
            }

            // Update Member
            $updated_member = $member->update([
                'gender' => $request->gender,
                'residence' => $request->residence,
                'occupation' => $request->occupation,
                'family_status' => $request->family_status,
                'presence_status' => $request->presence_status,
            ]);

            Log::info('Existing member record has been changed, ' . $updated_member);
            return redirect()
                ->route('admin.members.show', $member->id)
                ->with('success', 'Taarifa zimesasishwa kikamilifu.');
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Failed to update member\'s record: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kusasisha mwanachama.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        try {
            // Delete the member
            $deleted_member = $member->delete();

            Log::info('The member\'s record has been deleted, ' . $deleted_member);
            return redirect()->route('admin.members.index')->with('success', 'Mwanachama amefutwa kikamilifu.');
        } catch (\Exception $e) {
            // Log and handle the exception
            Log::error('Failed to delete existing member: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Imeshindikana kufuta mwanachama.']);
        }
    }

    /**
     * Generate a unique email if the default email already exists.
     *
     * @return string
     */
    private function generateUniqueEmail()
    {
        //$baseEmail = 'viwawa@mtzita.ac.tz';
        $count = User::where('email', 'LIKE', 'viwawa%mtzita.ac.tz')->count();
        return 'viwawa' . $count . '@mtzita.ac.tz';
    }

    /**
     * Generate a unique phone number if the default phone number already exists.
     *
     * @return string
     */
    private function generateUniquePhoneNumber()
    {
        //$basePhoneNumber = '255000000000';
        $count = User::where('phone_number', 'LIKE', '255000000%')->count();
        return '255000000' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
