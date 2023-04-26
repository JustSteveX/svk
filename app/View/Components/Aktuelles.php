<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Aktuelles extends Component
{
    /**
     * Die News Artikel
     *
     * @var News
     */
    public $articles;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(News $articles)
    {
        $this->articles = $articles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('content.aktuelles');
    }
}
