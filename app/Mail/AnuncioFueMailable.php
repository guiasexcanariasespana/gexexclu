<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Anuncio;
use Carbon\Carbon;

class AnuncioFueMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subjet = "Tu Anuncio fué";
    public $anuncio;
    public $accion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Anuncio $anuncio, $accion)
    {
        $this->anuncio = $anuncio;
        $this->accion = $accion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { //'Borrador', 'Publicado', 'Pausado', 'Finalizado', 'Suspendido', 'Rechazado'  
       $anuncio = $this->anuncio;
       $estado = $this->accion;
        $user = $anuncio->user;
        $plan = $anuncio->plane;
        $zona = $anuncio->zone;
        $municipio = $anuncio->municipio;
        $provincia = $anuncio->provincia;   
        $mensaje = '';     
       switch($this->accion) {
            case('Aprobado'):
                $subjet = $this->subjet . " Publicado ";
                $fecha_publi = $anuncio->fecha_de_publicacion ? date('d/m/Y', strtotime($anuncio->fecha_de_publicacion)) : 'N/D';
                $fecha_fin = $anuncio->fecha_caducidad ? date('d/m/Y', strtotime($anuncio->fecha_caducidad)) : 'N/D';
                $mensaje = 'Felicitaciones!! <br>
                           Tu anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' ('. $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre . ' inicia el ' . $fecha_publi . ' y estará visible durante ' 
                            . $anuncio->dias . ' días. Vencerá el ' . $fecha_fin . ' <br> Ante cualquier inconveniente o duda contacte al 610829595 <br>Saludos';

                break;
 
            case('Pausado'):
                $subjet = $this->subjet . " Pausado ";
                $fecha_pausa = $anuncio->fecha_pausa ? date('d/m/Y', strtotime($anuncio->fecha_pausa)) : 'N/D';   
                   
                $mensaje = 'Tu anuncio ' . $anuncio->slug . ' con plan '. $anuncio->plane->nombre . ' por ' .
                $anuncio->plane->dias . ' días en ' .
                $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre . '
                , fue pausado el día ' . $fecha_pausa . ' y no estará visible. <br>'
                . 'No te preocupes que no se descuentan los días mientras este pausado. Te guardamos ' .
                $anuncio->dias_restantes() . ' de los ' . $anuncio->plane->dias . ' días contratados <br>' .
                ' <br> Te avisaremos cuando se reactive!!.
                <br> Ante cualquier inconveniente o duda contacte al 610829595 <br>Saludos';
                break;

            case ('Finalizado'):
                $subjet = $this->subjet . " Finalizado ";
                $fecha_caducidad = $anuncio->fecha_caducidad ? date('d/m/Y', strtotime($anuncio->fecha_caducidad)) : 'N/D';                
                $mensaje = 'Tu anuncio ' . $anuncio->slug . ' con plan '. $anuncio->plane->nombre . ' por ' .
                $anuncio->plane->dias . ' días en ' .
                $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre . '
                fue Finalizado el día ' . $fecha_caducidad . ' y ya no estará visible. <br>'
                . 'Esperamos volver a verte pronto!!. <br> 
                <br> Ante cualquier inconveniente o duda contacte al 610829595 
                <br> Saludos';
                break;

            case ('Suspendido'):
                $subjet = $this->subjet . " Suspendido ";
                $mensaje = 'Lamentablemte tu anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' ('. $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre . ' fue Suspendido  y no estará visible mientras este Suspendido. <br>'
                . 'Ponte en contacto con nosotros para mas detalles o descargo.<br>
                Ante cualquier inconveniente o duda contacte al 610829595. <br>Saludos';
                break;

            case ('Rechazado'):
                $subjet = $this->subjet . " Rechazado ";                
                $mensaje = 'Lamentablemte tu anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre . ' fue Rechazado  y no estará visible. <br>'
                . 'Ponte en contacto con nosotros para mas detalles o descargo. <br>
                Ante cualquier inconveniente o duda contacte al 610829595. <br>Saludos';
                break;
            case ('Reactivado'):
                $subjet = $this->subjet . " Reactivado ";
                $fecha_pausa = $anuncio->fecha_pausa ? date('d/m/Y', strtotime($anuncio->fecha_pausa)) : 'N/D';
                $mensaje = 'Tu anuncio ' . $anuncio->slug . ' con plan '. $anuncio->plane->nombre . ' por ' . $anuncio->plane->dias . ' días en ' .
                $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre . '
                fue Reactivado el día ' . date('d-m-Y', strtotime($anuncio->fecha_de_publicacion)) . '. Te quedan ' . $anuncio->dias_restantes() . ' de los ' . $anuncio->plane->dias . ' días contratados
                <br>' .
                'Estará publicado hasta el día ' . date('d/m/Y', strtotime($anuncio->fecha_caducidad))                 
                . '<br> Ante cualquier inconveniente o duda contacte al 610829595. Saludos!!.';    
 
            // default:
            //     $msg = 'Something went wrong.';
        }
        return $this->subject($subjet)->view('emails.anunciofue', compact('estado', 'mensaje', 'user', 'anuncio'));
    }
}
