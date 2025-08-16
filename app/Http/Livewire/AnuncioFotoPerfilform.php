<?php

namespace App\Http\Livewire;

use App\Models\Anuncio;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AnuncioFotoPerfilform extends Component
{
    use WithFileUploads;
    
    public Anuncio $anuncio;
    public User $user;
    public $image;
    public $imagen_verificacion;
    public $mensaje = 'Cargando...';
    public bool $show;

    protected $rules = [
        'image.*' => 'required|image|mimes:jpg,png,jpeg',        
    ];


    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }


    public function mount(Anuncio $anuncio)
    {
        $this->anuncio = $anuncio;
        //$this->user = $this->anuncio->user;
        if(is_null($this->anuncio->imagen_verificacion)){
            $this->show = false;            
        }else{
            $this->show = true;
            $this->image = $this->anuncio->imagen_verificacion;
            $this->imagen_verificacion = $this->anuncio->imagen_verificacion;
        }                
    }

    public function render()
    {
        

        return view('livewire.anuncio-foto-perfilform');
    }


    public function submit()
    {
        $this->mensaje = 'Validando...';        
        try {
            $this->validate();
           
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emitSelf('notify-error');
            $this->validate();
        }
       // $user = $this->anuncio->user;
        $name = md5($this->image . microtime()) . '.' . $this->image->extension();

        $path = public_path() . '/images/perfil/' . $this->anuncio->id . '/' ;
        // Public Folder

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $moved = rename($this->image->path(), $path . $name);

        $this->anuncio->update(['imagen_verificacion' => $name]);
        $this->show = true;
        $this->imagen_verificacion = $name;
        $this->emit('alert');
        $this->emit('renderpubl');
        
        
    }

   
    public function updatedImage($image)
    {
        $this->emit('previewImage');
    }

   
}
