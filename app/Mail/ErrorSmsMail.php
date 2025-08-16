<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorSmsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;
    public $accion;
    public $modelo;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    function __construct($modelo, $accion, $mensaje, $user_id)
    {
        //
        $this->accion = $accion;
        $this->mensaje = $mensaje;
        $this->modelo = $modelo;
        $this->user_id = $user_id;
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
        $user = User::find($this->user_id);


        $subjet = $modelo . ' ' . $accion;
        return $this->subject($subjet)->view('emails.error_sms', compact('user', 'accion', 'mensaje', 'modelo'));
    }
}
