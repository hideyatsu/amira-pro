@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
    <div class="row">
        <div class="col-12">
            <x-card title="Create New User">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf

                    <div class="row g-2">
                        <div class="col-md">
                            <x-input-label for="name" :value="__('Full Name')" class="form-label" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="form-control"
                                :value="old('name')"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="col-md">
                            <x-input-label for="email" :value="__('Email Address')" class="form-label" />
                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                class="form-control"
                                :value="old('email')"
                                required
                                autocomplete="username"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md">
                            <x-input-label for="password" :value="__('Password')" class="form-label" />
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                required
                                autocomplete="new-password"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            <div class="form-hint">
                                Password must be at least 8 characters long.
                            </div>
                        </div>

                        <div class="col-md">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                required
                                autocomplete="new-password"
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                        </div>
                    </div>

                    @if($roles ?? false)
                    <div class="row">
                        <div class="col-12">
                            <x-select2
                                name="roles"
                                :label="__('Assign Roles')"
                                placeholder="Select roles..."
                                :multiple="true"
                                :options="$roles->pluck('name', 'name')->map(fn($name) => ucfirst($name))->toArray()"
                                :selected="old('roles', [])"
                                hint="Hold Ctrl/Cmd to select multiple roles."
                                :additional-config="['closeOnSelect' => false]"
                            />
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="email_verified"
                                    id="email_verified"
                                    value="1"
                                    {{ old('email_verified') ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="email_verified">
                                    Mark email as verified
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('email_verified')" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="btn-list">
                                    <x-primary-button class="btn btn-primary btn-sm">
                                        <x-icon name="user-plus" class="me-2" />
                                        {{ __('Create User') }}
                                    </x-primary-button>

                                    <a href="#" onclick="window.history.back()" class="btn btn-outline-secondary btn-sm">
                                        <x-icon name="arrow-left" class="me-2" />
                                        {{ __('Cancel') }}
                                    </a>
                                </div>

                                <small class="text-muted">
                                    <x-icon name="info-circle" class="me-1" />
                                    All fields marked with * are required
                                </small>
                            </div>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>

    @if($errors->any())
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <x-icon name="alert-circle" class="me-2" />
                        </div>
                        <div>
                            <h4 class="alert-title">Validation Error!</h4>
                            <div class="text-secondary">Please check the form and fix the following errors:</div>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    // Enhanced form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');

        // Real-time password confirmation validation
        confirmPasswordField.addEventListener('input', function() {
            if (passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity('Passwords do not match');
            } else {
                confirmPasswordField.setCustomValidity('');
            }
        });

        // Form submission with loading state
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            const btnText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating...';

            // Re-enable on error (if form doesn't submit)
            setTimeout(() => {
                if (!form.checkValidity()) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;
                }
            }, 100);
        });
    });
</script>
@endpush
