<?php

namespace App\Http\Livewire;
use App\Models\Anuncio;
use Livewire\Component;
use Livewire\WithPagination;

class AnuncioQuitarComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $anuncio;
    public $showDiv = false;

    // public function mount($anuncio){
    //     $this->anuncio = $anuncio;
    // }

    public function render()
    {
        return view('livewire.anuncio-quitar-component');
    }


    public function destroy($id)
    {
       Anuncio::destroy($id);
        $this->reset();
        $this->anuncio = null;
        $this->showDiv = false;
       $this->emit('render') ;
    }


}
