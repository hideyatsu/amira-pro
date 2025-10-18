<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasPermissionMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return static::getResourceMiddleware('users');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with(['roles'])
                ->select(['id', 'name', 'email', 'created_at']);

            return DataTables::of($query)
                ->addColumn('roles', function (User $user) {
                    return $user->roles->pluck('name')->join(', ');
                })
                ->addColumn('actions', function ($user) {
                    $showUrl = route('admin.users.show', $user->id);
                    $editUrl = route('admin.users.edit', $user->id);
                    $deleteUrl = route('admin.users.destroy', $user->id);

                    return '
                        <a href="' . $showUrl . '" class="btn btn-sm btn-secondary">View</a>
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <button onclick="window.deleteUser(' . $user->id . ', \'' . addslashes($user->name) . '\', \'' . $deleteUrl . '\')" class="btn btn-sm btn-danger">Delete</button>
                    ';
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->filterColumn('email', function ($query, $keyword) {
                    $query->where('email', 'like', "%{$keyword}%");
                })
                ->filterColumn('roles', function ($query, $keyword) {
                    $query->whereHas('roles', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->rawColumns(['roles', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['array'],
            'roles.*' => ['string', 'exists:roles,name'],
            'email_verified' => ['boolean'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => $request->boolean('email_verified') ? now() : null,
        ]);

        if (!empty($validated['roles'])) {
            $user->assignRole($validated['roles']);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles', 'permissions')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'roles' => ['array'],
            'roles.*' => ['string', 'exists:roles,name'],
            'email_verified' => ['boolean'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => $request->boolean('email_verified') ? ($user->email_verified_at ?? now()) : null,
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }

        // Sync roles
        if (isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        } else {
            $user->syncRoles([]);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting current authenticated user
        if ($user->id === request()->user()->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Manually trigger email verification for a user.
     */
    public function verify(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($user->hasVerifiedEmail()) {
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with('info', 'User email is already verified.');
        }
        $user->markEmailAsVerified();
        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User email verified successfully.');
    }

    /**
     * Send a password reset link to the user's email.
     */
    public function resetPassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        \Illuminate\Support\Facades\Password::sendResetLink(['email' => $user->email]);
        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'Password reset link sent to user\'s email.');
    }

    /**
     * Activate a user account.
     */
    public function activate(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->isActive()) {
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with('info', 'User is already activated.');
        }

        $user->activate();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User activated successfully.');
    }

    /**
     * Deactivate a user account.
     */
    public function deactivate(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (!$user->isActive()) {
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with('info', 'User is already deactivated.');
        }

        // Don't allow deactivating yourself
        if (Auth::id() === $user->id) {
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->with('error', 'You cannot deactivate your own account.');
        }

        $user->deactivate();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User deactivated successfully.');
    }
}
