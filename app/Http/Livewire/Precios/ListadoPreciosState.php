<?php

namespace App\Http\Livewire\Precios;

use Livewire\Component;

class ListadoPreciosState extends Component
{
    public $open=false;
    public function render()
    {
        return view('livewire.precios.listado-precios-state');
    }
}
