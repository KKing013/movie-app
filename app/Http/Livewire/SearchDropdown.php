<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{

    public $search = '';
   

    public function render()
    {
        $searchResultsMovies = [];
        $searchResultsTv = [];

        if (strlen($this->search) > 2) {

        $searchResultsMovies = Http::withToken(env('TMDB_TOKEN'))
        ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
        ->json()['results'];

        $searchResultsTv = Http::withToken(env('TMDB_TOKEN'))
        ->get('https://api.themoviedb.org/3/search/tv?query='.$this->search)
        ->json()['results'];

    }

        return view('livewire.search-dropdown', [

            'searchResultsMovies' => collect($searchResultsMovies)->take(4),
            'searchResultsTv' => collect($searchResultsTv)->take(4)
        ]);
    }
}

