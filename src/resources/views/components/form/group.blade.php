<div {{ $attributes->class(['mb-3', 'row']) }}>
    <label class="col-{{ $labelCol }} col-form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    <div class="col">
        {{ $slot }}
        
        @if($hint)
            <small class="form-hint">{{ $hint }}</small>
        @endif
        
        @if($name)
            @error($name)
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        @endif
    </div>
</div>
