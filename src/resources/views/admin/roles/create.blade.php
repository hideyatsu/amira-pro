@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">Create New Role</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Roles
                        </a>
                    </div>
                </x-slot>

                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf

                    <!-- Role Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <x-form.input-group
                                label="Role Name"
                                name="name"
                                type="text"
                                :value="old('name')"
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
                                :selected="old('guard_name', 'web')"
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
                                                                {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
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
                            Create Role
                        </button>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Help Card -->
        <div class="col-lg-4">
            <x-card title="Help & Tips">
                <div class="mb-3">
                    <h6><x-icon name="info-circle" class="me-2" />Role Guidelines</h6>
                    <ul class="list-unstyled small text-muted">
                        <li>• Use descriptive names like "Admin", "Editor", "Viewer"</li>
                        <li>• Keep role names simple and clear</li>
                        <li>• Assign relevant permissions based on user needs</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h6><x-icon name="shield" class="me-2" />Permission Groups</h6>
                    <p class="small text-muted">
                        Permissions are automatically grouped by their resource type for easier management.
                    </p>
                </div>

                <div class="alert alert-info">
                    <x-icon name="alert-triangle" class="me-2" />
                    <strong>Note:</strong> You can modify permissions after creating the role.
                </div>
            </x-card>
        </div>
    </div>
@endsection
