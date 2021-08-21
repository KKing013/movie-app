<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewMoviesTest extends TestCase
{
    public function the_main_page_shows_correct_info() 
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/movie/list' => $this->fakeGenres()
            
            
           
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();

        $response->assertSee('Popular Movies');
        $response->assertSee('foo');
      

    }

    public function the_movie_page_shows_the_correct_info () 
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
            
            
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('foo');

    }

    public function the_search_dropdown_works_correctly() {

        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchMovies(),
            
            
        ]);

        Livewire::test('search-dropdown')->assertDontSee('jumanji')
        ->set('search', 'jumanji')
        ->assertSee('jumanji');



    }

    private function fakeSearchMovies() {
        return Http::response(['results' => 'Jumanji'], 200);
    }

    private function fakeSingleMovie() {

        return  Http::response(['results' => 'foo'], 200);

    }

    private function fakePopularMovies () {


        return  Http::response(['results' => 'foo'], 200);
    }

    private function fakeNowPlayingMovies () {


        return  Http::response(['results' => 'foo'], 200);
    }

    private function fakeGenres () {


        return  Http::response(['results' => 'foo'], 200);
    }
}
