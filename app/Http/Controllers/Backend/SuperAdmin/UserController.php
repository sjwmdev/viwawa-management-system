<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::with('roles')
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'superadmin');
                })
                ->where('id', '!=', auth()->id())
                ->get();

            return view('backend.superadmin.users.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error getting users information: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kupata watumiaji.']);
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $roles = Role::where('name', 'admin')->get();
            return view('backend.superadmin.users.create', compact('roles'));
        } catch (\Exception $e) {
            Log::error('Error displaying user create form: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kupakia fomu ya kuunda mtumiaji.']);
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();

            // Check if 'admin' role exists
            $adminRole = Role::where('name', 'admin')->first();
            if (!$adminRole) {
                return redirect()
                    ->route('superadmin.users.create')
                    ->withErrors(['error' => 'Jukumu la admin halipo. Tafadhali ongeza na ujaribu tena.']);
            }

            // Generate unique email and phone number if not provided
            $email = $request->email ?? $this->generateUniqueEmail();
            $phone_number = $request->phone_number ?? $this->generateUniquePhoneNumber();

            // Default password is 'nenosiri'
            $password = 'nenosiri';

            // Create a new user
            $user = User::create([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'] ?? null,
                'last_name' => $data['last_name'],
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => $password,
            ]);

            // Assign the specified role to the user
            $user->assignRole($adminRole);

            Log::info('A new user has been created, ' . $user . ' and assigned admin role.');
            return redirect()->route('superadmin.users.index')->with('success', 'Mtumiaji ameundwa kikamilifu.');
        } catch (\Exception $e) {
            Log::error('Error creating a new user: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kuunda mtumiaji.']);
        }
    }

    /**
     * Show user data.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            return view('backend.superadmin.users.show', ['user' => $user]);
        } catch (\Exception $e) {
            Log::error('Error displaying user show page: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kupakia maelezo ya mtumiaji.']);
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            $roles = Role::where('name', 'admin')->get();
            $userRole = $user->roles->pluck('name')->toArray();

            return view('backend.superadmin.users.edit', compact('user', 'roles', 'userRole'));
        } catch (\Exception $e) {
            Log::error('Error displaying user edit form: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kupakia fomu ya kuhariri mtumiaji.']);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            if ($request->filled('password')) {
                $data['password'] = $data['password'];
            } else {
                unset($data['password']);
            }
            $user->update($data);
            $user->syncRoles($request->role);

            Log::info('Existing user record has been changed, ' . $user);
            return redirect()->route('superadmin.users.index')->with('success', 'Mtumiaji amewekwa sawa.');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kusasisha mtumiaji.']);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            Log::info('Existing user record has been deleted, ' . $user);
            return redirect()->route('superadmin.users.index')->with('success', 'Mtumiaji ameondolewa kwa mafanikio.');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kufuta mtumiaji.']);
        }
    }

    /**
     * Force delete the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(User $user)
    {
        try {
            $user->forceDelete();
            return redirect()->route('superadmin.users.index')->with('success', 'Mtumiaji ameondolewa kwa kudumu.');
        } catch (\Exception $e) {
            Log::error('Hitilafu ya kufuta mtumiaji kwa kudumu: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);
            return redirect()
                ->route('superadmin.users.index')
                ->withErrors(['error' => 'Imeshindikana kufuta mtumiaji kwa kudumu.']);
        }
    }

    /**
     * Generate a unique email if the default email already exists.
     *
     * @return string
     */
    private function generateUniqueEmail()
    {
        //$baseEmail = 'admin@vms.ac.tz';
        $count = User::where('email', 'LIKE', 'admin@vms.ac.tz')->count();
        return 'admin' . $count . '@vms.ac.tz';
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
