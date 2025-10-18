<a href="{{ route('auth.github') }}" {{ $attributes->merge(['class' => 'btn btn-dark w-100']) }}>
    <x-icon name="brand-github" class="me-2" />
    @if($slot->isEmpty())
        {{ __('Sign in with GitHub') }}
    @else
        {{ $slot }}
    @endif
</a>
