<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class Radio extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label = '',
        public string $value = '',
        public bool $checked = false,
        public bool $disabled = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.radio');
    }
}
