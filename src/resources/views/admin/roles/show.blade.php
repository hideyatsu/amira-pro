@extends('layouts.admin')

@section('title', 'Role Details')

@section('content')
    <div class="row">
        <!-- Role Information Card -->
        <div class="col-lg-8">
            <x-card title="Role Information">
                <x-slot name="header">
                    <h3 class="card-title">Role Information</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Roles
                        </a>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">
                            <x-icon name="edit" class="me-2" />
                            Edit Role
                        </a>
                    </div>
                </x-slot>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Role Name</label>
                            <div class="fw-bold">{{ $role->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Guard Name</label>
                            <div class="fw-bold">{{ $role->guard_name }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Created At</label>
                            <div class="fw-bold">{{ $role->created_at->format('F j, Y') }}</div>
                            <small class="text-muted">{{ $role->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Last Updated</label>
                            <div class="fw-bold">{{ $role->updated_at->format('F j, Y g:i A') }}</div>
                            <small class="text-muted">{{ $role->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Role Status & Actions Card -->
        <div class="col-lg-4">
            <x-card title="Quick Actions">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                        <x-icon name="edit" class="me-2" />
                        Edit Role
                    </a>

                    @if($role->users()->count() == 0)
                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100"
                                onclick="return confirm('Are you sure you want to delete this role? This action cannot be undone.')">
                            <x-icon name="trash" class="me-2" />
                            Delete Role
                        </button>
                    </form>
                    @else
                    <div class="alert alert-warning mb-0">
                        <x-icon name="alert-triangle" class="me-2" />
                        Cannot delete role with assigned users.
                    </div>
                    @endif
                </div>

                <hr>

                <div class="mt-3">
                    <label class="form-label text-muted">Role ID</label>
                    <div class="fw-bold font-monospace">#{{ $role->id }}</div>
                </div>

                <div class="mt-3">
                    <label class="form-label text-muted">Users Count</label>
                    <div class="fw-bold">{{ $role->users()->count() }} users</div>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Assigned Permissions -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <x-card title="Assigned Permissions">
                @if($role->permissions->count() > 0)
                    <div class="row g-2">
                        @foreach($role->permissions as $permission)
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
                        This role has {{ $role->permissions->count() }} permission(s) assigned.
                    </div>
                @else
                    <div class="text-center py-4">
                        <x-icon name="key-off" class="text-muted mb-2" size="48" />
                        <div class="text-muted">No permissions assigned to this role.</div>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-primary mt-2">
                            Assign Permissions
                        </a>
                    </div>
                @endif
            </x-card>
        </div>

        <div class="col-lg-6">
            <x-card title="Users with this Role">
                @if($role->users->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($role->users->take(10) as $user)
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

                    @if($role->users->count() > 10)
                        <div class="text-center mt-3">
                            <small class="text-muted">And {{ $role->users->count() - 10 }} more users...</small>
                        </div>
                    @endif

                    <hr class="my-3">

                    <div class="text-muted">
                        <x-icon name="info-circle" class="me-1" />
                        This role is assigned to {{ $role->users->count() }} user(s).
                    </div>
                @else
                    <div class="text-center py-4">
                        <x-icon name="users" class="text-muted mb-2" size="48" />
                        <div class="text-muted">No users have this role yet.</div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Create User
                        </a>
                    </div>
                @endif
            </x-card>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Copy role ID to clipboard
    document.addEventListener('DOMContentLoaded', function() {
        const roleIdElement = document.querySelector('.font-monospace');
        if (roleIdElement) {
            roleIdElement.style.cursor = 'pointer';
            roleIdElement.title = 'Click to copy Role ID';

            roleIdElement.addEventListener('click', function() {
                navigator.clipboard.writeText('{{ $role->id }}').then(function() {
                    console.log('Role ID copied to clipboard');
                });
            });
        }
    });
</script>
@endpush
