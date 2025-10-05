<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // IMPORTANT: Only process when this is an AJAX request
        if ($request->ajax()) {
            // 1. Fetch base data from the database
            // Select the columns you want to expose. Be careful with sensitive fields.
            $query = User::select(['id', 'name', 'email', 'created_at']);

            // 2. Use DataTables to process the query
            return DataTables::of($query)
                // 3. Add custom columns (for example, an Actions column)
                ->addColumn('actions', function ($user) {
                    // Build Edit/Delete links here.
                    // Assumes a route named 'admin.users.edit' exists.
                    $editUrl = route('admin.users.edit', $user->id);
                    $deleteBtn = '<button onclick="deleteUser(' . $user->id . ')" class="btn btn-sm btn-danger">Delete</button>';

                    return "<a href='{$editUrl}' class='btn btn-sm btn-info'>Edit</a> {$deleteBtn}";
                })
                // 4. Configure searchable columns (if necessary)
                ->filterColumn('name', function ($query, $keyword) {
                    // Example custom filter: match names containing the keyword
                    $query->where('name', 'like', "%{$keyword}%");
                })
                // 5. Raw columns: tell DataTables which columns contain HTML
                ->rawColumns(['actions'])
                // 6. Return the JSON response
                ->make(true);
        }
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
