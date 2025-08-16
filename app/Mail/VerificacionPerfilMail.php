<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
Use App\Models\User;

class VerificacionPerfilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resultado;    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
  
        $user = $this->user;
        
        return $this->subject("Novedades de tu Perfil")->view('emails.novedad_perfil', compact('user'));
    }
}
