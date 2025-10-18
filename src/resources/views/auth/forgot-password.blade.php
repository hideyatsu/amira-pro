@section('title', 'Forgot Password')

<x-guest-layout>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Forgot your password?</h2>

            <p class="text-secondary mb-4">
                {{ __('Enter your email address and we will send you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <x-icon name="circle-check" class="alert-icon" />
                        </div>
                        <div>{{ session('status') }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" autocomplete="off" novalidate>
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Email address') }}</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="your@email.com"
                        autocomplete="off"
                        required
                        autofocus
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <x-icon name="mail" class="me-2" />
                        {{ __('Send password reset email') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        {{ __('Remember your password?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
    </div>
</x-guest-layout>
