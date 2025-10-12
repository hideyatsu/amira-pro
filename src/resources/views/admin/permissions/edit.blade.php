@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">Edit Permission: {{ $permission->name }}</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Permissions
                        </a>
                        <a href="{{ route('admin.permissions.show', $permission) }}" class="btn btn-outline-info btn-sm">
                            <x-icon name="eye" class="me-2" />
                            View Details
                        </a>
                    </div>
                </x-slot>

                <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                    @csrf
                    @method('PUT')

                    <!-- Permission Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <x-form.input-group
                                label="Permission Name"
                                name="name"
                                type="text"
                                :value="old('name', $permission->name)"
                                placeholder="e.g., view users, create posts"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <x-form.select-group
                                label="Guard Name"
                                name="guard_name"
                                :options="[
                                    'web' => 'Web'
                                ]"
                                :selected="old('guard_name', $permission->guard_name)"
                                required
                            />
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="mb-3">
                        <label class="form-label">Assign to Roles</label>
                        <div class="card">
                            <div class="card-body">
                                @if($roles->count() > 0)
                                    <div class="row">
                                        @foreach($roles as $role)
                                            <div class="col-md-3 mb-2">
                                                <label class="form-check">
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input"
                                                        name="roles[]"
                                                        value="{{ $role->name }}"
                                                        {{ in_array($role->name, old('roles', $permission->roles->pluck('name')->toArray())) ? 'checked' : '' }}
                                                    />
                                                    <span class="form-check-label">{{ $role->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <x-icon name="shield-off" class="text-muted mb-2" size="48" />
                                        <div class="text-muted">No roles available.</div>
                                        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                                            Create Role
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                            <x-icon name="x" class="me-2" />
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <x-icon name="check" class="me-2" />
                            Update Permission
                        </button>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Current Permission Info -->
        <div class="col-lg-4">
            <x-card title="Current Permission Info">
                <div class="mb-3">
                    <label class="form-label text-muted">Permission ID</label>
                    <div class="fw-bold font-monospace">#{{ $permission->id }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Created At</label>
                    <div class="fw-bold">{{ $permission->created_at->format('F j, Y') }}</div>
                    <small class="text-muted">{{ $permission->created_at->diffForHumans() }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Last Updated</label>
                    <div class="fw-bold">{{ $permission->updated_at->format('F j, Y g:i A') }}</div>
                    <small class="text-muted">{{ $permission->updated_at->diffForHumans() }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Roles with this Permission</label>
                    <div class="fw-bold">{{ $permission->roles()->count() }} roles</div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Direct User Assignments</label>
                    <div class="fw-bold">{{ $permission->users()->count() }} users</div>
                </div>

                <div class="alert alert-warning">
                    <x-icon name="alert-triangle" class="me-2" />
                    <strong>Warning:</strong> Changes will affect all roles and users with this permission.
                </div>
            </x-card>
        </div>
    </div>
@endsection
