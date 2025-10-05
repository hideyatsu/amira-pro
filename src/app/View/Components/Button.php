<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'button',
        public string $variant = 'primary',
        public string $size = '',
        public string $iconPosition = 'start',
        public bool $loading = false,
        public bool $disabled = false,
        public bool $fullWidth = false
    ) {
        //
    }

    public function buttonClass(): string
    {
        $classes = collect(['btn', "btn-{$this->variant}"]);
        
        if ($this->size) $classes->push("btn-{$this->size}");
        if ($this->fullWidth) $classes->push('w-100');
        if ($this->loading || $this->disabled) $classes->push('disabled');
        
        return $classes->implode(' ');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.button');
    }
}
