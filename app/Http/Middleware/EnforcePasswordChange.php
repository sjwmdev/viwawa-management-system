<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EnforcePasswordChange
{
    public function handle($request, Closure $next)
    {
        $user = User::find(Auth::user()->id);
        $userSeederPassword = 'nenosiri';
        $allowedRoutes = [
            'common.profile.edit',
            'common.profile.update',
            'common.profile.change-password',
        ];

        if ($user->hasRole('student')) {
            $student = $user->student;
            $isDefaultPassword = Hash::check($student->reg_num, $user->password) || Hash::check($userSeederPassword, $user->password);

            if ($isDefaultPassword && !in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('common.profile.edit')->withErrors(['error' => 'Kwa sababu za usalama, tafadhali sasisha nenosiri lako kabla ya kuendelea.']);
            }
        } else {
            $isDefaultPassword = Hash::check($userSeederPassword, $user->password);

            if ($isDefaultPassword && !in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('common.profile.edit')->withErrors(['error' => 'Kwa sababu za usalama, tafadhali sasisha nenosiri lako kabla ya kuendelea.']);
            }
        }

        return $next($request);
    }
}
