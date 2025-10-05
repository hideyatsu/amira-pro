<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $headers = [],
        public array $tableData = [],
        public bool $striped = false,
        public bool $bordered = false,
        public bool $hover = true,
        public bool $responsive = true,
        public string $size = 'default', // sm, default, lg
        public ?string $caption = null
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.table');
    }
}
