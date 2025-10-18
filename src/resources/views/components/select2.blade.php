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
        <style>
            /* Dark Mode Support for Select2 */
            [data-bs-theme="dark"] .select2-container--bootstrap-5 .select2-selection {
                background-color: var(--tblr-bg-surface-dark);
                border-color: var(--tblr-border-color-dark);
                color: var(--tblr-body-color);
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
                color: var(--tblr-body-color);
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered {
                color: var(--tblr-body-color);
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
                background-color: var(--tblr-primary);
                border-color: var(--tblr-primary);
                color: #fff;
            }

            [data-bs-theme="dark"] .select2-dropdown {
                background-color: var(--tblr-bg-surface-dark);
                border-color: var(--tblr-border-color-dark);
            }

            [data-bs-theme="dark"] .select2-search--dropdown .select2-search__field {
                background-color: var(--tblr-bg-surface-dark);
                border-color: var(--tblr-border-color-dark);
                color: var(--tblr-body-color);
            }

            [data-bs-theme="dark"] .select2-results__option {
                background-color: var(--tblr-bg-surface-dark);
                color: var(--tblr-body-color);
            }

            [data-bs-theme="dark"] .select2-results__option--highlighted {
                background-color: var(--tblr-primary) !important;
                color: #fff !important;
            }

            [data-bs-theme="dark"] .select2-results__option--selected {
                background-color: rgba(var(--tblr-primary-rgb), 0.2);
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5.select2-container--focus .select2-selection,
            [data-bs-theme="dark"] .select2-container--bootstrap-5.select2-container--open .select2-selection {
                border-color: var(--tblr-primary);
                box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.25);
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5 .select2-selection__clear {
                color: var(--tblr-body-color);
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5 .select2-selection__arrow b {
                border-color: var(--tblr-body-color) transparent transparent transparent;
            }

            [data-bs-theme="dark"] .select2-container--bootstrap-5.select2-container--open .select2-selection__arrow b {
                border-color: transparent transparent var(--tblr-body-color) transparent;
            }
        </style>
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
