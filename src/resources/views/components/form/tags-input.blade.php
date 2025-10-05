<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}">{{ $label }}</label>
    @endif

    <select
        name="{{ $name }}[]"
        {{ $attributes->class(['form-select', 'is-invalid' => $errors->has($name)]) }}
        multiple
        data-bs-toggle="tags"
        {{ $required ? 'required' : '' }}
    >
        @if(is_array(old($name, $value)))
            @foreach(old($name, $value) as $tag)
                <option value="{{ $tag }}" selected>{{ $tag }}</option>
            @endforeach
        @endif
    </select>

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
    // Initialize tags input
    const tagInputs = document.querySelectorAll('[data-bs-toggle="tags"]');
    tagInputs.forEach(input => {
        // Simple tags implementation
        // You can integrate with libraries like Tom Select or Tagify here
    });
});
</script>
@endpush
