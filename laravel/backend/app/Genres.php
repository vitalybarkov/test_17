<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
use DB;
use URL;

class Genres extends Model
{
    public static function getAllGenres () {
        return static::all();
    }
}
