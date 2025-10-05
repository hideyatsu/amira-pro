<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasPermissionMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        // Dashboard only requires basic auth middleware, no specific permissions
        return static::getBaseMiddleware();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Display the advanced forms page.
     */
    public function advancedForm()
    {
        return view('admin.dashboard.advanced-forms');
    }

    /**
     * Display the tables page.
     */
    public function tables()
    {
        return view('admin.dashboard.tables');
    }
}
