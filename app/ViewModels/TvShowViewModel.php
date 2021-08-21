<?php

namespace App\ViewModels;

use App\Helper\Helper;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{

    public $tvshow;


    public function __construct($tvshow)
    {

        $this->tvshow = $tvshow;
    }

    public function tvshow(){

        
        
        return collect($this->tvshow)->merge([

            'poster_path' => 'https://image.tmdb.org/t/p/w500/' .$this->tvshow['poster_path'],
            'vote_average' => Helper::movievotepercent($this->tvshow['vote_average']),
            'first_air_date' => Helper::moviedateformat($this->tvshow['first_air_date']),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(2),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5),
            'images' => collect($this->tvshow['images']['backdrops'] )->take(9),
            'video_embed' => $this->tvshow['videos']['results'] ? 'https://www.youtube.com/embed/'. $this->tvshow['videos']['results'][0]['key']
            : 'https://www.youtube.com/embed/', 
            'reviews' => collect($this->tvshow['reviews']['results'])->take(1),

            
        
        ])->only([

            'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres','crew',
            'cast','images', 'videos', 'created_by', 'video_embed', 'profile_path','reviews'



        ]);;

        
        
    
    }
}
