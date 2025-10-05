<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileUpload extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public bool $multiple = false,
        public ?string $accept = null,
        public bool $required = false,
        public ?string $hint = null,
        public bool $dropzone = false,
        public ?string $placeholder = 'Choose file...'
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.form.file-upload');
    }
}
