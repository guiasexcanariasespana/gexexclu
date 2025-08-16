<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnuncioFueMailable;
use App\Mail\AvisoAdminMail;
use App\Models\Anuncio;
use App\Http\Controllers\MensajeController;
use App\Mail\AnuncioFinalizadoAdminMail;

class AnuncioFinalizar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anuncio:finalizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finaliza los anuncios y envia mensaje avisando.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $anuncios = Anuncio::finalizaron();
        
        foreach($anuncios as $anuncio) {
            //paso a estado finalizado
            $anuncio->update(['estado' => 'Finalizado']);
            // //envio mail        
            Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Finalizado'));
            $user = $anuncio->user;
            $plan = $anuncio->plane;
            // // $zona = $anuncio->zone;
            $municipio = $anuncio->municipio;
            $provincia = $anuncio->provincia;
            $fecha_caducidad = $anuncio->fecha_caducidad ? date('d/m/Y', strtotime($anuncio->fecha_caducidad)) : 'N/D';                                        
            // $mensaje_sms = 'Tu anuncio en '. config('app.url')  . ' fue Finalizado el día ' . $fecha_caducidad . ' y ya no estará visible. Puedes Republicarlo en el sitio. Concepto: ' . $anuncio->nombre . ' ' . $anuncio->telefono_publicacion ;
            // $sms = new MensajeController;           
            // $sms->enviar($user->id, $user->telefono, $mensaje_sms);
            $mensaje = 'En ' . config('app.url')  .  ' El anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre .  ' fue Finalizado el día ' . $fecha_caducidad . ' y ya no estará visible. <br>';
            Mail::to(config('app.mail_admin'))->send(new AnuncioFinalizadoAdminMail($anuncio ));
        }
        return 0;
    }
}
