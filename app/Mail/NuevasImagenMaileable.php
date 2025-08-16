<?php

namespace App\Mail;

use App\Models\Anuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevasImagenMaileable extends Mailable
{
    use Queueable, SerializesModels;

    public $anuncio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Anuncio $anuncio)
    {
        //
        $this->anuncio = $anuncio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $anuncio = $this->anuncio;
        $user = $anuncio->user;
        $municipio = $anuncio->municipio;
        $provincia = $anuncio->provincia;;

        $anuncio_str = $anuncio->id . " - " . $anuncio->nombre . ' de ' . $user->name . ' en ' . $municipio->nombre . "(" . $provincia->nombre  . ")"  ;
        return $this->subject("Modificacion fotos de Anuncios")->view('emails.nuevas_imagen_admin', compact('anuncio', 'anuncio_str', 'user'));
    }
}
