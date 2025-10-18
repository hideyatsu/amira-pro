<div class="mb-3">
    @if($label)
        <label for="{{ $id }}" class="form-label {{ $required ? 'required' : '' }}">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $id }}"
        class="form-select select2 {{ $errors->has($name) ? 'is-invalid' : '' }}"
        {{ $multiple ? 'multiple' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['data-select2-id' => $id]) }}
    >
        @if(!$multiple && !$required)
            <option value="">{{ $placeholder }}</option>
        @endif

        @if(!$serverside)
            @foreach($options as $value => $text)
                <option value="{{ $value }}" {{ $isSelected($value) ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        @else
            {{-- For server-side, show only selected values --}}
            @if($selected)
                @if(is_array($selected))
                    @foreach($selected as $value => $text)
                        <option value="{{ $value }}" selected>{{ $text }}</option>
                    @endforeach
                @else
                    <option value="{{ $selected }}" selected>{{ $selected }}</option>
                @endif
            @endif
        @endif
    </select>

    @if($hint)
        <div class="form-hint">{{ $hint }}</div>
    @endif

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>

@once
    @push('page-styles')
        <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    @endpush

    @push('page-scripts')
        <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    @endpush
@endonce

@push('page-scripts')
    <script>
        $(document).ready(function() {
            $('#{{ $id }}').select2({!! $getConfig() !!});

            // Handle form reset
            $('#{{ $id }}').closest('form').on('reset', function() {
                setTimeout(function() {
                    $('#{{ $id }}').trigger('change.select2');
                }, 10);
            });

            // Handle validation on change
            $('#{{ $id }}').on('change', function() {
                if ($(this).prop('required') && !$(this).val()) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
