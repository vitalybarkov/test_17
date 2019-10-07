<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            table {
                
            }

            th {
                text-align: left;
            }

            th, td {
                padding: .5em;
                vertical-align: top;
                color: #8E9A9E;
            }

            div.search_form,
            div.movies_list,
            div.add_movie_form {
                margin: 0 10%;
                padding: .3em;
            }

            div.search_form {
                float: right;
                padding: 1.1em 0 0 0;
            }

            div.search_form input {
                font-size: 18px;
                margin-top: -.1em;
                padding: .2em .3em;
                border: 2px #8E9A9E dotted;
                border-radius: 9px;
            }

            div.movies_list {
                padding: 1.1em .3em 1.8em;
            }

            div.add_movie_form {
                border: 2px #73AD21 dotted;
                border-radius: 9px;
            }

            div.add_movie_form label {
                display: block;
                float: left;
                width: 20%;
            }
            
            div.movies_list div,
            div.movies_list h3,
            div.add_movie_form div,
            div.add_movie_form h3 {
                padding: .3em;
                vertical-align: top;
            }

            h3 {
                white-space: nowrap;
                margin: -.25em 0 .4em;
            }
        </style>
        <title>MOVIES{{ " (" . sizeof($movies) . ")" }}</title>
    </head>
    <body>

        <div class="search_form">
            <form method="GET" action="{{ url('/search') }}">
                <input type="text" name="description" placeholder="Search Movie" value="" />
            </form>
        </div>

        <div class="movies_list">
            <h3>
@if (Request::url() !== url('/'))
                <a href="{{ url('/') }}">MOVIES</a>{{ " (" . sizeof($movies) . ")" }}     
@else
                MOVIES{{ " (" . sizeof($movies) . ")" }}
@endif
            </h3>
            <table>
                <tr>
                    <th>id</th>
                    <th>duration</th>
                    <th>rating</th>
                    <th>genre</th>
                    <th>description</th>
                </th>
@foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->duration }}</td>
                    <td>{{ $movie->rating }}</td>
@foreach ($genres as $genre)
@if ($movie->genre == $genre->id)
                    <td>{{ $genre->name }}</td>
@endif
@endforeach
                    <td>{{ $movie->description }}</td>
                </tr>
@endforeach
            </table>
        </div>
        
        <div class="add_movie_form">
            <h3>ADD MOVIE</h3>
            <form method="POST" action="{{ url('/store') }}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div>
                    <label>Duration</label>
                    <input name="duration" placeholder="90">
                </div>
                <div>
                    <label>Rating</label>
                    <input name="rating" placeholder="10">
                </div>
                <div>
                    <label>Genre</label>
                    <select name="genre">
@foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
@endforeach
                    </select>
                </div>
                <div>
                    <label>Description</label>
                    <textarea name="description" placeholder="Movie Description"></textarea>
                </div>
                <div>
                    <input type="submit" value="Add the Movie">
                </div>
            </form>
        </div>  
 
 </div>
    </body>
</html>
