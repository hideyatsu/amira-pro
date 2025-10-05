<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    @if($dropzone)
        <div class="dropzone">
            <div class="fallback">
                <input
                    type="file"
                    name="{{ $name }}{{ $multiple ? '[]' : '' }}"
                    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
                    {{ $multiple ? 'multiple' : '' }}
                    {{ $accept ? 'accept=' . $accept : '' }}
                    {{ $required ? 'required' : '' }}
                />
            </div>
            <div class="dz-message" data-dz-message>
                <span>{{ $placeholder }}</span>
            </div>
        </div>
    @else
        <input
            type="file"
            name="{{ $name }}{{ $multiple ? '[]' : '' }}"
            {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
            {{ $multiple ? 'multiple' : '' }}
            {{ $accept ? 'accept=' . $accept : '' }}
            {{ $required ? 'required' : '' }}
        />
    @endif

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
