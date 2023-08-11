<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Club extends Component
{


  public $collapsibleElements;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($collapsibleElements)
  {
    $this->collapsibleElements = $collapsibleElements;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.club');
  }
}
