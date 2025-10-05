<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public array $options = [],
        public mixed $selected = null,
        public string $placeholder = '',
        public bool $required = false,
        public ?string $hint = null,
        public ?string $error = null
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.select');
    }
}
