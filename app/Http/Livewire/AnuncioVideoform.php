<?php

namespace App\Http\Livewire;

use App\Mail\NuevoVideoMaileable;
use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class AnuncioVideoform extends Component
{
    use WithFileUploads;

    public Anuncio $anuncio;
    public User $user;
    public $video;
    public $imagen_verificacion;
    public $mensaje = 'Cargando...';
    public bool $show;



    protected $rules = [
        'video.*' => 'required|mimes:mpg,mp4,avi,mpeg',
    ];


    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function mount(Anuncio $anuncio)
    {
        $this->anuncio = $anuncio;
        $this->user = $this->anuncio->user;
        if (is_null($this->anuncio->video)) {
            $this->show = false;
        } else {
            $this->show = true;
            // $this->image = $this->user->imagen_verificacion;
            // $this->imagen_verificacion = $this->user->imagen_verificacion;
        } 
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
        $name = md5($this->video . microtime()) . '.' . $this->video->extension();

        // $path = public_path() . '/images/perfil/' . $user->id . '/' . $name;
        // Public Folder
        $path = public_path() . '/videos/anuncios/' . $this->anuncio->id . '/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $moved = rename($this->video->path(), $path . $name);
 
        $this->anuncio->update(['video' => $name, 'estado_video' => 'Pendiente']);
        Mail::to(config('app.mail_admin'))->send(new NuevoVideoMaileable($this->anuncio));        
        $this->show = true;
       // $this->imagen_verificacion = $name;
        $this->emit('alert');
    }


    public function render()
    {
        return view('livewire.anuncio-videoform');
    }


    public function updatedVideo($video)
    {
        $this->emit('previewVideo');
    }
}
