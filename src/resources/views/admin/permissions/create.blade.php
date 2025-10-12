@extends('layouts.admin')

@section('title', 'Create Permission')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">Create New Permission</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary btn-sm">
                            <x-icon name="arrow-left" class="me-2" />
                            Back to Permissions
                        </a>
                    </div>
                </x-slot>

                <form method="POST" action="{{ route('admin.permissions.store') }}">
                    @csrf

                    <!-- Permission Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <x-form.input-group
                                label="Permission Name"
                                name="name"
                                type="text"
                                :value="old('name')"
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
                                :selected="old('guard_name', 'web')"
                                required
                            />
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="mb-3">
                        <label class="form-label">Assign to Roles (Optional)</label>
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
                                                        {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}
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
                            Create Permission
                        </button>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Help Card -->
        <div class="col-lg-4">
            <x-card title="Help & Tips">
                <div class="mb-3">
                    <h6><x-icon name="info-circle" class="me-2" />Permission Guidelines</h6>
                    <ul class="list-unstyled small text-muted">
                        <li>• Use descriptive action names like "view users", "create posts"</li>
                        <li>• Follow pattern: [action] [resource]</li>
                        <li>• Be specific about what the permission allows</li>
                        <li>• Use lowercase with spaces or dashes</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h6><x-icon name="key" class="me-2" />Common Examples</h6>
                    <ul class="list-unstyled small text-muted">
                        <li>• view users</li>
                        <li>• create users</li>
                        <li>• edit users</li>
                        <li>• delete users</li>
                        <li>• manage roles</li>
                        <li>• view dashboard</li>
                    </ul>
                </div>

                <div class="alert alert-info">
                    <x-icon name="alert-triangle" class="me-2" />
                    <strong>Note:</strong> You can assign this permission to roles after creation.
                </div>
            </x-card>
        </div>
    </div>
@endsection
