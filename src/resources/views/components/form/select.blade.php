<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif
    
    <select 
        name="{{ $name }}" 
        {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }}
        {{ $required ? 'required' : '' }}
    >
        @if($placeholder)
            <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    
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
