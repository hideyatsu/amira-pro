<button 
    type="{{ $type }}" 
    {{ $attributes->class([$buttonClass()]) }}
    {{ $disabled || $loading ? 'disabled' : '' }}
>
    @if($loading)
        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
    @elseif(isset($icon) && $iconPosition === 'start')
        <span class="icon icon-start me-2">{{ $icon }}</span>
    @endif
    
    {{ $slot }}
    
    @if(isset($icon) && $iconPosition === 'end' && !$loading)
        <span class="icon icon-end ms-2">{{ $icon }}</span>
    @endif
</button>
