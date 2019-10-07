<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use URL;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    public function render () {
        $movies = App\Movies::getAllMovies();
        $genres = App\Genres::getAllGenres();
        return array (
            $genres,
            $movies
        );
        // return view('moviesPage', compact('movies', 'genres'));
    }

    public function search (Request $request) {
        $movies = App\Movies::getMatchingSearchQuery(
            $request->input('queary')
        );
        $genres = App\Genres::getAllGenres();

        return array (
            $genres,
            $movies
        );
        // return view('moviesPage', compact('movies', 'genres'));
    }

    public function genres () {
        $genres = App\Genres::getAllGenres();

        return $genres;
    }

    public function store (Request $request) {
        $timestamp = now();
        $movies = App\Movies::storeMovie(
            $request->input('duration'),
            $request->input('rating'),
            $request->input('genre'),
            $request->input('description'),
            $timestamp,
            $timestamp
        );
        return $movies;
    }
}
