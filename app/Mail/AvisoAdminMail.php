<?php

namespace App\Mail;

use App\Models\Anuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoAdminMail extends Mailable
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

    function __construct($modelo, $accion, $mensaje, Anuncio $anuncio)
    {
        //
        $this->accion = $accion;
        $this->mensaje = $mensaje;
        $this->modelo = $modelo;
        $this->anuncio = $anuncio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $accion = $this->accion;
        $mensaje = $this->mensaje;
        $modelo = $this->modelo;
        $anuncio = $this->anuncio;
        
        $subjet = $modelo . ' ' . $accion;
        return $this->subject($subjet)->view('emails.aviso_admin', compact('anuncio', 'accion', 'mensaje', 'modelo'));
    }
}
