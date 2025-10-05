<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif
    
    @if(isset($icon))
        <div class="input-icon">
            <span class="input-icon-addon">
                {{ $icon }}
            </span>
            <input 
                type="{{ $type }}" 
                name="{{ $name }}" 
                {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
                placeholder="{{ $placeholder }}"
                value="{{ old($name, $value) }}"
                {{ $required ? 'required' : '' }}
            />
        </div>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
        />
    @endif
    
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
