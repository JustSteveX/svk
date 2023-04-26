<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Slider extends Component
{

    /**
     * CSS classes
     *
     * @var string
     */
    public $classes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($classes = '')
    {
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slider');
    }
}
