<?php

namespace App\Mail;

use App\Models\Anuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ReactivoAdminMail extends Mailable
{
    use Queueable, SerializesModels;
   public $anuncio;
   public $fecha_pausa;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Anuncio $anuncio, $fecha_pausa)
     {
     //
     $this->anuncio = $anuncio;
     $this->fecha_pausa = $fecha_pausa;
     }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $anuncio = $this->anuncio;
         $fecha_pausa = $this->fecha_pausa;
         $user = $anuncio->user;
         $municipio = $anuncio->municipio;
         $provincia = $anuncio->provincia;;

         $anuncio_str = $anuncio->slug . ' de ' . $user->name . ' en ' . $municipio->nombre .
         "(" . $provincia->nombre . ")" ;
         return $this->subject("Se reactivo el anuncio " . $anuncio->slug)->view('emails.reactivo_admin',
         compact('anuncio', 'fecha_pausa'));
    }
}
