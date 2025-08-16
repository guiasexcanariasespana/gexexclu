<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Clase;
use App\Models\Plane;
use Livewire\Component;
use App\Models\Zone;
use App\Models\Municipio;
use App\Models\Provincia;

class Statedropdowns extends Component
{

    public $selectedProvincia;
    public $selectedMuni;
    public $municipios = [];
    public $provincias = [];
    // public $zones = [];
    // public $selectedZone;
    public $selectedPlane;
    public $planes = [];
    public $precio;
    public $dias;
    public $localidad;
    public $selectedCategoria;
    public $categorias;
    public $selectedClase;
    public $clases;
    public $anuncio;



    public function mount( $selectedMuni, $selectedPlane, $selectedCategoria, $precio, $dias, $localidad, $selectedClase)
    {
        $this->precio = $precio;
        $this->dias = $dias;
        $this->localidad = $localidad;
        $this->selectedCategoria = $selectedCategoria;
        $this->selectedClase = $selectedClase;
        $this->selectedPlane = $selectedPlane;
        $this->selectedMuni = $selectedMuni;

        if (!is_null($this->selectedMuni)) {
            $muni = Municipio::find($this->selectedMuni);
            $this->selectedProvincia = $muni->provincia_id;
            $this->municipios = Municipio::where('provincia_id', '=', $muni->provincia_id)->get();
        }
        $this->categorias = Categoria::orderBy('nombre')->get(); #->pluck('nombre', 'id');
        if (is_null($this->selectedCategoria) and count($this->categorias)) {
            $this->selectedCategoria = $this->categorias->first()->id;
        }
        $this->categorias = $this->categorias->pluck('nombre', 'id');

        
        $this->clases = Clase::all();
        if (is_null($this->selectedClase) and count($this->clases)) {
            $this->selectedClase = $this->clases->first()->id;
        }
        $this->clases = $this->clases->pluck('nombre', 'id');
        // $this->zones = Zone::orderBy('nombre')->get(); #->pluck('nombre', 'id');
        // if (is_null($this->selectedZone) and count($this->zones)) {
        //     $this->selectedZone = $this->zones->first()->id;
        // }
        $this->busco_planes();
        // $this->zones = $this->zones->pluck('nombre', 'id');
    }

    public function render()
    {
        
        $this->provincias = Provincia::all();
        $this->municipios = Municipio::all();

        $this->provincias = Provincia::all();
        return view('livewire.statedropdowns');
    }


    // public function updatedSelectedState($selectedState)
    // {
    //     if (!is_null($selectedState)) {
    //         $this->busco_zona($selectedState);                      
    //     }else{
    //         $this->zones= [];
    //         $this->planes = [];
    //     }

    // }
    public function updatedSelectedProvincia($provincia_id)
    {

        $this->municipios = Municipio::where('provincia_id', '=', $provincia_id)->get();
        // $this->zones = [];
        // //      $this->planes = [];
        // //        $this->precio = '';
        // //      $this->dias = '';
        // $this->selectedZone = '';
        $this->selectedMuni = '';
        //$this->selectedPlane = '';
    }

    // public function updatedSelectedMuni($muni_id)
    // {
    //     // $this->zones = Zone::where('municipio_id', '=', $muni_id)->get();
    //     // // $this->planes = [];
    //     // //  $this->precio = '';
    //     // // $this->dias = '';
    //     // $this->selectedZone = '';
    //    // $this->selectedPlane = '';
    // }

    // public function updatedselectedZone($selectedZone)
    // {
    //     $this->selectedZone = $selectedZone;
    //     //  $this->busco_planes();
    // }


    public function updatedSelectedCategoria($selectedCategoria)
    {
        $this->selectedCategoria = $selectedCategoria;
        $this->busco_planes();
    }

    public function updatedSelectedclase($selectedClase)
    {
        $this->selectedClase = $selectedClase;
        $this->selectedPlane = null;
        $this->dias = null;
        $this->precio = null;
        $this->busco_planes();
    }

    public function updatedSelectedPlane($selectedCategoria)
    {
        $plan = Plane::find($this->selectedPlane);
        $this->dias = $plan->dias;
        $this->precio = $plan->precio;
        // $precioregistro = $plan->precios->where('zone_id', '=', $this->selectedZone)->first();
        // if (!is_null($precioregistro)) {
        //     $this->precio = $precioregistro->precio;

        // }
    }

    // protected function busco_zona($selectedState){
    //     $this->zones = Zone::where('state_id', '=', $selectedState)->orderBy('nombre')->get();        
    //     if (count($this->zones)) {
    //         $this->selectedZone = $this->zones->first()->id;
    //         $this->busco_planes();
    //     } else {
    //         $this->selectedZone = [];
    //         $this->planes = [];
    //     }
    //     $this->zones = $this->zones->pluck('nombre', 'id');
    // }

    protected function busco_planes()
    {
        //if (!empty($this->selectedZone) and !empty($this->selectedCategoria)) {
        if (!empty($this->selectedCategoria)) {
            //$zona = Zone::find($this->selectedZone);
            // $this->planes = Plane::wherein('id', $zona->planes_ids())
            //     ->where('categoria_id', '=', $this->selectedCategoria)->get();
            //dd($this->selectedClase);
            $this->planes = Plane::where('clase_id', '=', $this->selectedClase)
                ->where('categoria_id', '=', $this->selectedCategoria)->get();
            if (count($this->planes)) {
                $plan = $this->planes->first();
              
               if (is_null($this->selectedPlane)){
                    $this->selectedPlane = $plan->id;
                    $this->precio = $plan->precio;
                    $this->dias = $plan->dias;
               }
                
                
                // $precioregistro = $plan->precios->where('zone_id', '=', $this->selectedZone)->first();
                // if (!is_null($precioregistro)) {
                //     $this->precio = $precioregistro->precio;
                // }
            } else {
                $this->selectedPlane = [];
                $this->precio = "";
                $this->dias = "";
            }
            $this->planes = $this->planes->pluck('nombre', 'id');
        } else {
            $this->planes = [];
        }
    }
}
