<div class="mb-3">
    @if($label)
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-muted">{{ $label }}</span>
            <span class="text-muted">{{ $percentage() }}%</span>
        </div>
    @endif

    <div {{ $attributes->class([
        'progress',
        'progress-sm' => $size === 'sm',
        'progress-lg' => $size === 'lg'
    ]) }}>
        <div
            class="progress-bar bg-{{ $color }} {{ $striped ? 'progress-bar-striped' : '' }} {{ $animated ? 'progress-bar-animated' : '' }}"
            role="progressbar"
            style="width: {{ $percentage() }}%"
            aria-valuenow="{{ $value }}"
            aria-valuemin="0"
            aria-valuemax="{{ $max }}"
        >
            @if($slot->isNotEmpty())
                {{ $slot }}
            @elseif(!$label)
                {{ $percentage() }}%
            @endif
        </div>
    </div>
</div>
