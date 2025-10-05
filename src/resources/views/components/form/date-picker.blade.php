<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    @if($inline)
        <div class="card">
            <div class="card-body">
                <div id="datepicker-{{ $name }}" data-name="{{ $name }}"></div>
                <input type="hidden" name="{{ $name }}" value="{{ old($name, $value) }}" />
            </div>
        </div>
    @else
        <div class="input-icon">
            <span class="input-icon-addon">
                <x-icon name="calendar" size="16" />
            </span>
            <input
                type="date"
                name="{{ $name }}"
                {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
                value="{{ old($name, $value) }}"
                {{ $required ? 'required' : '' }}
                {{ $minDate ? 'min=' . $minDate : '' }}
                {{ $maxDate ? 'max=' . $maxDate : '' }}
            />
        </div>
    @endif

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if($inline)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize inline datepicker
    // You can integrate with libraries like Litepicker or Flatpickr here
    const datepicker = document.getElementById('datepicker-{{ $name }}');
    if (datepicker) {
        // Simple calendar implementation or library integration
    }
});
</script>
@endpush
@endif
