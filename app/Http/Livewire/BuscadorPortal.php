<?php
namespace App\Http\Livewire;

use App\Models\Anuncio;
use App\Models\Categoria;
use App\Models\Municipio;
use App\Models\Provincia;
use Livewire\Component;

class BuscadorPortal extends Component
{
    public $search = '';
    public $categoriaSeleted = 1;
    public $selectedProvincia;
    public $selectedMuni;
    public $municipios = [];
    public $provincias;
    
    protected $listeners = ['searchUpdated' => 'handleSearchUpdated'];

    public function mount()
    {
        $this->provincias = Provincia::all();
    }

    public function render()
    {
        return view('livewire.buscador-portal', [
            'categorias' => Categoria::all()->sortBy('nombre')
        ]);
    }

    public function updatingSearch($value)
    {
        $this->search = $value;
        $this->emit('performSearch', $value);
    }

    public function updatingSelectedProvincia($provincia_id)
    {
        $this->municipios = Municipio::where('provincia_id', $provincia_id)
            ->orderBy('nombre')
            ->get();
        $this->emit('filtersUpdated', [
            'search' => $this->search,
            'provincia' => $provincia_id
        ]);
    }

    public function updatingselectedMuni($municipio_id)
    {
        $this->emit('filtersUpdated', [
            'search' => $this->search,
            'municipio' => $municipio_id
        ]);
    }
}