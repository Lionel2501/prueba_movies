<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \App\Models\Movie;
use \App\Models\Gender;

class MovieController extends Controller
{    
    public function fetchAndSaveMovies()
    {
        $url_movies = "https://api.themoviedb.org/3/movie/popular?page=1";
        $url_genre = "https://api.themoviedb.org/3/genre/movie/list";
        $token = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2MjBlMGZmYTdhNDBhN2RjMzFkOGEyYmUwZDE4YzViOSIsInN1YiI6IjYzMWJhYzE0MGYxZTU4MDA5MmRjYzg2ZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.j6Q4_2RgJ_1bpeIxo4WWAq4XDPG1Owz9fbABy0RP0Do";
        
        $response_movies = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url_movies);

        $response_genre = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url_genre);
        
        $movies = $response_movies->json()['results'];
        $genres = $response_genre->json()['genres'];
        
        foreach ($movies as $movieData) {
            Movie::create([
                'title' => $movieData['title'],
                'genre_ids' => json_encode($movieData['genre_ids']),
                'original_language' => $movieData['original_language'],
                'original_title' => $movieData['original_title'],
                'overview' => $movieData['overview'],
                'poster_path' => $movieData['poster_path']
            ]);
        }

        foreach ($genres as $genreData) {
            Gender::create([
                'id' => $genreData['id'],
                'name' => $genreData['name']
            ]);
        }

        return redirect()->route('showMovies');
    }

    public function showMovies(){
        $movies = Movie::all();
        $genres = Gender::all();

        $movies_result = [];
        foreach ($movies as $movie) {
            $genreNames = $this->mapGenreNames($movie, $genres);
            $formattedGenreNames = implode(', ', $genreNames);

            $movie->genreNames = $formattedGenreNames;
            $movies_result[] = $movie;
        }

        return view('movies.index', ['movies' => $movies]);
    }

    function mapGenreNames($movie, $genres) {
        $genreNames = [];
        
        foreach (json_decode($movie->genre_ids) as $genreId) {
            $genre = collect($genres)->firstWhere('id', $genreId);
            
            if (isset($genre->name)) {
                $genreNames[] = $genre->name;
            } 
        }
    
        return $genreNames; 
    }
    

    public function editMovie($id){
        $movie = Movie::find($id);

        if ($movie) {
            return view('movies.edit', ['movie' => $movie]);
        } else {
            return redirect()->route('showMovies')->with('error', 'Película no encontrada');
        }
    }

    public function updateMovie(Request $request, $id){
        $movie = Movie::find($id);

        if ($movie) {
            $movie->title = $request->input('title');
            $movie->original_language = $request->input('original_language');
            $movie->original_title = $request->input('original_title');
            $movie->overview = $request->input('overview');
            $movie->poster_path = $request->input('poster_path');
    
            $movie->save();
    
            return redirect()->route('showMovies')->with('success', 'Película actualizada exitosamente');
        } else {
            return redirect()->route('showMovies')->with('error', 'No se encontró la película');
        }
    }

    public function deleteMovie($id){
        $movie = Movie::find($id);

        if ($movie) {
            $movie->delete();
            return redirect()->route('showMovies')->with('success', 'Película eliminada exitosamente');
        } else {
            return redirect()->route('showMovies')->with('error', 'No se encontró la película');
        }
    }
}
