<div class="mb-3">
    <label class="form-check form-switch">
        <input
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $attributes->class(['form-check-input', 'form-check-input-' . $size => $size !== 'default']) }}
            {{ old($name, $checked) ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />
        @if($label)
            <span class="form-check-label">{{ $label }}</span>
        @endif
    </label>

    @if($description)
        <small class="form-hint">{{ $description }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
