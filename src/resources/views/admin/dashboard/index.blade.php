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
        <x-icon name="settings" class="icon-2 me-2" />
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
                            <x-icon name="list" class="icon-1" />
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
                            <x-icon name="trending-up" class="icon-1" />
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
                            <x-icon name="brightness" class="icon-1" />
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
                            <x-icon name="circle-dot" class="icon-1" />
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