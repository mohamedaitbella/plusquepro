<?php

namespace App\Http\Livewire;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Films extends Component
{
    use WithPagination;

    public $q;
    public function render()
    {   
        $films = Film::with('genres')
        ->when($this->q , function($query){
            return $query->where(function($query){
                return $query->where('title','like','%'.$this->q.'%')
                            ->orWhere('overview','like','%'.$this->q.'%');
            });
        })
        ->paginate(5);
        return view('livewire.films',['films' => $films]);
    }
    function updatingQ() {
        $this->resetPage();
    }
}
