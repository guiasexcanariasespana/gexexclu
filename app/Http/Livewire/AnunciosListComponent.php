<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Anuncio;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\User;
use Livewire\WithPagination;

class AnunciosListComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = 'estado';
    public $direction = 'desc';
    public $mostrar_cantidad = 25;

    // public function mount(){
    //     $this->anuncios = Anuncio::paginate();
    // }

    protected $listeners = ['render'=> '$refresh'];

    public function render()
    {

        $municipio_ids = Municipio::where('nombre', 'like', '%' . $this->search . '%')->pluck('id');

        $provincia_ids = Provincia::where('nombre', 'like', '%' . $this->search . '%')->pluck('id');

        $users_ids = User::where('name', 'like', '%' . $this->search . '%')->pluck('id');

        // $anuncios = Anuncio::orderBy('nombre', 'desc')->paginate();

        $anuncios = Anuncio::orWhere('nombre', 'like', '%' . $this->search . '%')
        ->orWhere('estado', 'like', '%' . $this->search . '%')
                    ->orWhere('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('nacionalidad', 'like', '%' . $this->search . '%')                                      
                    ->orWhere('edad', 'like', '%' . $this->search . '%')
                     ->orWhere('id', 'like', '%' . $this->search . '%')
                    ->orWhereIn('user_id', $users_ids)
                    ->orWhereIn('municipio_id', $municipio_ids)
                    ->orWhereIn('provincia_id', $provincia_ids)->orderBy($this->sort, $this->direction)->paginate($this->mostrar_cantidad);
        return view('livewire.anuncios-list-component', compact('anuncios'));
    }


    public function updatingSearch(){
        $this->resetPage();
    }


    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;;
            $this->direction = 'asc';
        }
    }



}
