<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Anuncio;

class CompraconfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    //public $subjet = "Tu Anuncio fué";
    public $anuncio;
    public $monto;
    public $motivo;
    //public $accion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Anuncio $anuncio, $monto, $motivo)
    {
        //
        $this->anuncio = $anuncio;
        $this->monto = $monto;
        $this->motivo = $motivo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $anuncio = $this->anuncio;
        $monto = $this->monto;
        $motivo = $this->motivo;
        $plan = $anuncio->plane;
        $user = $anuncio->user;
        $zona = $anuncio->zone;
        $municipio = $anuncio->municipio;
        $provincia = $anuncio->provincia; 
        $mensaje = 'Felicitaciones!! <br>
                            Hemos recibido y registrado tu pago por tu anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre ;


        return $this->subject('Pago recibido')->view('emails.compra_confirm', compact('monto', 'motivo', 'plan', 'anuncio',  'mensaje', 'user'));
    }
}
