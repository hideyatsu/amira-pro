@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-pretitle', 'Overview')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('page-description')
    Welcome back, {{ auth()?->user()?->name ?? 'Admin' }}! Here's a summary of your site's activity.
@endsection

@section('page-actions')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
            <circle cx="12" cy="12" r="3" />
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l0 0a2 2 0 1 1 -2.83 2.83l0 0a1.65 1.65 0 0 0 -1.82 -.33 1.65 1.65 0 0 0 -1 1.51V21a2 2 0 1 1 -4 0v0a1.65 1.65 0 0 0 -1 -1.51 1.65 1.65 0 0 0 -1.82 .33l0 0a2 2 0 1 1 -2.83 -2.83l0 0a1.65 1.65 0 0 0 .33 -1.82A1.65 1.65 0 0 0 3 12.65V12a2 2 0 1 1 4 0v0a1.65 1.65 0 0 0 .5 1.32A1.65 1.65 0 0 0 8.32 13h7.36a1.65 1.65 0 0 0 .82 -.22A1.65 1.65 0 0 0 17 11v-1a2 2 0 1, and so on..." />
        </svg>
        Settings
    </a>
@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-blue-lt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-1">
                                <path d="M12 20h9" />
                                <path d="M12 4h9" />
                                <path d="M4 12h16" />
                                <path d="M4 6h.01" />
                                <path d="M4 18h.01" />
                                <path d="M4 12h.01" />
                            </svg>
                        </span>
                        <div class="ms-3">
                            <h3 class="card-title mb-0">{{ $totalUsers ?? 0 }}</h3>
                            <div class="text-muted">Total Users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-green-lt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-1">
                                <path d="M3 12l2 -2l4 4l8 -8l4 4l4 -4" />
                                <path d="M21 12v7a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-7" />
                                <path d="M5 10v-3a2 2 0 0 1 2 -2h3" />
                            </svg>
                        </span>
                        <div class="ms-3">
                            <h3 class="card-title mb-0">{{ $activeUsers ?? 0 }}</h3>
                            <div class="text-muted">Active Users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-yellow-lt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-1">
                                <path d="M12 3v1" />
                                <path d="M12 20v1" />
                                <path d="M4.22 4.22l.7 .7" />
                                <path d="M18.36 18.36l.7 .7" />
                                <path d="M1 12h1" />
                                <path d="M20 12h1" />
                                <path d="M4.22 19.78l.7 -.7" />
                                <path d="M18.36 5.64l.7 -.7" />
                                <circle cx="12" cy="12" r="5" />
                            </svg>
                        </span>
                        <div class="ms-3">
                            <h3 class="card-title mb-0">{{ $newUsersThisWeek ?? 0 }}</h3>
                            <div class="text-muted">New Users This Week</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-red-lt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-1">
                                <path d="M3 3l18 18" />
                                <path d="M10.584 10.61a3 3 0 0 0 4.207 4.26" />
                                <path d="M9.173 5.176a9 9 0 0 1 9.653 9.65" />
                                <path d="M6.69 7.244a13 13 0 0 1 14.319 14.318" />
                                <path d="M3.6 10.029a17 17 0 0 1 18.375 18.372" />
                            </svg>
                        </span>
                        <div class="ms-3">
                            <h3 class="card-title mb-0">{{ $inactiveUsers ?? 0 }}</h3>
                            <div class="text-muted">Inactive Users</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection