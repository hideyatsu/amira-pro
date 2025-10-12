@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <div class="row">
        <!-- User Information Card -->
        <div class="col-lg-8">
            <x-card title="User Information">
                <x-slot name="header">
                    <h3 class="card-title">User Information</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Users
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">
                            <x-icon name="edit" class="me-2" />
                            Edit User
                        </a>
                    </div>
                </x-slot>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Full Name</label>
                            <div class="fw-bold">{{ $user->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Email Address</label>
                            <div class="fw-bold">
                                {{ $user->email }}
                                @if($user->email_verified_at)
                                    <span class="badge bg-success ms-2">
                                        <x-icon name="check" class="me-1" />
                                        Verified
                                    </span>
                                @else
                                    <span class="badge bg-warning ms-2">
                                        <x-icon name="alert-triangle" class="me-1" />
                                        Unverified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Member Since</label>
                            <div class="fw-bold">{{ $user->created_at->format('F j, Y') }}</div>
                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Last Updated</label>
                            <div class="fw-bold">{{ $user->updated_at->format('F j, Y g:i A') }}</div>
                            <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>

                @if($user->email_verified_at)
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Email Verified At</label>
                            <div class="fw-bold">{{ $user->email_verified_at->format('F j, Y g:i A') }}</div>
                            <small class="text-muted">{{ $user->email_verified_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @endif
            </x-card>
        </div>

        <!-- User Status & Actions Card -->
        <div class="col-lg-4">
            <x-card title="Quick Actions">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                        <x-icon name="edit" class="me-2" />
                        Edit User
                    </a>
                    
                    @if(!$user->email_verified_at)
                    <form method="POST" action="{{ route('admin.users.verify-email', $user) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <x-icon name="mail-check" class="me-2" />
                            Verify Email
                        </button>
                    </form>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.users.reset-password', $user) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100" 
                                onclick="return confirm('Send password reset email to this user?')">
                            <x-icon name="key" class="me-2" />
                            Reset Password
                        </button>
                    </form>
                    
                    @if($user->id !== request()->user()->id)
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            <x-icon name="trash" class="me-2" />
                            Delete User
                        </button>
                    </form>
                    @endif
                </div>

                <hr>

                <div class="mt-3">
                    <label class="form-label text-muted">User ID</label>
                    <div class="fw-bold font-monospace">#{{ $user->id }}</div>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Roles & Permissions -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <x-card title="Assigned Roles">
                @if($user->roles->count() > 0)
                    <div class="row g-2">
                        @foreach($user->roles as $role)
                            <div class="col-auto">
                                <span class="badge bg-blue fs-7">
                                    <x-icon name="shield" class="me-1" />
                                    {{ ucfirst($role->name) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="text-muted">
                        <x-icon name="info-circle" class="me-1" />
                        This user has {{ $user->roles->count() }} role(s) assigned.
                    </div>
                @else
                    <div class="text-center py-4">
                        <x-icon name="shield-off" class="text-muted mb-2" size="48" />
                        <div class="text-muted">No roles assigned to this user.</div>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary mt-2">
                            Assign Roles
                        </a>
                    </div>
                @endif
            </x-card>
        </div>

        <div class="col-lg-6">
            <x-card title="Direct Permissions">
                @if($user->permissions->count() > 0)
                    <div class="row g-2">
                        @foreach($user->permissions as $permission)
                            <div class="col-auto">
                                <span class="badge bg-green fs-7">
                                    <x-icon name="key" class="me-1" />
                                    {{ $permission->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="text-muted">
                        <x-icon name="info-circle" class="me-1" />
                        This user has {{ $user->permissions->count() }} direct permission(s).
                    </div>
                @else
                    <div class="text-center py-4">
                        <x-icon name="key-off" class="text-muted mb-2" size="48" />
                        <div class="text-muted">No direct permissions assigned.</div>
                        <div class="text-muted small">Permissions are inherited from roles.</div>
                    </div>
                @endif
            </x-card>
        </div>
    </div>

    <!-- Activity Log (if you want to add this feature later) -->
    <!--
    <div class="row mt-4">
        <div class="col-12">
            <x-card title="Recent Activity">
                <div class="text-center py-4">
                    <x-icon name="activity" class="text-muted mb-2" size="48" />
                    <div class="text-muted">Activity logging feature coming soon.</div>
                </div>
            </x-card>
        </div>
    </div>
    -->
@endsection

@push('scripts')
<script>
    // Copy user ID to clipboard
    document.addEventListener('DOMContentLoaded', function() {
        const userIdElement = document.querySelector('.font-monospace');
        if (userIdElement) {
            userIdElement.style.cursor = 'pointer';
            userIdElement.title = 'Click to copy User ID';
            
            userIdElement.addEventListener('click', function() {
                navigator.clipboard.writeText('{{ $user->id }}').then(function() {
                    // Show toast notification (if you have toast system)
                    console.log('User ID copied to clipboard');
                });
            });
        }
    });
</script>
@endpush
