<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    <div class="input-group">
        @if($prepend)
            @if(isset($prependSlot))
                {{ $prependSlot }}
            @else
                <span class="input-group-text">{{ $prepend }}</span>
            @endif
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
        />

        @if($append)
            @if(isset($appendSlot))
                {{ $appendSlot }}
            @else
                <span class="input-group-text">{{ $append }}</span>
            @endif
        @endif
    </div>

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
