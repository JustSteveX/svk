<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Collapsible extends Component
{
  /** Text auf der Linie des Collapsible Elements */
  public string $title;
  /** Inhalt des Collapsible Elements */
  public string $content;
  /** Aktueller Stand des Collapsible Elements */
  public bool $collapsed;
  /** Bilder Namen */
  public $images;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($content = '', $title = '', $collapsed = true, $images = [])
  {
    $this->content = $content;
    $this->title = $title;
    $this->collapsed = $collapsed;
    $this->images = $images;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.collapsible');
  }
}
