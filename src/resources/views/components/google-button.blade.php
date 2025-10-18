<a href="{{ route('auth.google') }}" {{ $attributes->merge(['class' => 'btn btn-danger w-100']) }}>
    <x-icon name="brand-google" class="me-2" />
    @if($slot->isEmpty())
        {{ __('Sign in with Google') }}
    @else
        {{ $slot }}
    @endif
</a>
