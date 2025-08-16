<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Plane;
use Livewire\Component;

class ModalPrecio extends Component
{
    public $open = false;
    public $selectedCategoria;
    public $planes_oro;
    public $planes_plata;
    public $planes_normal;
    public $planes_bronce;
    public $planes_diamante;


    public function render()
    {
        $categorias = Categoria::all()->pluck('nombre', 'id');
                
        if (!is_null($this->selectedCategoria)) {
            //no nulo busco para cada clase            
            $this->planes_diamante = Plane::join('clases', 'planes.clase_id', '=', 'clases.id')
                ->where('clases.nombre', 'DIAMANTE')
                ->where('interno', 'No')
                ->where('planes.categoria_id', $this->selectedCategoria)
                ->orderby('dias')->get();

            $this->planes_oro = Plane::join('clases', 'planes.clase_id', '=', 'clases.id')
                ->where('clases.nombre', 'ORO')
                ->where('interno', 'No')
                ->where('planes.categoria_id', $this->selectedCategoria)
                ->orderby('dias')->get();

            $this->planes_plata = Plane::join('clases', 'planes.clase_id', '=', 'clases.id')
                ->where('clases.nombre', 'PLATA')
                ->where('interno', 'No')
                ->where('planes.categoria_id', $this->selectedCategoria)
                ->orderby('dias')->get();

            $this->planes_bronce = Plane::join('clases', 'planes.clase_id', '=', 'clases.id')
                ->where('clases.nombre', 'BRONCE')
                ->where('interno', 'No')
                ->where('planes.categoria_id', $this->selectedCategoria)
                ->orderby('dias')->get();

            $this->planes_normal = Plane::join('clases', 'planes.clase_id', '=', 'clases.id')
                ->where('clases.nombre', 'NORMAL')
                ->where('interno', 'No')
                ->where('planes.categoria_id', $this->selectedCategoria)
                ->orderby('dias')->get();
        } else {
            //limpio cada clase
            $this->planes_oro = null;
            $this->planes_plata = null;
            $this->planes_normal = null;
            $this->planes_bronce = null;
            $this->planes_diamante = null;
        }


        return view('livewire.modal-precio', compact('categorias'));
    }

    public function change_categoria($categoria_id)
    {
        $this->categoriaSeleted = $categoria_id;
    }
}
