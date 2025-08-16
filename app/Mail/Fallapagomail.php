<?php

namespace App\Mail;

use App\Models\Anuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Fallapagomail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    public $accion;
    public $modelo;
    public $anuncio;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    function __construct($mensaje, Anuncio $anuncio)
    {
        //
      
        $this->mensaje = $mensaje;
        $this->anuncio = $anuncio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mensaje = $this->mensaje;
        $anuncio = $this->anuncio;        
        return $this->subject('Error al procesar el pago')->view('emails.falla_pago', compact('anuncio', 'mensaje'));
    }
}
