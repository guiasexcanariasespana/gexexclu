<?php

namespace App\Mail;

use App\Models\Anuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnuncioVenceMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $anuncio;
    public $dias;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Anuncio $anuncio, $dias)
    {
        //
        $this->anuncio = $anuncio;
        $this->dias = $dias;
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
        $dias= $this->dias;
        $anuncio_str = $anuncio->id . " - " . $anuncio->nombre . ' de ' . $user->name . ' en ' . $municipio->nombre . "(" . $provincia->nombre  . ")";
        $anuncio_str .=  " Vence  " . $dias;  
        return $this->subject("Anuncio por Vencer")->view('emails.anuncio_vence_admin', compact('anuncio', 'anuncio_str', 'dias', 'user'));
    }
}
