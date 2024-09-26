<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        try {
            return view('backend.auth.login');
        } catch (\Throwable $e) {
            Log::error('Error displaying login page: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->route('login')->withErrors('Imeshindikana kupakia ukurasa wa kuingia. Tafadhali jaribu tena.');
        }
    }

    /**
     * Handle account login request.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('phone_number', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                // Check for intended URL to prevent redirect loop
                $intendedUrl = session()->pull('url.intended', route('common.dashboard'));

                // return redirect()->to($intendedUrl)->with('success', 'Umefanikiwa kuingia. Karibu!');
                return redirect()->to($intendedUrl)->with('success','');
            }

            return back()
                ->withErrors([
                    'phone_number' => 'Namba ya simu au nenosiri si sahihi.',
                ])
                ->onlyInput('phone_number');
        } catch (\Throwable $e) {
            Log::error('Error trying to login: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);
            return back()->withErrors('Imeshindikana kuingia. Tafadhali jaribu tena.')->onlyInput('phone_number');
        }
    }

    /**
     * Handle response after user authenticated.
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated()
    {
        try {
            return redirect()->route('common.dashboard');
        } catch (\Throwable $e) {
            Log::error('Redirect error after login: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->route('login')->withErrors('Imeshindikana kuelekeza baada ya kuingia. Tafadhali jaribu tena.');
        }
    }
}
