<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $type = 'text',
        public ?string $label = null,
        public string $placeholder = '',
        public bool $required = false,
        public ?string $value = null,
        public ?string $prepend = null,
        public ?string $append = null,
        public ?string $hint = null
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.input-group');
    }
}
