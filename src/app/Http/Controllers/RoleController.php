<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasPermissionMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RoleController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return static::getResourceMiddleware('roles');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Role::with(['permissions'])
                ->select(['id', 'name', 'guard_name', 'created_at']);

            return DataTables::of($query)
                ->addColumn('permissions', function (Role $role) {
                    return $role->permissions->pluck('name')->join(', ');
                })
                ->addColumn('users_count', function (Role $role) {
                    return $role->users()->count();
                })
                ->addColumn('actions', function ($role) {
                    $showUrl = route('admin.roles.show', $role->id);
                    $editUrl = route('admin.roles.edit', $role->id);
                    $deleteUrl = route('admin.roles.destroy', $role->id);

                    return '
                        <a href="' . $showUrl . '" class="btn btn-sm btn-secondary">View</a>
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <button onclick="window.deleteRole(' . $role->id . ', \'' . addslashes($role->name) . '\', \'' . $deleteUrl . '\')" class="btn btn-sm btn-danger">Delete</button>
                    ';
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->filterColumn('permissions', function ($query, $keyword) {
                    $query->whereHas('permissions', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->rawColumns(['permissions', 'actions'])
                ->make(true);
        }

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1] ?? 'general';
        });

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'guard_name' => ['required', 'string', 'in:web'],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::with('permissions', 'users')->findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1] ?? 'general';
        });

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'guard_name' => ['required', 'string', 'in:web'],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        $role->update([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        // Sync permissions
        if (isset($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        // Check if role has users
        if ($role->users()->count() > 0) {
            return redirect()
                ->route('admin.roles.index')
                ->with('error', 'Cannot delete role that has assigned users!');
        }

        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully!');
    }
}
