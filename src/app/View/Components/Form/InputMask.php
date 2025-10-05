<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputMask extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public string $mask = '',
        public string $placeholder = '',
        public bool $required = false,
        public ?string $value = null,
        public ?string $hint = null
    ) {
        // Set common mask patterns
        $patterns = [
            'phone' => '(999) 999-9999',
            'date' => '99/99/9999',
            'time' => '99:99',
            'datetime' => '99/99/9999 99:99',
            'zip' => '99999-999',
            'ssn' => '999-99-9999',
            'credit-card' => '9999 9999 9999 9999',
            'ip' => '999.999.999.999'
        ];

        if (array_key_exists($this->mask, $patterns)) {
            $this->mask = $patterns[$this->mask];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.input-mask');
    }
}
