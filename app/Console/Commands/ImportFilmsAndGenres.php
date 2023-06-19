<?php

namespace App\Console\Commands;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportFilmsAndGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plusquepro:import-films-genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import films and genres from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       // get all genre  
       $genreResponse = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZDFmOTQ2OTg0Yzc0Mzg5MDhkY2JiOGQ3MTU0ZTA2MiIsInN1YiI6IjY0OGY3OGIxYzNjODkxMDBjYWRhZjA2ZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DDkhnyL5oZX-XDEKpE24eofY9nFoEY5NZmvQWePGPYQ'
    ])->get('https://api.themoviedb.org/3/genre/movie/list');

    if ($genreResponse->successful()) {
        $genreData = $genreResponse->json();
       
        foreach ($genreData['genres'] as $item) {
            $genre = Genre::firstOrCreate(['genre_id' => $item['id']], $item);
        }
       
        $this->info('Genres imported successfully.');
    } else {
        $this->error('Failed to fetch genre data from the API.');
    }

    // get first page of movies
    $movieResponse = Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZDFmOTQ2OTg0Yzc0Mzg5MDhkY2JiOGQ3MTU0ZTA2MiIsInN1YiI6IjY0OGY3OGIxYzNjODkxMDBjYWRhZjA2ZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DDkhnyL5oZX-XDEKpE24eofY9nFoEY5NZmvQWePGPYQ'
    ])->get('https://api.themoviedb.org/3/trending/movie/week');

    if ($movieResponse->successful()) {
        $movieData = $movieResponse->json();
      
        foreach ($movieData['results'] as $item) {
            $movie = Film::firstOrCreate(['film_id' => $item['id']], $item);
        
            foreach ($item['genre_ids'] as $genreId) {
                $genre = Genre::where('genre_id',$genreId)->first();

                if ($genre) {
                    $movie->genres()->syncWithoutDetaching($genre->id);
                }
            }
        }
        $this->info('Movies imported successfully.');
    } else {
        $this->error('Failed to fetch movie data from the API.');
    } 
    }
}
