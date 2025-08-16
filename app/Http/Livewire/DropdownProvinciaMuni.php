<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;
use App\Models\Municipio;

class DropdownProvinciaMuni extends Component
{

    public $selectedProvincia;
    public $selectedMuni;
    public $municipios=[];
    public $provincias = [];

    public function mount($selectedMuni)
    {

        $this->selectedMuni = $selectedMuni;
        if (!is_null($this->selectedMuni)) {
            $muni = Municipio::find($this->selectedMuni);
            $this->selectedProvincia = $muni->provincia_id;
            $this->municipios = Municipio::where('provincia_id', '=', $muni->provincia_id)->get();
        }       
    }
   

    public function render()
    {
        $this->provincias = Provincia::all();
        
        return view('livewire.dropdown-provincia-muni');
    }

    public function updatedSelectedProvincia($provincia_id){
        $this->municipios = Municipio::where('provincia_id', '=', $provincia_id)->get();
    }

}
