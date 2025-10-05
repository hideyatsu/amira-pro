<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DatePicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $value = null,
        public string $format = 'Y-m-d',
        public bool $required = false,
        public ?string $minDate = null,
        public ?string $maxDate = null,
        public ?string $hint = null,
        public bool $inline = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.date-picker');
    }
}
