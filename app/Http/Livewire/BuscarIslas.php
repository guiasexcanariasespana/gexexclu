<?php

namespace App\Http\Livewire;

use App\Models\Isla;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class BuscarIslas extends Component
{
    public $islaSeleted;


    protected $listeners = [
        'cambio_state' => 'cambio_state',
    ];

    // public function mount(){
    //     $this->islaSeleted = null;
    //     session()->put('islaSelec', null);
    //     Session::forget('islaSelec');
    // }

    public function render()
    {

        if (!is_null(session('islaSelec'))) {
            
            $this->islaSeleted = session('islaSelec');
        }

        if (!is_null(session('stateSel'))) {
            $islas = Isla::where('state_id', session('stateSel'))->get();
        } else {
            $islas = Isla::all();
        }


        return view('livewire.buscar-islas', compact('islas'));
    }

    // public function updatingIslaSelected($isla_id)
    // {
    //     $this->islaSeleted = $isla_id;
    //     session()->put('islaSel', $this->islaSeleted);
    // }


    public function cambio_state()
    {
        //limpio la session
        $this->islaSeleted = null;
        session()->put('islaSelec', null);
        Session::forget('islaSelec');
        
    }


    public function change_isla($isla_id)
    {

        $this->islaSeleted = $isla_id;
        session()->put('islaSelec', $this->islaSeleted);
        
        $this->emit('cambio_isla', $isla_id);
        
    }
}
