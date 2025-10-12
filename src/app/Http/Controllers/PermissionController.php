<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasPermissionMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return static::getResourceMiddleware('permissions');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Permission::with(['roles'])
                ->select(['id', 'name', 'guard_name', 'created_at']);

            return DataTables::of($query)
                ->addColumn('roles', function (Permission $permission) {
                    return $permission->roles->pluck('name')->join(', ');
                })
                ->addColumn('users_count', function (Permission $permission) {
                    return $permission->users()->count();
                })
                ->addColumn('actions', function ($permission) {
                    $showUrl = route('admin.permissions.show', $permission->id);
                    $editUrl = route('admin.permissions.edit', $permission->id);
                    $deleteUrl = route('admin.permissions.destroy', $permission->id);

                    return '
                        <a href="' . $showUrl . '" class="btn btn-sm btn-secondary">View</a>
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <button onclick="window.deletePermission(' . $permission->id . ', \'' . addslashes($permission->name) . '\', \'' . $deleteUrl . '\')" class="btn btn-sm btn-danger">Delete</button>
                    ';
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->filterColumn('roles', function ($query, $keyword) {
                    $query->whereHas('roles', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->rawColumns(['roles', 'actions'])
                ->make(true);
        }

        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
            'guard_name' => ['required', 'string', 'in:web'],
            'roles' => ['array'],
            'roles.*' => ['string', 'exists:roles,name'],
        ]);

        $permission = Permission::create([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        if (!empty($validated['roles'])) {
            $permission->syncRoles($validated['roles']);
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::with('roles', 'users')->findOrFail($id);
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id],
            'guard_name' => ['required', 'string', 'in:web'],
            'roles' => ['array'],
            'roles.*' => ['string', 'exists:roles,name'],
        ]);

        $permission->update([
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ]);

        // Sync roles
        if (isset($validated['roles'])) {
            $permission->syncRoles($validated['roles']);
        } else {
            $permission->syncRoles([]);
        }

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);

        // Check if permission has roles or users
        if ($permission->roles()->count() > 0 || $permission->users()->count() > 0) {
            return redirect()
                ->route('admin.permissions.index')
                ->with('error', 'Cannot delete permission that is assigned to roles or users!');
        }

        $permission->delete();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully!');
    }
}
