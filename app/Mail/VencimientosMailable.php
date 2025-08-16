<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Anuncio;

class VencimientosMailable extends Mailable
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
        $plan = $anuncio->plane;
        $zona = $anuncio->zone;
        $user = $anuncio->user;
        $municipio = $anuncio->municipio;
        $provincia = $anuncio->provincia;
        $mensaje_anuncio = 'Tu anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre;
        $dias = $this->dias;
        switch ($dias) {
            case '0':
                $mensajes_dias = 'hoy';
                break;
            case '1':
                $mensajes_dias = 'mañana';
                break;
            default:
                $mensajes_dias = 'en ' . $dias;
                break;
        }
        return $this->subject("Anuncio por Vencer")->view('emails.anuncio_x_vencer', compact('anuncio', 'mensajes_dias', 'mensaje_anuncio', 'user'));
    }
}
