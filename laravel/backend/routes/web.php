<?php

use App\User;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MoviesController@render');
Route::get('/search', 'MoviesController@search');
Route::get('/genres', 'MoviesController@genres');
Route::post('/store', 'MoviesController@store');

// Route::get('/', 'MoviesController@render');

// Route::get('/search', 'MoviesController@search');

// Route::post('/store', 'MoviesController@store');

// Route::get('/{any}', function ($any) {
//     $backUrl = URL::to('/');
//     echo "Nothing here.<br/>";
//     echo '<a href = "' . $backUrl . '">Click Here</a> to go the movies page.';
//     echo '<script> setTimeout(function(){window.location="' . $backUrl . '"}, 1000); </script>';
// })->where('any', '.*');