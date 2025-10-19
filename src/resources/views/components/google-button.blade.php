<a href="{{ route('auth.google') }}" {{ $attributes->merge(['class' => 'btn btn-google w-100']) }}>
    <x-icon name="brand-google" class="me-2" />
    @if($slot->isEmpty())
        {{ __('Login with Google') }}
    @else
        {{ $slot }}
    @endif
</a>
