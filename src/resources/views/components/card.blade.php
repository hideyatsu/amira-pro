<div {{ $attributes->class(['card', $cardClass]) }}>
    @if($title || isset($header))
        <div class="card-header {{ $headerClass }}">
            @isset($header)
                {{ $header }}
            @else
                <h3 class="card-title">{{ $title }}</h3>
            @endisset
        </div>
    @endif
    
    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>
</div>
