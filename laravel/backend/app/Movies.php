<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;
use URL;

class Movies extends Model
{
    public static $MAXDURATION = 10000;
    public static $RATINGRANGE = [0, 10];

    public static function getAllMovies () {
        return static::all();
    }

    public static function getMatchingSearchQuery ($query = '') {
        $result = 
            DB::table('movies')
            ->join('genres', 'movies.genre', '=', 'genres.id')
            ->select('movies.id', 'movies.duration', 'movies.rating', 'genres.genre', 'movies.description')
            ->where('duration', 'LIKE', "%$query%")
            ->orWhere('rating', 'LIKE', "%$query%")
            ->orWhere('genres.genre', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return $result;
    }

    public static function storeMovie ($duration = 0, $rating = 0, $genre = 0, $description = '', $created_at, $updated_at) {
        $backUrl = URL::to('/');
        $result = "";
        $genresQuantity = sizeof(App\Genres::getAllGenres());

        if ((int)$duration && $duration > 0 && $duration < self::$MAXDURATION
            && (int)$rating && $rating > self::$RATINGRANGE[0] && $rating < self::$RATINGRANGE[1] + 1
            && (int)$genre && $genre < $genresQuantity + 1
            && is_string((string) $description)) {
            $data = array(
                'duration'      => (int)$duration,
                'rating'        => (int)$rating,
                'genre'         => (int)$genre,
                'description'   => $description,
                'created_at'    => $created_at,
                'updated_at'    => $updated_at
            );
            DB::table('movies')->insert($data);

            $result = "The movie stored successfully.";
            // $result .= "The movie stored successfully.<br/>";
            // $result .= '<a href="' . $backUrl . '">Click Here</a> to go back.';
            // $result .= '<script> setTimeout(function(){window.location="' . $backUrl . '"}, 2000); </script>';
        } else {
            $result .= "The movie do not stored.<br/>";
            if ($duration <= 0 || $duration > self::$MAXDURATION) {
                $result .= "— duration can be a positive number and less than " . self::$MAXDURATION . ".<br/>";
            }
            if ($rating <= self::$RATINGRANGE[0] || $rating > self::$RATINGRANGE[1]) {
                $result .= "— rating out of the range from 1 to 10.<br/>";
            }
            if ($genre <= 0 || $genre > $genresQuantity) {
                $result .= "— genre must be a selected from the list of the genres.<br/>";
            }
            if (!$description) {
                $result .= "— description must have some words.<br/>";
            }
            // $result .= '<a href="' . $backUrl . '">Click Here</a> to go back.';
            // $result .= '<script> setTimeout(function(){window.location="' . $backUrl . '"}, 4000); </script>';
        }
        
        return '{"message":"' . $result . '"}';
        // return $result;
    }
}
