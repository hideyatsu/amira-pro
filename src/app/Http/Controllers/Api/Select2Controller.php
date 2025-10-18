<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Example controller for Select2 AJAX endpoints
 * 
 * Usage in your component:
 * <x-select2
 *     name="user_id"
 *     label="Select User"
 *     :serverside="true"
 *     ajax="{{ route('api.select2.users') }}"
 *     :minimum-input-length="2"
 * />
 */
class Select2Controller extends Controller
{
    /**
     * Get users for Select2 (example)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function users(Request $request): JsonResponse
    {
        $search = $request->input('q', '');
        $page = $request->input('page', 1);
        $perPage = 10;

        $query = \App\Models\User::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $total = $query->count();
        $users = $query->skip(($page - 1) * $perPage)
                       ->take($perPage)
                       ->get();

        $results = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => $user->name . ' (' . $user->email . ')',
            ];
        });

        return response()->json([
            'results' => $results,
            'total' => $total,
            'pagination' => [
                'more' => ($page * $perPage) < $total
            ]
        ]);
    }

    /**
     * Get roles for Select2 (example)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function roles(Request $request): JsonResponse
    {
        $search = $request->input('q', '');
        $page = $request->input('page', 1);
        $perPage = 10;

        $query = \Spatie\Permission\Models\Role::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        $total = $query->count();
        $roles = $query->skip(($page - 1) * $perPage)
                       ->take($perPage)
                       ->get();

        $results = $roles->map(function ($role) {
            return [
                'id' => $role->name,
                'text' => ucfirst($role->name),
            ];
        });

        return response()->json([
            'results' => $results,
            'total' => $total,
            'pagination' => [
                'more' => ($page * $perPage) < $total
            ]
        ]);
    }

    /**
     * Generic Select2 endpoint
     * 
     * Usage: route('api.select2.generic', ['model' => 'User', 'display' => 'name'])
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generic(Request $request): JsonResponse
    {
        $modelName = $request->input('model');
        $displayField = $request->input('display', 'name');
        $valueField = $request->input('value', 'id');
        $search = $request->input('q', '');
        $page = $request->input('page', 1);
        $perPage = 10;

        // Validate model exists
        $modelClass = "App\\Models\\{$modelName}";
        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        $query = $modelClass::query();

        if (!empty($search)) {
            $query->where($displayField, 'like', "%{$search}%");
        }

        $total = $query->count();
        $items = $query->skip(($page - 1) * $perPage)
                       ->take($perPage)
                       ->get();

        $results = $items->map(function ($item) use ($displayField, $valueField) {
            return [
                'id' => $item->{$valueField},
                'text' => $item->{$displayField},
            ];
        });

        return response()->json([
            'results' => $results,
            'total' => $total,
            'pagination' => [
                'more' => ($page * $perPage) < $total
            ]
        ]);
    }
}
