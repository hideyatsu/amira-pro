<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif
    
    <textarea 
        name="{{ $name }}" 
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
    >{{ old($name, $value) }}</textarea>
    
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
