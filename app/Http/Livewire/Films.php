<?php

namespace App\Http\Livewire;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Films extends Component
{
    public function render()
    {   
        $films = Film::with('genres')->get();
        return view('livewire.films',['films' => $films]);
    }
}
