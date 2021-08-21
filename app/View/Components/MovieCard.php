<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieCard extends Component
{

    public $movie;
    
    public function __construct($movie)
    {
        $this->movie = $movie;
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.movie-card');
    }
}