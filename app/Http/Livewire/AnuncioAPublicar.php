<?php

namespace App\Http\Livewire;

use App\Models\Anuncio;
use App\Models\User;
use Livewire\Component;

class AnuncioAPublicar extends Component
{
    public Anuncio $anuncio;    
    public User $user;
    public bool $foto_perfil;
    public bool $cantidad_imagenes;
    public bool $telefono;
    public $mensaje = 'Cargando...';


    protected $listeners = ['renderpubl' => 'render'];

    public function mount(Anuncio $anuncio)
    {
        $this->anuncio = $anuncio;
        $this->user = $this->anuncio->user;        
        
    }

    public function render()    
    {
        $this->foto_perfil =  !is_null($this->anuncio->imagen_verificacion) ;  
        $this->cantidad_imagenes = !$this->anuncio->cantidad_imagenes_subidas() == 0;
        $this->telefono =  !is_null($this->anuncio->telefono_publicacion);
        
              
        return view('livewire.anuncio-a-publicar');
    }
}

