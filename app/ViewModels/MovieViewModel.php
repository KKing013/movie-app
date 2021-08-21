<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{

    public $movie;


    public function __construct($movie)
    {

        $this->movie = $movie;
    }

    public function movie(){
        
        return collect($this->movie)->merge([

            'poster_path' => 'https://image.tmdb.org/t/p/w500/' .$this->movie['poster_path'],
            'vote_average' => Helper::movievotepercent($this->movie['vote_average']),
            'release_date' => Helper::moviedateformat($this->movie['release_date']),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2),
            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'images' => collect($this->movie['images']['backdrops'] )->take(9),
            'video_embed' => $this->movie['videos']['results'] ? 'https://www.youtube.com/embed/'. $this->movie['videos']['results'][0]['key']
            : 'https://www.youtube.com/embed/',
            'reviews' => collect($this->movie['reviews']['results'])->take(1),
            
        
        ])->only([

            'poster_path', 'id', 'title', 'vote_average', 'overview', 'release_date', 'genres','crew',
            'cast','images', 'videos', 'video_embed','reviews'



        ]);;
            
    
    }
}
