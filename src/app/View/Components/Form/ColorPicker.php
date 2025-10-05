<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColorPicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $value = null,
        public bool $required = false,
        public ?string $hint = null,
        public array $presetColors = []
    ) {
        // Default preset colors if none provided
        if (empty($this->presetColors)) {
            $this->presetColors = [
                '#206bc4', '#79a6dc', '#d63384', '#f76397',
                '#f59f00', '#ffc107', '#2fb344', '#74c0fc',
                '#ae3ec9', '#845adf', '#495057', '#868e96'
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.color-picker');
    }
}
