<?php

namespace App\Http\Livewire;

use App\Models\Isla;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class BuscarMuni extends Component
{
    public $muniSeleted;


    // protected $listeners = [
    //     'cambio_state' => 'cambio_state',
    // ];

    // public function mount(){
    //     $this->islaSeleted = null;
    //     session()->put('islaSelec', null);
    //     Session::forget('islaSelec');
    // }

    public function render()
    {

        if (!is_null(session('muniSelec'))) {

            $this->muniSeleted = session('muniSelec');
        }


        // $this->municipios = Municipio::select('municipios.id', 'count(anuncios.id) as cant_anun')
        // ->join('anuncios', 'municipios.id', '=', 'anuncios.municipio_id')
        // ->where('anuncios.provincia_id', '=', 1)->orderBy('nombre')->get();

        if (!is_null(session('provinciaSel'))) {
            // $municipios = Municipio::->get();
            $municipios = Municipio::selectRaw('municipios.* , count(anuncios.id) as cant_anun')
            ->join('anuncios', 'municipios.id', '=', 'anuncios.municipio_id')
            ->where('municipios.provincia_id', session('provinciaSel'))
            ->where('anuncios.verificacion', '=', 'Si')
            ->where('anuncios.estado', 'Publicado')
                ->groupBy('municipios.id', 'municipios.nombre', 'municipios.slug', 'municipios.provincia_id', 'municipios.created_at', 'municipios.updated_at', 'municipios.deleted_at')
                ->orderByRaw('cant_anun desc')
                ->get();
        } else {
            //$municipios = Municipio::all()
            $municipios = Municipio::selectRaw('municipios.* , count(anuncios.id) as cant_anun')
                ->join('anuncios', 'municipios.id', '=', 'anuncios.municipio_id')
                ->where('anuncios.verificacion', '=', 'Si')
                ->where('anuncios.estado', 'Publicado')
                ->groupBy('municipios.id')
                ->orderByRaw('cant_anun desc')
                ->get();
        }


        return view('livewire.buscar-muni', compact('municipios'));
    }

    // public function updatingIslaSelected($isla_id)
    // {
    //     $this->islaSeleted = $isla_id;
    //     session()->put('islaSel', $this->islaSeleted);
    // }


    // public function cambio_state()
    // {
    //     //limpio la session
    //     $this->islaSeleted = null;
    //     session()->put('islaSelec', null);
    //     Session::forget('islaSelec');

    // }


    public function change_muni($muni_id)
    {
        //dd('hola');
        $this->muniSeleted = $muni_id;
        session()->put('muniSelec', $this->muniSeleted);

        $this->emit('cambio_muni', $muni_id);
        
    }
}
