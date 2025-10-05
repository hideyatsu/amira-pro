<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Progress extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $value = 0,
        public int $max = 100,
        public ?string $label = null,
        public string $color = 'primary',
        public bool $striped = false,
        public bool $animated = false,
        public string $size = 'default' // sm, default, lg
    ) {
        //
    }

    /**
     * Calculate percentage for display.
     */
    public function percentage(): int
    {
        return $this->max > 0 ? round(($this->value / $this->max) * 100) : 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.progress');
    }
}
