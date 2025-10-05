<div class="mb-3">
    <label class="form-check">
        <input 
            type="checkbox" 
            name="{{ $name }}" 
            value="{{ $value }}"
            {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}
            {{ old($name, $checked) ? 'checked' : '' }}
        />
        @if($label)
            <span class="form-check-label">{{ $label }}</span>
        @endif
    </label>
    
    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    @if($error && !$errors->has($name))
        <div class="invalid-feedback d-block">{{ $error }}</div>
    @endif
</div>
