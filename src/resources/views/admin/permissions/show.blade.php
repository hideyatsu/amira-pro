@extends('layouts.admin')

@section('title', 'Permission Details')

@section('content')
    <div class="row">
        <!-- Permission Information Card -->
        <div class="col-lg-8">
            <x-card title="Permission Information">
                <x-slot name="header">
                    <h3 class="card-title">Permission Information</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Permissions
                        </a>
                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary btn-sm">
                            <x-icon name="edit" class="me-2" />
                            Edit Permission
                        </a>
                    </div>
                </x-slot>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Permission Name</label>
                            <div class="fw-bold">{{ $permission->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Guard Name</label>
                            <div class="fw-bold">{{ $permission->guard_name }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Created At</label>
                            <div class="fw-bold">{{ $permission->created_at->format('F j, Y') }}</div>
                            <small class="text-muted">{{ $permission->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Last Updated</label>
                            <div class="fw-bold">{{ $permission->updated_at->format('F j, Y g:i A') }}</div>
                            <small class="text-muted">{{ $permission->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Permission Status & Actions Card -->
        <div class="col-lg-4">
            <x-card title="Quick Actions">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary btn-sm">
                        <x-icon name="edit" class="me-2" />
                        Edit Permission
                    </a>

                    @if($permission->roles()->count() == 0 && $permission->users()->count() == 0)
                    <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                onclick="return confirm('Are you sure you want to delete this permission? This action cannot be undone.')">
                            <x-icon name="trash" class="me-2" />
                            Delete Permission
                        </button>
                    </form>
                    @else
                    <div class="alert alert-warning mb-0">
                        <x-icon name="alert-triangle" class="me-2" />
                        Cannot delete permission assigned to roles or users.
                    </div>
                    @endif
                </div>

                <hr>

                <div class="mt-3">
                    <label class="form-label text-muted">Permission ID</label>
                    <div class="fw-bold font-monospace">#{{ $permission->id }}</div>
                </div>

                <div class="mt-3">
                    <label class="form-label text-muted">Roles Count</label>
                    <div class="fw-bold">{{ $permission->roles()->count() }} roles</div>
                </div>

                <div class="mt-3">
                    <label class="form-label text-muted">Direct Users</label>
                    <div class="fw-bold">{{ $permission->users()->count() }} users</div>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Assigned Roles -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <x-card title="Assigned to Roles">
                @if($permission->roles->count() > 0)
                    <div class="row g-2">
                        @foreach($permission->roles as $role)
                            <div class="col-auto">
                                <span class="badge bg-blue fs-7">
                                    <x-icon name="shield" class="me-1" />
                                    {{ $role->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-3">

                    <div class="text-muted">
                        <x-icon name="info-circle" class="me-1" />
                        This permission is assigned to {{ $permission->roles->count() }} role(s).
                    </div>
                @else
                    <div class="text-center py-4">
                        <x-icon name="shield-off" class="text-muted mb-2" size="48" />
                        <div class="text-muted">No roles have this permission.</div>
                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-sm btn-outline-primary mt-2">
                            Assign to Roles
                        </a>
                    </div>
                @endif
            </x-card>
        </div>

        <div class="col-lg-6">
            <x-card title="Direct User Assignments">
                @if($permission->users->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($permission->users->take(10) as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </div>
                        @endforeach
                    </div>

                    @if($permission->users->count() > 10)
                        <div class="text-center mt-3">
                            <small class="text-muted">And {{ $permission->users->count() - 10 }} more users...</small>
                        </div>
                    @endif

                    <hr class="my-3">

                    <div class="text-muted">
                        <x-icon name="info-circle" class="me-1" />
                        This permission is directly assigned to {{ $permission->users->count() }} user(s).
                    </div>
                @else
                    <div class="text-center py-4">
                        <x-icon name="users" class="text-muted mb-2" size="48" />
                        <div class="text-muted">No users have this permission directly.</div>
                        <div class="text-muted small">Users get this permission through roles.</div>
                    </div>
                @endif
            </x-card>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Copy permission ID to clipboard
    document.addEventListener('DOMContentLoaded', function() {
        const permissionIdElement = document.querySelector('.font-monospace');
        if (permissionIdElement) {
            permissionIdElement.style.cursor = 'pointer';
            permissionIdElement.title = 'Click to copy Permission ID';

            permissionIdElement.addEventListener('click', function() {
                navigator.clipboard.writeText('{{ $permission->id }}').then(function() {
                    console.log('Permission ID copied to clipboard');
                });
            });
        }
    });
</script>
@endpush
