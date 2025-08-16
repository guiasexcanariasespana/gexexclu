<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Plane;
use Livewire\Component;
use App\Models\Zone;
use App\Models\Provincia;
use App\Models\Municipio;

class PlanesComponent extends Component

{

    public $selectedProvincia;
    public $selectedMuni;
    public $municipios = [];
    public $provincias = [];
    // public $zones=[];
    // public $selectedZone;
    public $selectedPlane;
    public $planes = [];
    public $precio;
    public $dias;
    public $plan_nombre;
    public $selectedCategoria;
    public $categorias;
    public $presentacion_aux;
    public $titulo;
    public $nombre;
    public $edad;
    public $mensaje_boton = 'Continuar y Pagar Anuncio';
    // public $total;

    public function mount($selectedMuni, $selectedPlane, $selectedCategoria, $precio, $dias, $localidad)
    {

        $this->precio = $precio;
        $this->dias = $dias;
        $this->selectedCategoria = $selectedCategoria;
        $this->localidad = $localidad;
        $this->selectedPlane = $selectedPlane;
        $this->selectedMuni = $selectedMuni;
        //$this->tipo = $tipo;
        //dd($selectedMuni);
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
        return view('livewire.planes-component');
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
        // $this->planes = [];
        // $this->precio = '';
        // $this->dias = '';
        // $this->selectedPlane = '';
        // $this->selectedZone = '';
        $this->selectedMuni = '';
    }

    // public function updatedSelectedMuni($muni_id)
    // {
    //     $this->zones = Zone::where('municipio_id', '=', $muni_id)->get();
    //     // $this->planes = [];
    //     // $this->precio = '';
    //     // $this->dias = '';
    //     // $this->selectedPlane = '';
    //     $this->selectedZone = '';

    // }

    // public function updatedselectedZone($selectedZone)
    // {
    //     $this->selectedZone = $selectedZone;
    //     //$this->busco_planes();
    // }


    public function updatedSelectedCategoria($selectedCategoria)
    {
        $this->selectedCategoria = $selectedCategoria;
        $this->busco_planes();
    }

    public function updatedSelectedPlane()
    {
        $plan = Plane::find($this->selectedPlane);
        $this->dias = $plan->dias;
        $this->precio = $plan->precio;
        // $this->calcular_total();
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
        // if (!empty($this->selectedZone) and !empty($this->selectedCategoria)) {

        if (!empty($this->selectedCategoria)) {

            // $zona = Zone::find($this->selectedZone);
            // Se cambio esto porque solo este la opcion free
            // $this->planes = Plane::where('categoria_id', '=', $this->selectedCategoria)->get();
            $this->planes = Plane::where('categoria_id', '=', $this->selectedCategoria)
                ->where('interno', 'No')
                ->where('clase_id', 9)
                ->where('dias', 30)->get();
            if (count($this->planes)) {
                if (is_null($this->selectedPlane)) {
                    $plan = $this->planes->first();
                    $this->plan_nombre= $plan->nombre;
                    $this->dias = $plan->dias;
                    $this->precio = $plan->precio;
                    $this->selectedPlane = $plan->id;
                }

                //$this->calcular_total();
                // $precioregistro = $plan->precios->where('zone_id', '=', $this->selectedZone)->first();
                // if (!is_null($precioregistro)){
                //     $this->precio = $precioregistro->precio;
                // }
            } else {
                // $this->total = "";
                $this->selectedPlane = [];
                $this->precio = "";
                $this->dias = "";
            }
            $this->planes = $this->planes->pluck('nombre', 'id');
        } else {
            $this->planes = [];
            // $this->total = "";
            $this->selectedPlane = [];
            $this->precio = "";
            $this->dias = "";
        }
        if ($this->precio == 0 || is_null($this->precio)) {
            $this->mensaje_boton = 'Continuar, es Gratis';
        }else{
            $this->mensaje_boton =  'Continuar y Pagar Anuncio';
        }
    }


    // public function updatedTipo($tipo)
    // {
    //     $this->tipo = $tipo;
    //     $this->calcular_total();


    // }

    public function updatedPrecio($precio)
    {
        $this->precio = $precio;        
        $this->calcular_total();
        if($this->precio == 0 || is_null($this->precio)  ){
            $this->mensaje_boton = 'Continuar, es Gratis';
        }else{
            $this->mensaje_boton =  'Continuar y Pagar Anuncio';
        }
    }

    // public function updatedPresentacionAux($presentacion_aux)
    // {

    //     $this->emit('verificar');
    // }

    // public function calcular_total()
    // {

    //     if ($this->tipo=='Doble'){
    //        $this->total= $this->precio * 2; 
    //     }else{

    //         $this->total = $this->precio;

    //     }


    // }

}
