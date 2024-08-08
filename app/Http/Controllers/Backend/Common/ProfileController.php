<?php

namespace App\Http\Controllers\Backend\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        try {
            $user = Auth::user();
            return view('backend.common.profile.edit', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error displaying profile edit form: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all()
            ]);
            return redirect()->route('dashboard')->withErrors(['error' => 'Imeshindwa kupakia fomu ya kubadilisha profaili. Tafadhali jaribu tena.']);
        }
    }

    /**
     * Update the user's profile in storage.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            $data = $request->validated();

            // Update user profile
            $updated_user = $user->update($data);

            Log::info('Existing user record has been updated with ID: ' . $updated_user);
            return redirect()->route('common.profile.edit')->with('success', 'Profaili imesasishwa kwa mafanikio.');
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all()
            ]);
            return redirect()->route('common.profile.edit')->withErrors(['error' => 'Imeshindwa kusasisha profaili. Tafadhali jaribu tena.']);
        }
    }

    /**
     * Change the user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'old_password.required' => 'Nenosiri la zamani linahitajika.',
            'password.required' => 'Nenosiri jipya linahitajika.',
            'password.min' => 'Nenosiri jipya lazima liwe na angalau herufi 8.',
            'password.confirmed' => 'Uthibitisho wa nenosiri jipya hauendani.',
        ]);

        try {
            // Retrieve the currently authenticated user
            $user = User::findOrFail(Auth::user()->id);

            // Verify if the old password matches the one in the database
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Nenosiri la zamani ulilotoa si sahihi.']);
            }

            // Old password matches, proceed to update the password
            $user->password = Hash::make($request->password);
            $user->updated_by = Auth::id();
            $user->save();

            Log::info('The user has changed his password, ' . $user);
            return redirect()->back()->with('success', 'Nenosiri limebadilishwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Error changing password: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            return redirect()->back()->withErrors(['error' => 'Imeshindwa kubadilisha nenosiri. Tafadhali jaribu tena.']);
        }
    }
}
