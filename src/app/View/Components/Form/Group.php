<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class Group extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label = '',
        public string $labelCol = '3',
        public bool $required = false,
        public string $name = '',
        public ?string $hint = null
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.group');
    }
}
