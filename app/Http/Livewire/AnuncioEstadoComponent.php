<?php

namespace App\Http\Livewire;

use App\Mail\AnuncioFueMailable;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class AnuncioEstadoComponent extends Component
{
    use WithPagination;
    
    public $anuncio;
    public $selectedEstado;


    public function mount(Anuncio $anuncio)
    {
        $this->anuncio = $anuncio;
        $this->selectedEstado = $anuncio->estado;
    }

    public function render()
    {
        return view('livewire.anuncio-estado-component');
    }


    public function updatedSelectedEstado($estado)
    {
        $this->anuncio->update(['estado' => $estado ]);
        $anuncio = $this->anuncio;
        if($estado =='Suspendido' or $estado == 'Finalizado' or $estado == 'Pausado' or $estado == 'Publicado'){            
            $correo = new AnuncioFueMailable($anuncio, $estado);
            Mail::to($anuncio->user->email)->send($correo);
        }      

    }


}
