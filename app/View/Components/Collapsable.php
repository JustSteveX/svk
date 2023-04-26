<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Collapsable extends Component
{
    /** Text auf der Linie des Collapsables */
    public string $title;
    /** Inhalt des Collapsables */
    public string $content;
    /** Aktueller Stand des Collapsables */
    public bool $collapsed;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content, $title = '', $collapsed = true)
    {
        $this->content = $content;
        $this->title = $title;
        $this->collapsed = $collapsed;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.collapsable');
    }
}
