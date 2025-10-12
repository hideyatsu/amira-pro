<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasPermissionMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
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
                    $editUrl = route('admin.users.edit', $user->id);
                    $deleteBtn = '<button onclick="deleteUser(' . $user->id . ')" class="btn btn-sm btn-danger">Delete</button>';

                    return "<a href='{$editUrl}' class='btn btn-sm btn-primary'>Edit</a> {$deleteBtn}";
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
