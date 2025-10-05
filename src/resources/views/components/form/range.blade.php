<div class="mb-3">
    @if($label)
        <label class="form-label">
            {{ $label }}
            @if($showValue)
                <span class="form-label-description" id="range-{{ $name }}-value">{{ old($name, $value ?? $min) }}</span>
            @endif
        </label>
    @endif

    <input
        type="range"
        name="{{ $name }}"
        {{ $attributes->class(['form-range']) }}
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        value="{{ old($name, $value ?? $min) }}"
        @if($showValue)
            oninput="document.getElementById('range-{{ $name }}-value').textContent = this.value"
        @endif
    />

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
