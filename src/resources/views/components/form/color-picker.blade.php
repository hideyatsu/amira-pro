<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    <div class="row g-2">
        <div class="col-auto">
            <label class="form-colorinput">
                <input
                    type="color"
                    name="{{ $name }}"
                    value="{{ old($name, $value ?? '#206bc4') }}"
                    {{ $attributes->class(['form-colorinput-input']) }}
                    {{ $required ? 'required' : '' }}
                />
                <span class="form-colorinput-color" style="color: {{ old($name, $value ?? '#206bc4') }}"></span>
            </label>
        </div>
        <div class="col">
            <input
                type="text"
                {{ $attributes->class(['form-control', 'form-control-color', 'is-invalid' => $errors->has($name)]) }}
                value="{{ old($name, $value ?? '#206bc4') }}"
                readonly
            />
        </div>
    </div>

    @if(!empty($presetColors))
        <div class="form-colorinput-wrapper mt-2">
            @foreach($presetColors as $color)
                <label class="form-colorinput form-colorinput-light">
                    <input
                        type="radio"
                        name="{{ $name }}_preset"
                        value="{{ $color }}"
                        class="form-colorinput-input"
                        onchange="document.querySelector('input[name=\'{{ $name }}\']').value = this.value; document.querySelector('input[name=\'{{ $name }}\']').dispatchEvent(new Event('change'));"
                    />
                    <span class="form-colorinput-color" style="color: {{ $color }}"></span>
                </label>
            @endforeach
        </div>
    @endif

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
