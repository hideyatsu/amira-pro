@section('title', 'Sign Up')

<x-guest-layout>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Create new account</h2>
            
            <form method="POST" action="{{ route('register') }}" autocomplete="off" novalidate>
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your name" 
                        autocomplete="name"
                        required 
                        autofocus 
                    />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Email address') }}</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="your@email.com" 
                        autocomplete="username"
                        required 
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Password') }}</label>
                    <div class="input-group input-group-flat">
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            name="password"
                            placeholder="Your password" 
                            autocomplete="new-password"
                            required 
                        />
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword(this, event)">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler-eye">
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group input-group-flat">
                        <input 
                            type="password" 
                            class="form-control @error('password_confirmation') is-invalid @enderror" 
                            name="password_confirmation"
                            placeholder="Confirm your password" 
                            autocomplete="new-password"
                            required 
                        />
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip" onclick="togglePassword(this, event)">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler-eye">
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Create new account') }}</button>
                </div>
            </form>
        </div>
        
        <div class="hr-text">or</div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                        {{ __('Sign in to account') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        {{ __('Already have an account?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
    </div>

    @push('scripts')
    <script>
        function togglePassword(element, event) {
            event.preventDefault();
            const input = element.closest('.input-group').querySelector('input');
            const icon = element.querySelector('svg');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" />';
                element.setAttribute('title', 'Hide password');
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />';
                element.setAttribute('title', 'Show password');
            }
        }
    </script>
    @endpush
</x-guest-layout>
