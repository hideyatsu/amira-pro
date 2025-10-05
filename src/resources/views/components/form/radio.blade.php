<label class="form-check">
    <input 
        {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}
        type="radio" 
        name="{{ $name }}"
        value="{{ $value }}"
        {{ old($name) == $value || $checked ? 'checked' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    />
    <span class="form-check-label">{{ $label }}</span>
</label>
