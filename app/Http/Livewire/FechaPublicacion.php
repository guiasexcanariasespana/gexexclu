<?php

namespace App\Http\Livewire;

use App\Models\Anuncio;
use Livewire\Component;

class FechaPublicacion extends Component
{
    public $fechaPublicacion;
    public $anuncio;

    public function mount(Anuncio $anuncio, $fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
        $this->anuncio = $anuncio;
    }

    public function render()
    {   $anuncio = $this->anuncio;
        return view('livewire.fecha-publicacion', compact('anuncio'));
    }
}
