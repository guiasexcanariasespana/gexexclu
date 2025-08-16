<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Plane;

class PlanExtenderComponent extends Component
{
    public $selectedPlane;
    public $planes = [];
    public $dias;
    public $precios;
    public $categoria;
    public $clase_id;
    //public $zona;
    //public $tipo;
    //public $total;
    public $precio;



    public function mount($categoria, $clase_id, $selectedPlane)
    {
        $this->categoria = $categoria;
        $this->clase_id = $clase_id;
        $this->selectedPlane = $selectedPlane;
        // $this->zona = $zona;
        // $this->tipo = $tipo;

        if (!is_null($categoria)) {
            if (!is_null($clase_id)) {
                $this->planes = Plane::where('categoria_id', '=', $categoria->id)
                    ->where('interno', 'No')
                    ->where('clase_id', '=', $clase_id)->get();
            }else{
                $this->planes = Plane::where('categoria_id', '=', $categoria->id)
                    ->where('interno', 'No')->get();
            }
            
            if(!is_null($this->planes)){
                if(is_null($this->selectedPlane)){
                    $plane = $this->planes[0];
                    $this->selectedPlane = $plane->id;
                    // $precioregistro = $plane->precios->where('zone_id', '=', $this->zona)->first();
                    // if (!is_null($precioregistro)) {
                    //     $this->precio = $precioregistro->precio;
                    // }
                    $this->dias = $plane->dias;
                    $this->precio = $plane->precio;
                }
               
            }
            
        }        
       
    }


    public function render()
    {
        
        
        return view('livewire.plan-extender-component');
    }

    public function updatedSelectedPlane($categoria)
    {
        $plan = Plane::find($this->selectedPlane);
        $this->dias = $plan->dias;
        $this->precio = $plan->precio;
        // $precioregistro = $plan->precios->where('zone_id', '=', $this->zona->id)->first();
        // if (!is_null($precioregistro)) {
        //     $this->precio = $precioregistro->precio;
        // }
    }


    // public function updatedTipo($tipo)
    // {
    //     if ($tipo=='Doble'){
    //        $this->total= $this->precio * 2; 
    //     }else{

    //         $this->total = $this->precio;

    //     }
      
     
    // }



}
