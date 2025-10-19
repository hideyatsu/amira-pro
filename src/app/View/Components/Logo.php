<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Logo extends Component
{
    /**
     * The width of the logo.
     *
     * @var string
     */
    public string $width;

    /**
     * The height of the logo.
     *
     * @var string
     */
    public string $height;

    /**
     * Create a new component instance.
     *
     * @param  string  $width
     * @param  string  $height
     * @return void
     */
    public function __construct(string $width = '110', string $height = '32')
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.logo');
    }
}
