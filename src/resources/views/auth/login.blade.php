@section('title', 'Sign In')

<x-guest-layout>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>

            <!-- Session Status (Success) -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div class="me-2">
                            <x-icon name="circle-check" class="alert-icon" />
                        </div>
                        <div>{{ session('status') }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <!-- Session Error Messages -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div class="me-2">
                            <x-icon name="alert-triangle" class="alert-icon" />
                        </div>
                        <div>{{ session('error') }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <!-- Success Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div class="me-2">
                            <x-icon name="circle-check" class="alert-icon" />
                        </div>
                        <div>{{ session('success') }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
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

                <!-- Password -->
                <div class="mb-2">
                    <label class="form-label">
                        {{ __('Password') }}
                        @if (Route::has('password.request'))
                            <span class="form-label-description">
                                <a href="{{ route('password.request') }}">{{ __('I forgot password') }}</a>
                            </span>
                        @endif
                    </label>
                    <div class="input-group input-group-flat">
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="Your password"
                            autocomplete="current-password"
                            required
                        />
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword(this, event)">
                                <x-icon name="eye" class="icon-tabler-eye" />
                            </a>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }} />
                        <span class="form-check-label">{{ __('Remember me on this device') }}</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Sign in') }}</button>
                </div>
            </form>

            <div class="hr-text">or</div>

            <!-- Social Login Buttons -->
            <div class="row">
                <div class="col">
                    <x-google-button />
                </div>
                <div class="col">
                    <x-github-button />
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function togglePassword(element, event) {
            event.preventDefault();
            const input = element.closest('.input-group').querySelector('input');
            const iconWrapper = element.querySelector('svg');

            if (input.type === 'password') {
                input.type = 'text';
                // Change to eye-off icon
                iconWrapper.innerHTML = '<path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" />';
                element.setAttribute('title', 'Hide password');
            } else {
                input.type = 'password';
                // Change to eye icon
                iconWrapper.innerHTML = '<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />';
                element.setAttribute('title', 'Show password');
            }
        }
    </script>
    @endpush
</x-guest-layout>
