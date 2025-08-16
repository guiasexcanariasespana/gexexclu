<?php

namespace App\Http\Livewire;

use App\Models\State;
use Livewire\Component;

class StateFiltro extends Component
{
    //public $states;
    public $stateSeleted;

    public function render()
    {   
        if(!is_null(session('stateSel'))){
            $this->stateSeleted = session('stateSel');
        }
        
        $states = State::all();
        return view('livewire.state-filtro', compact('states'));
    }

    public function change_state($state_id){
        $this->stateSeleted = $state_id;
        session()->put('stateSel', $this->stateSeleted);
        session()->put('islaSelec', null);
        
        $this->emit('cambio_state', $state_id);
    }



}
