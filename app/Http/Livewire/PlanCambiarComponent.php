<?php

namespace App\Http\Livewire;

use App\Models\Clase;
use Livewire\Component;
use App\Models\Plane;

class PlanCambiarComponent extends Component
{
    public $selectedPlane;
    public $planes = [];
    public $dias;
   
    public $categoria;
    public $clase_id;
    public $anuncio;
    public $clase;
    //public $total;
    public $precio;
    public $precio_pagar;
    public $saldo;




    public function mount($categoria, $selectedPlane, $anuncio, $saldo, $clase)
    {
        
        $this->categoria = $categoria;
        $this->anuncio = $anuncio;
        $this->selectedPlane = $selectedPlane;
        $this->saldo = $saldo;
        $this->clase = $clase;
        if(!is_null($clase)){
            $class = Clase::where('nombre', 'like', '%' . $clase . '%')->first();
            $this->clase_id =$class->id;
        }
        // $this->tipo = $tipo;

        if (!is_null($categoria)) {

            if (is_null($this->clase_id)) {
                $this->planes = Plane::where('categoria_id', '=', $categoria->id)
                ->where('interno', 'No')->get();
            }else{
               
                $this->planes = Plane::where('categoria_id', '=', $categoria->id)
                ->where('clase_id', $this->clase_id)
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
                    
                    
                }else{
                    $plane = Plane::find($this->selectedPlane);
                }
                $this->dias = $plane->dias;
                $this->precio = $plane->precio;
                $this->precio_pagar = $this->diferencia_pagar();
               
            }
            
        }        
       
    }


    public function render()
    {
        
        
        return view('livewire.plan-cambiar-component');
    }

    public function updatedSelectedPlane($categoria)
    {
        $plan = Plane::find($this->selectedPlane);
        $this->dias = $plan->dias;
        $this->precio = $plan->precio;
        $this->precio_pagar = $this->diferencia_pagar(); 
        // $precioregistro = $plan->precios->where('zone_id', '=', $this->zona->id)->first();
        // if (!is_null($precioregistro)) {
        //     $this->precio = $precioregistro->precio;
        // }
    }

    public function diferencia_pagar(){
       $diferencia = $this->precio - $this->saldo;
       if($diferencia <= 0){
          return 0;
       }else{
            return $diferencia;
       }
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
