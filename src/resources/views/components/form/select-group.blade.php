<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    @if($style === 'buttons')
        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
            @foreach($options as $value => $option)
                <label class="form-selectgroup-item flex-fill">
                    <input
                        type="radio"
                        name="{{ $name }}"
                        value="{{ $value }}"
                        class="form-selectgroup-input"
                        {{ old($name, $selected) == $value ? 'checked' : '' }}
                        {{ $required ? 'required' : '' }}
                    />
                    <div class="form-selectgroup-label d-flex align-items-center p-3">
                        @if(isset($option['icon']))
                            <div class="me-3">
                                <span class="form-selectgroup-check"></span>
                            </div>
                            <div class="form-selectgroup-label-content">
                                <span class="form-selectgroup-title strong mb-1">{{ $option['title'] ?? $option['text'] }}</span>
                                @if(isset($option['description']))
                                    <span class="d-block text-muted">{{ $option['description'] }}</span>
                                @endif
                            </div>
                        @else
                            <div class="me-3">
                                <span class="form-selectgroup-check"></span>
                            </div>
                            <div>{{ is_array($option) ? $option['text'] : $option }}</div>
                        @endif
                    </div>
                </label>
            @endforeach
        </div>
    @elseif($style === 'pills')
        <div class="form-selectgroup">
            @foreach($options as $value => $option)
                <label class="form-selectgroup-item">
                    <input
                        type="radio"
                        name="{{ $name }}"
                        value="{{ $value }}"
                        class="form-selectgroup-input"
                        {{ old($name, $selected) == $value ? 'checked' : '' }}
                        {{ $required ? 'required' : '' }}
                    />
                    <span class="form-selectgroup-label">
                        @if(is_array($option) && isset($option['icon']))
                            <x-icon :name="$option['icon']" class="me-1" size="16" />
                        @endif
                        {{ is_array($option) ? $option['text'] : $option }}
                    </span>
                </label>
            @endforeach
        </div>
    @else
        <div class="form-selectgroup">
            @foreach($options as $value => $option)
                <label class="form-selectgroup-item">
                    <input
                        type="radio"
                        name="{{ $name }}"
                        value="{{ $value }}"
                        class="form-selectgroup-input"
                        {{ old($name, $selected) == $value ? 'checked' : '' }}
                        {{ $required ? 'required' : '' }}
                    />
                    <span class="form-selectgroup-label">{{ is_array($option) ? $option['text'] : $option }}</span>
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
