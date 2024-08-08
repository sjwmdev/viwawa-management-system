<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        try {
            return view('backend.auth.register');
        } catch (\Exception $e) {
            Log::error('Error displaying register page: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->route('login')->withErrors('Imeshindwa kupakia ukurasa wa usajili. Tafadhali jaribu tena.');
        }
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            auth()->login($user);

            return redirect('/dashboard')->withSuccess(__('Akaunti imesajiliwa kwa kikamilifu.'));
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()->route('register')->withErrors('Imeshindwa kusajili akaunti. Tafadhali jaribu tena.');
        }
    }
}
