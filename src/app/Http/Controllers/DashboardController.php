<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Display the advanced forms page.
     */
    public function advancedForm()
    {
        return view('admin.advanced-forms');
    }
}
