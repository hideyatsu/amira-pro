<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    <input
        type="text"
        name="{{ $name }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        placeholder="{{ $placeholder ?: $mask }}"
        value="{{ old($name, $value) }}"
        data-mask="{{ $mask }}"
        {{ $required ? 'required' : '' }}
    />

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize input masks
    const maskedInputs = document.querySelectorAll('[data-mask]');
    maskedInputs.forEach(input => {
        const mask = input.getAttribute('data-mask');

        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let formattedValue = '';
            let valueIndex = 0;

            for (let i = 0; i < mask.length && valueIndex < value.length; i++) {
                if (mask[i] === '9') {
                    formattedValue += value[valueIndex];
                    valueIndex++;
                } else {
                    formattedValue += mask[i];
                }
            }

            e.target.value = formattedValue;
        });
    });
});
</script>
@endpush
