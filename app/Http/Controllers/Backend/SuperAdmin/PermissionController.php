<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $permissions = Permission::whereNull('deleted_at')->get();

            return view('backend.superadmin.permissions.index', [
                'permissions' => $permissions,
            ]);
        } catch (\Exception $e) {
            Log::error('Error occurred in PermissionController@index: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.dashboard')->withErrors('An error occurred while fetching permissions.');
        }
    }

    /**
     * Show form for creating permissions
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoutes()
    {
        try {
            $routes = Route::getRoutes();

            $routeNames = [];
            foreach ($routes as $route) {
                if ($route->getName() != null && file_exists(base_path('routes/web.php'))) {
                    if (!in_array($route->getName(), ['sanctum.csrf-cookie', 'ignition.healthCheck', 'ignition.executeSolution', 'ignition.updateConfig'])) {
                        $routeNames[$route->getName()] = $route->getName();
                    }
                }
            }

            $permissionNames = Permission::pluck('name')->toArray();

            $unregisteredRoutes = array_diff($routeNames, $permissionNames);

            return $unregisteredRoutes;
        } catch (\Exception $e) {
            Log::error('Error occurred in  PermissionController@getRoutes: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [];
        }
    }

    public function create()
    {
        try {
            $routeNames = $this->getRoutes();
            return view('backend.superadmin.permissions.create', compact('routeNames'));
        } catch (\Exception $e) {
            Log::error('Error occurred in PermissionController@create: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.permissions.index')->withErrors('An error occurred while preparing the create form.');
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
            if (is_array($request->input('name'))) {
                $request->validate([
                    'name' => 'required|array|unique:permissions,name',
                ]);

                foreach ($request->input('name') as $name) {
                    $permission = new Permission([
                        'name' => $name,
                        'created_by' => Auth::id(),
                    ]);
                    $permission->save();
                }
            } else {
                $request->validate([
                    'name' => 'required|unique:permissions,name',
                ]);

                $permission = new Permission([
                    'name' => $request->input('name'),
                    'created_by' => Auth::id(),
                ]);
                $permission->save();
            }

            Log::info('A new permission has been created, ' . $permission);
            return redirect()
                ->route('superadmin.permissions.index')
                ->withSuccess(__('Permissions created successfully.'));
        } catch (\Exception $e) {
            Log::error('Error occurred in  PermissionController@store: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.permissions.index')->withErrors('An error occurred while creating permissions.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        try {
            return view('backend.superadmin.permissions.edit', [
                'permission' => $permission,
            ]);
        } catch (\Exception $e) {
            Log::error('Error occurred in PermissionController@edit: ' . $e->getMessage(), [
                'permission_id' => $permission->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.permissions.index')->withErrors('An error occurred while preparing the edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $request->validate([
                'name' => 'required|unique:permissions,name,' . $permission->id,
            ]);

            $permission->name = $request->input('name');
            $permission->updated_by = Auth::id();
            $permission->save();

            Log::info('The permission has been changed, ' . $permission);
            return redirect()
                ->route('superadmin.permissions.index')
                ->withSuccess(__('Permission updated successfully.'));
        } catch (\Exception $e) {
            Log::error('Error occurred in PermissionController@update: ' . $e->getMessage(), [
                'permission_id' => $permission->id,
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.permissions.index')->withErrors('An error occurred while updating the permission.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->deleted_by = Auth::id();
            $permission->save();
            $permission->forceDelete();

            Log::info('The permission has been deleted, ' . $permission);
            return redirect()
                ->route('superadmin.permissions.index')
                ->withSuccess(__('Permission deleted successfully.'));
        } catch (\Exception $e) {
            Log::error('Error occurred in PermissionController@destroy: ' . $e->getMessage(), [
                'permission_id' => $permission->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('superadmin.permissions.index')->withErrors('An error occurred while deleting the permission.');
        }
    }
}
