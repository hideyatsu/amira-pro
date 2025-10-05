<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Input extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public string $name,
        public string $type = 'text',
        public ?string $label = null,
        public string $placeholder = '',
        public bool $required = false,
        public mixed $value = null,
        public ?string $hint = null,
        public ?string $error = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.input');
    }
}
