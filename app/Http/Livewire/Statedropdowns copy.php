<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Plane;
use Livewire\Component;
use App\Models\State;
use App\Models\Zone;

class Statedropdowns extends Component
{
    public $state;
    public $zones=[];
    public $zone;
    public $zonas;

    public $plane;
    public $planes = [];


    public function mount($state, $zone, $plane)
    {

        $this->state = $state;
        $this->zone = $zone;
        $this->plane = $plane;
    }

    public function render()
    {
        $this->categorias = Categoria::orderBy('nombre', 'asc')->pluck('nombre', 'id');        
        #$this->planes = Plane::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $states = State::orderBy('name')->get();
        $this->busco_zona($states);                
        $this->busco_planes();
        ##Busco el plan y el precio
        $states = $states->pluck('name', 'id');
         if (!empty($this->zone)) {
            
             $this->zone = $this->zone->id;
           // dd($this->zone);
         }
        return view('livewire.statedropdowns', compact('states'));
    }

    protected function busco_zona($states){
        if (!empty($this->state)) {
            //dd($states = State::orderBy('name')->pluck('name', 'id'));
            //$this->cities = Zone::where('country_id', $this->country)->get();
            $this->zones = Zone::where('state_id', $this->state)->orderBy('nombre')->get();
            $this->zone = $this->zones->first()->get();
            $this->zones = $this->zones->pluck('nombre', 'id');
            #Busco plan para la zona

        } else {
            if (!empty($states)) {
                $state = $states->first();
                //dd($state);
                $this->zones = $state->zones->sortBy('nombre');
                $this->zone = $this->zones->first();
                $this->zones = $this->zones->pluck('nombre', 'id');
            }
        }
    }

    protected function busco_planes(){              
        if (!empty($this->zone)) {
            //dd($this->zone);
            //dd($states = State::orderBy('name')->pluck('name', 'id'));
            //$this->cities = Zone::where('country_id', $this->country)->get();
            #$zona = Zone::where('id', '=', $this->zone->id)->first();
            #$zona =  $this->zone->id;
            $this->planes = Plane::wherein('id', $this->zone->planes_ids())->pluck('nombre', 'id');

        } else {            
                $this->planes = [];
        }
    }



}
