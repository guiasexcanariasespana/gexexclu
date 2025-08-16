<?php

namespace App\Http\Livewire;

use App\Mail\CambioPresentacionMaileable;
use App\Models\Anuncio;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AnuncioEdiForm extends Component
{
    public Anuncio $anuncio;
    public $presentacion_aux, $titulo, $nombre, $edad, $orientacion, $orientacion_otra,
        $nacionalidad, $profesion, $localidad, $treinta_minutos, $una_hora, $todo_el_dia,
        $cuarenta_y_cinco_minutos, $medio_dia, $hora_desplazamiento, $fin_de_semana, $horario,
        $telefono_publicacion, $whatsapp, $mostrar_en_redes;

    public $tags = [];
    public $mensaje = 'Cargando...';
    public $cambia_slug = 'No';
    
    
    protected $rules = [
        'presentacion_aux' => 'required|min:250|max:2500',
        'nombre' => 'required|max:50',
        'titulo' => 'required|max:75',
        'orientacion' => 'required',
        'edad' => 'required|numeric|gt:17',
        'telefono_publicacion' => 'required|min:9|max:9',
    ];


    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }


    public function mount(Anuncio $anuncio)
    {
        $this->anuncio = $anuncio;
        $this->presentacion_aux = $anuncio->presentacion_aux;

        $this->titulo = $anuncio->titulo;
        $this->nombre = $anuncio->nombre;
        $this->edad = $anuncio->edad;
        $this->orientacion = $anuncio->orientacion;
        $this->orientacion_otra = $anuncio->orientacion_otra;

        $this->nacionalidad = $anuncio->nacionalidad;
        $this->profesion = $anuncio->profesion;
        $this->localidad = $anuncio->localidad;
        $this->treinta_minutos = $anuncio->treinta_minutos;
        $this->una_hora = $anuncio->una_hora;
        $this->todo_el_dia = $anuncio->todo_el_dia;

        $this->cuarenta_y_cinco_minutos = $anuncio->cuarenta_y_cinco_minutos;
        $this->medio_dia = $anuncio->medio_dia;
        $this->hora_desplazamiento = $anuncio->hora_desplazamiento;
        $this->fin_de_semana = $anuncio->fin_de_semana;
        $this->horario = $anuncio->horario;

        $this->telefono_publicacion = $anuncio->telefono_publicacion;
        $this->whatsapp = $anuncio->whatsapp;
        $this->mostrar_en_redes = $anuncio->mostrar_en_redes;

        $this->tags = $anuncio->tags->pluck('id');
        // dd($this->tags);

    }

    public function render()
    {
        $anuncio = $this->anuncio;
        //dd($anuncio->id);
        $user = $this->anuncio->user;
        if (is_null($anuncio)) {
            $anuncio = $user->anuncios->whereIn('estado', ['Borrador', 'Publicado', 'Pausado'])
                ->where('estado_pago', 'Si')->SortBy('created_at desc')->last();
        }

        $tags_al = Tag::where('rubro', 'AL')->orderBy('nombre')->get();
        $tags_etc =  Tag::where('rubro', 'ETC')->orderBy('nombre')->get();
        $tags_ec =  Tag::where('rubro', 'EC')->orderBy('nombre')->get();
        $tags_in =  Tag::where('rubro', 'In')->orderBy('nombre')->get();
        return view('livewire.anuncio-edi-form', compact('anuncio', 'user', 'tags_al', 'tags_etc', 'tags_ec', 'tags_in'));
    }


    public function submit()
    {
       
     $this->mensaje = 'Validando...';
        $this->emit('alert');
        try {
           $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emit('notify-error');
            $this->validate();
        }
        $this->seteo_datos_anuncio();
        $this->mensaje = 'Guardando...';
        $this->anuncio->save();
        $this->anuncio->tags()->sync($this->tags);

        if ($this->anuncio->presentacion != $this->anuncio->presentacion_aux) {
            //cambio el texto de presentacion aviso que preste atención
            $mensaje = 'El anuncio de ' . $this->anuncio->user->name . '. Con clase ' . $this->anuncio->clase->nombre . ' en ' . $this->anuncio->municipio->nombre . ' (' . $this->anuncio->provincia->nombre . ') en la categoría ' . $this->anuncio->categoria->nombre .  ' fué modificado deberías controlarlo. <br>';
            $mensaje .= 'Accede al Anuncio para controlarlo siguiendo este enlace  <a class="btn btn-info btn-sm ml-4"
                                href="' . route('admin.users.edit_anuncio', $this->anuncio) . '"> ' .  $this->anuncio->id . '-' . $this->anuncio->nombre . '</a>';
            $this->mensaje = '';
            Mail::to(config('app.mail_admin'))->send(new CambioPresentacionMaileable($this->anuncio));
        }
        
        
       
        if ($this->cambia_slug == 'Si'){
            return redirect(route('edit_anuncio', $this->anuncio));
        }else{
            $this->mensaje = 'Cargando...';
            //Mail::to(config('app.mail_admin'))->send(new CambioPresentacionMaileable($this->anuncio));
            $this->emit('renderpubl');
        }
        

       
        
    }

    public function seteo_datos_anuncio()
    {
        $slug = $this->anuncio->id . '-' . $this->nombre;
        
        
        if ($this->anuncio->slug != $slug){
            $this->cambia_slug = 'Si';
        }else{
            $this->cambia_slug = 'No';
        }
        $this->anuncio->slug = $slug;
        $this->anuncio->presentacion_aux = $this->presentacion_aux;

        $this->anuncio->titulo = $this->titulo;
        $this->anuncio->nombre = $this->nombre;
        $this->anuncio->edad = $this->edad;
        $this->anuncio->orientacion = $this->orientacion;
        $this->anuncio->orientacion_otra = $this->orientacion_otra;

        $this->anuncio->nacionalidad = $this->nacionalidad;
        $this->anuncio->profesion = $this->profesion;
        $this->anuncio->localidad = $this->localidad;
        $this->anuncio->treinta_minutos = $this->treinta_minutos;
        $this->anuncio->una_hora = $this->una_hora;
        $this->anuncio->todo_el_dia = $this->todo_el_dia;

        $this->anuncio->cuarenta_y_cinco_minutos = $this->cuarenta_y_cinco_minutos;
        $this->anuncio->medio_dia = $this->medio_dia;
        $this->anuncio->hora_desplazamiento = $this->hora_desplazamiento;
        $this->anuncio->fin_de_semana = $this->fin_de_semana;
        $this->anuncio->horario = $this->horario;

        $this->anuncio->telefono_publicacion = $this->telefono_publicacion;
        $this->anuncio->whatsapp = $this->whatsapp;
        $this->anuncio->mostrar_en_redes = $this->mostrar_en_redes;

        if ($this->anuncio->estado == 'Borrador' or $this->anuncio->estado == 'Finalizado' or $this->anuncio->estado == 'Suspendido') {

            $this->anuncio->presentacion = $this->anuncio->presentacion_aux;
            // Mail::to(config('app.mail_admin'))->send(new CambioPresentacionMaileable($anuncio));
        }
        
    }


    public function updatedPresentacionAux($presentacion_aux)
    {

        $this->emit('verificar');
    }
    
}
