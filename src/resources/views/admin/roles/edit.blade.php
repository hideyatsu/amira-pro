@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">Edit Role: {{ $role->name }}</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Roles
                        </a>
                        <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-outline-info btn-sm">
                            <x-icon name="eye" class="me-2" />
                            View Details
                        </a>
                    </div>
                </x-slot>

                <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                    @csrf
                    @method('PUT')

                    <!-- Role Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <x-form.input-group
                                label="Role Name"
                                name="name"
                                type="text"
                                :value="old('name', $role->name)"
                                placeholder="Enter role name"
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
                                :selected="old('guard_name', $role->guard_name)"
                                required
                            />
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="card">
                            <div class="card-body">
                                @if($permissions->count() > 0)
                                    @foreach($permissions as $group => $groupPermissions)
                                        <div class="mb-3">
                                            <h5 class="card-title text-capitalize">{{ $group }} Permissions</h5>
                                            <div class="row">
                                                @foreach($groupPermissions as $permission)
                                                    <div class="col-md-3 mb-2">
                                                        <label class="form-check">
                                                            <input
                                                                type="checkbox"
                                                                class="form-check-input"
                                                                name="permissions[]"
                                                                value="{{ $permission->name }}"
                                                                {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}
                                                            />
                                                            <span class="form-check-label">{{ $permission->name }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="text-center py-4">
                                        <x-icon name="shield-off" class="text-muted mb-2" size="48" />
                                        <div class="text-muted">No permissions available.</div>
                                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                                            Create Permission
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
                            <x-icon name="x" class="me-2" />
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <x-icon name="check" class="me-2" />
                            Update Role
                        </button>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Current Role Info -->
        <div class="col-lg-4">
            <x-card title="Current Role Info">
                <div class="mb-3">
                    <label class="form-label text-muted">Role ID</label>
                    <div class="fw-bold font-monospace">#{{ $role->id }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Created At</label>
                    <div class="fw-bold">{{ $role->created_at->format('F j, Y') }}</div>
                    <small class="text-muted">{{ $role->created_at->diffForHumans() }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Last Updated</label>
                    <div class="fw-bold">{{ $role->updated_at->format('F j, Y g:i A') }}</div>
                    <small class="text-muted">{{ $role->updated_at->diffForHumans() }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Users with this Role</label>
                    <div class="fw-bold">{{ $role->users()->count() }} users</div>
                </div>

                <div class="alert alert-warning">
                    <x-icon name="alert-triangle" class="me-2" />
                    <strong>Warning:</strong> Changes will affect all users with this role.
                </div>
            </x-card>
        </div>
    </div>
@endsection
