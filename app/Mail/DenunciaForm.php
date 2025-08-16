<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Anuncio;

class DenunciaForm extends Mailable
{
    use Queueable, SerializesModels;
    public Anuncio $anuncio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Anuncio $anuncio, $data)
    {
        $this->data = $data;
        $this->anuncio = $anuncio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $data =  $this->data ;
        $anuncio = $this->anuncio;
        return $this->subject('Nuevo mensaje desde el formulario de denuncia')->view('emails.denuncia-form', compact('data', 'anuncio'));
    }
}
