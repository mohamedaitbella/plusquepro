<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'adult', 'backdrop_path', 'original_language', 'original_title', 'overview', 'poster_path', 'media_type', 'popularity', 'release_date', 'video', 'vote_average', 'vote_count'];

    public function genres()
{
    return $this->belongsToMany(Genre::class);
}
}
