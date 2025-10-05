<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagsInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public array $value = [],
        public string $placeholder = 'Add tags...',
        public bool $required = false,
        public ?string $hint = null,
        public string $separator = ','
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.tags-input');
    }
}
