<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;


class ListAnunciosUser extends Component
{
    use WithPagination;
    
    public $mostrar_cantidad = 4;

    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $anuncios_usuario = $this->user->anuncios()
        ->orderBy('fecha_de_publicacion', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate($this->mostrar_cantidad);
        return view('livewire.list_anuncios_user', compact('anuncios_usuario'));
    }
}
