<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:show roles', only: ['index']),
            new Middleware('permission:create roles', only: ['create', 'store']),
            new Middleware('permission:edit roles', only: ['edit', 'update']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->withCount('permissions')->paginate(10);
        return view('admin.access-management.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group_name');

        return view('admin.access-management.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->role, 'guard_name' => 'admin']);

        $role->syncPermissions($request->permissions);

        notyf()->success('Role created successfully.');

        return to_route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View|RedirectResponse
    {
        if ($role->name === 'super admin') {
            notyf()->error('You cannot edit this role.');
            return to_route('admin.roles.index');
        }

        $permissions = Permission::all()->groupBy('group_name');

        return view('admin.access-management.role.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        if ($role->name === 'super admin') {
            notyf()->error('You cannot edit this role.');
            return to_route('admin.roles.index');
        }

        $role->name = $request->role;
        $role->save();

        $role->syncPermissions($request->permissions);

        notyf()->info('Role updated successfully.');

        return to_route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        if ($role->name === 'super admin') {
            notyf()->error('You cannot delete this role.');
            return response()->json(['status' => 'error', 'message' => __('You cannot delete this role')], 400);
        }

        try {
            DB::beginTransaction();
            // remove role from user
            $role->users()->detach();

            // detach permission from role
            $role->permissions()->detach();
            $role->delete();

            DB::commit();
            notyf()->info('Role deleted successfully.');

            return response()->json(['status' => 'success', 'message' => __('Deleted Successfully')], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("an error occurred during deleting role:", ["exception" => $th]);

            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
        }

        return response()->json(['status' => 'error', 'message' => __('Something went wrong')], 400);
    }
}
