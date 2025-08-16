<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Municipio;
use App\Models\Provincia;
use Livewire\Component;

class BuscadorPortal extends Component
{
    public $search = '';
    public $categoriaSeleted = 1;
    public $selectedProvincia;
    public $municipio_id;
    public $provincias;
    public $selectedMuni;
    public $state_id;



    protected $listeners = [
        'cambio_state' => 'cambio_state',
    ];


    public function render()
    {
        // if (!is_null(session('stateSel'))) {
        //     $this->state_id = session('stateSel');
        // }

        // if (is_null($this->state_id)) {
        //     $this->provincias = Provincia::all();
        // } else {
        //     $this->provincias = Provincia::where('state_id', $this->state_id)->get();
        // }
           
        if (!is_null(session('provinciaSel'))) {
            $this->selectedProvincia = session('provinciaSel');
            $this->municipios = Municipio::where('provincia_id', '=', $this->selectedProvincia)->orderBy('nombre')->get();
        }

        if (!is_null(session('muniSel'))) {
            $this->selectedMuni = session('muniSel');            
        }
       // dd(session('muniSel'));
        if (!is_null(session('categoriaSel'))) {
            $this->categoriaSeleted = session('categoriaSel');
        }

        if (!is_null(session('search'))) {
            $this->search = session('search');
        }


        // $categorias = Categoria::all()->sortBy('nombre');
        // $municipios = [];
        return view('livewire.buscador-portal');
    }

    public function change_categoria($categoriaSeleted)
    {
        $this->categoriaSeleted = $categoriaSeleted;
        session()->put('categoriaSel', $this->categoriaSeleted);
        $this->emit('cambio_categoria', $categoriaSeleted);
    }

    public function updatingSearch($search)
    {       
        $this->search = $search;
        session()->put('search', $this->search);
        $this->emit('searching', $search);
    }

    public function updatingselectedMuni($selectedMuni)
    {
        if ($selectedMuni == "") {
            $this->selectedMuni = null;
        }else{
            $this->selectedMuni = $selectedMuni;
        }        
        session()->put('muniSel', $this->selectedMuni);
        $this->emit('selecciono_muni', $this->selectedMuni);
        
    }

    public function updatingSelectedProvincia($provincia_id)
    {
        $this->selectedProvincia = $provincia_id;
        $this->municipios = Municipio::where('provincia_id', '=', $provincia_id)->orderBy('nombre')->get();
        session()->put('provinciaSel', $this->selectedProvincia);
        $this->emit('selecciono_provincia', $provincia_id);
    }

    // public function cambio_state($state_id)
    // {
    //     $this->state_id = $state_id;
    //     $this->provincias = Provincia::where('state_id', $this->state_id)->get();
    //     session()->put('provinciaSel', null);
    //     $this->selectedProvincia = null;
    //     session()->put('muniSel', null);
    //     $this->selectedMuni = null;
    //     $this->municipios = [];
    //     $this->emit('lanzar_busqueda');
    // }
}
