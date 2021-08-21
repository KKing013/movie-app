<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;



class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $popularMovies = Http::withToken(env('TMDB_TOKEN'))->get(env('POPULAR_MOVIES_URL'))
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(env('TMDB_TOKEN'))->get(env('NOW_PLAYING_MOVIES_URL'))
            ->json()['results'];

        $genres = Http::withToken(env('TMDB_TOKEN'))->get(env('GENRE_MOVIES_URL'))
            ->json()['genres'];

        
        // $genres = collect($genresArray)->mapWithKeys(function ($genre) {
        //     return [$genre['id'] => $genre['name']];
        // });

        // return view('layouts.index',[
        //     'popularMovies' => $popularMovies,
        //     'nowPlayingMovies' => $nowPlayingMovies,
        //     'genres' => $genres
        // ]);

        $viewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres);



        return view('movies.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $movie = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images,reviews')
            ->json();

        $viewModel = new MovieViewModel($movie);


        return view('movies.show', $viewModel );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
