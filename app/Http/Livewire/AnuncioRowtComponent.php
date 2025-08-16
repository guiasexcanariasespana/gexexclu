<?php

namespace App\Http\Livewire;

use App\Models\Anuncio;
use Livewire\Component;

class AnuncioRowtComponent extends Component
{
    public $anuncio;
    public $selectedVerificacion;


    public function mount(Anuncio $anuncio)
    {
        $this->anuncio = $anuncio;
        $this->selectedVerificacion = $anuncio->verificacion;
    }


    public function render()
    {

        return view('livewire.anuncio-rowt-component');
    }

    public function selectedVerificacion($estado)
    {
        $this->anuncio->update(['verificacion' => $estado]);
    }

   public function verifico_si(){
        
            $this->anuncio->update(['verificacion'=>'Si']);
                    
    }

    public function verifico_rechazo()
    {

        $this->anuncio->update(['verificacion' => 'Rechazado']);
    }


}
