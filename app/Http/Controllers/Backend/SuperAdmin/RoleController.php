<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $roles = Role::whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->paginate(5);
            return view('backend.superadmin.roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@index: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.dashboard')->withErrors('An error occurred while fetching roles.');
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
            $permissions = Permission::get();
            return view('backend.superadmin.roles.create', compact('permissions'));
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@create: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.roles.index')->withErrors('An error occurred while preparing the create form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required|array',
            ]);

            $role = Role::create([
                'name' => $request->get('name'),
                'created_by' => Auth::id(),
            ]);

            $role->syncPermissions($request->get('permission', []));

            Log::info('A new role has been created, ' . $role);
            return redirect()
                ->route('superadmin.roles.index')
                ->withSuccess(__('Role created successfully'));
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@store: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.roles.index')->withErrors('An error occurred while creating the role.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        try {
            $role = $role;
            $rolePermissions = $role->permissions;

            return view('backend.superadmin.roles.show', compact('role', 'rolePermissions'));
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@show: ' . $e->getMessage(), [
                'role_id' => $role->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.roles.index')->withErrors('An error occurred while fetching the role details.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        try {
            $role = $role;
            $rolePermissions = $role->permissions->pluck('name')->toArray();
            $permissions = Permission::get();

            return view('backend.superadmin.roles.edit', compact('role', 'rolePermissions', 'permissions'));
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@edit: ' . $e->getMessage(), [
                'role_id' => $role->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.roles.index')->withErrors('An error occurred while preparing the edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'permission' => 'required|array',
            ]);

            $updated_role = $role->update([
                'name' => $request->get('name'),
                'updated_by' => Auth::id(),
            ]);

            $role->syncPermissions($request->get('permission', []));

            Log::info('Existing role has been changed, ' . $updated_role);
            return redirect()
                ->route('superadmin.roles.index')
                ->withSuccess(__('Role updated successfully'));
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@update: ' . $e->getMessage(), [
                'role_id' => $role->id,
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.roles.index')->withErrors('An error occurred while updating the role.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->update([
                'deleted_by' => Auth::id(),
            ]);

            $role->delete();

            Log::info('Existing role has been deleted, ' . $role);
            return redirect()
                ->route('superadmin.roles.index')
                ->withSuccess(__('Role deleted successfully'));
        } catch (\Exception $e) {
            Log::error('Error occurred in RoleController@destroy: ' . $e->getMessage(), [
                'role_id' => $role->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.roles.index')->withErrors('An error occurred while deleting the role.');
        }
    }
}
