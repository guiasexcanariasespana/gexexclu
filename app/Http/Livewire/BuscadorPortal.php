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
    
    protected $listeners = ['searchUpdated' => 'handleSearchUpdated', 'cambio_categoria'=>'updateCategoria'];

    public function mount()
    {
        $this->provincias = Provincia::all();

        // Recuperar valores de sesión si existen
        $this->search = session('search', '');
        $this->categoriaSeleted = session('categoriaSel', 0);
        $this->selectedProvincia = session('provinciaSel');
        $this->selectedMuni = session('muniSelec');
        
        // Cargar municipios si hay provincia seleccionada
        if ($this->selectedProvincia) {
            $this->municipios = Municipio::where('provincia_id', $this->selectedProvincia)
                ->orderBy('nombre')
                ->get();
        }
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
        $this->dispatch('performSearch', $value);
    }

    public function updatingSelectedProvincia($provincia_id)
    {
        $this->municipios = Municipio::where('provincia_id', $provincia_id)
            ->orderBy('nombre')
            ->get();
        $this->dispatch('filtersUpdated', [
            'search' => $this->search,
            'provincia' => $provincia_id
        ]);
    }

     public function updatedSearch($value)
    {
        session(['search' => $value]);
        $this->dispatch('searching', search: $value);
    }

    public function updatedSelectedProvincia($provincia_id)
    {
        session(['provinciaSel' => $provincia_id]);
        session()->forget('muniSelec'); // Reset municipio al cambiar provincia
        
        $this->municipios = Municipio::where('provincia_id', $provincia_id)
            ->orderBy('nombre')
            ->get();
            
        $this->dispatch('selecciono_provincia', provincia_id: $provincia_id);
    }

    public function updatedSelectedMuni($municipio_id)
    {
        session(['muniSelec' => $municipio_id]);
        $this->dispatch('selecciono_muni', municipio_id: $municipio_id);
    }

    public function updateCategoria($categoriaId)
    {
        $this->categoriaSeleted = $categoriaId;
        session(['categoriaSel' => $categoriaId]);
        $this->dispatch('cambio_categoria', categoria_id: $categoriaId);
    }

    public function realizarBusqueda()
    {
         $this->dispatch('lanzar_busqueda', 
        search: $this->search,
        categoria: $this->categoriaSeleted,
        provincia: $this->selectedProvincia,
        municipio: $this->selectedMuni
    );
    }

    public function updatedCategoriaSeleted($value)
    {
        session(['categoriaSel' => $value]);
        $this->dispatch('cambio_categoria', categoria_id: $value);
    }

}