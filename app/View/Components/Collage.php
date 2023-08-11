<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Collage extends Component
{

  public $images;
  public $imageStacks = [
    "fullStack" => array(),
    "barelyFullStack" => array(),
    "almostFullStack" => array(),
    "halfStack" => array(),
    "duoStack" => array(),
    "nonStack" => array()
  ];
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($images)
  {
    $this->images = $images;

    $tmp = count($images) / 6;
    for ($i = 0; $i < $tmp; $i++) {
      //var_dump($i);
      array_push($this->imageStacks["fullStack"], array_pop($images));
    }
    switch (count($images)) {
      case 1:
        array_merge($this->imageStacks["nonStack"], $images);
        break;
      case 2:
        array_merge($this->imageStacks["duoStack"], $images);
        break;
      case 3:
        array_merge($this->imageStacks["halfStack"], $images);
        break;
      case 4:
        array_merge($this->imageStacks["almostFullStack"], $images);
        break;
      case 5:
        array_merge($this->imageStacks["barelyFullStack"], $images);
        break;
    }
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.collage');
  }
}
