<a href="{{ route('auth.github') }}" {{ $attributes->merge(['class' => 'btn btn-github w-100']) }}>
    <x-icon name="brand-github" class="me-2" />
    @if($slot->isEmpty())
        {{ __('Login with GitHub') }}
    @else
        {{ $slot }}
    @endif
</a>
