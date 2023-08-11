<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Album;

class Gallery extends Component
{
    /**
     * Die Alben Objekte
     *
     * @var Album
     */
    public $albums;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Album $albums)
    {
        $this->albums = $albums;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('content.gallery');
    }
}
