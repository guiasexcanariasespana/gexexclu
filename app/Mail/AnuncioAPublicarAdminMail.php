<?php

namespace App\Mail;

use App\Models\Anuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnuncioAPublicarAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public $anuncio;

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
        $anuncio_str = $anuncio->id . " - " . $anuncio->nombre . ' de ' . $user->name . ' en ' . $municipio->nombre . "(" . $provincia->nombre  . ")";

        return $this->subject("Anuncio A Publicar")->view('emails.anuncio_a_publicar_admin', compact('anuncio', 'anuncio_str', 'user'));
    }
}
