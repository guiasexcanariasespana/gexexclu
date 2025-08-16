<?php

namespace App\Http\Livewire\Precios;

use App\Models\Precio;

use Livewire\Component;

class CreatePrecios extends Component
{
    public $open = false;
    public $precio;

    public function render()
    {
        $precio = new Precio();
        return view('livewire.precios.create-precios', compact('precio'));
    }
}
