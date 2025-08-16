<?php

namespace App\Console\Commands;

use App\Mail\AvisoAdminMail;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Mail;
use App\Mail\VencimientosMailable;
use App\Http\Controllers\MensajeController;
use App\Mail\AnuncioVenceMail;

class AnuncioVence3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anuncio:vence3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía un correo avisando que el anuncio vence en 3 días';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ######################################
        #Notifico los anuncios a vencer en 2 días
        ######################################
        #tomo fecha hoy y le sumo 2 días
        $date = Carbon::now()->addDays(2);
        #busco los anuncios a vencer en esa fecha
        $anuncios = Anuncio::vence_en($date->format('Y-m-d'));
        foreach ($anuncios as $anuncio) {
            //envio mail
            Mail::to($anuncio->user->email)->send(new VencimientosMailable($anuncio, '2'));
            $user = $anuncio->user;
            $plan = $anuncio->plane;
           // $zona = $anuncio->zone;
            $municipio = $anuncio->municipio;
            $provincia = $anuncio->provincia;
            $fecha_caducidad = $anuncio->fecha_caducidad ? date('d/m/Y', strtotime($anuncio->fecha_caducidad)) : 'N/D';
            $mensaje_sms = env('TEXT_48H') . ' Concepto: ' . $anuncio->nombre . ' ' . $anuncio->telefono_publicacion;
            # $mensaje_sms = 'Tu anuncio ' . $plan->clase->nombre . ' ' . $anuncio->dias . ' días en ' . $municipio->nombre . ' (' . $provincia->nombre . ') en la categoría ' . $anuncio->categoria->nombre .  ' vence en 3 días ' . $fecha_caducidad . ' y ya no estará visible. Renovalo. ';
            $link =  route('edit_anuncio', $anuncio);
            $sms = new MensajeController;
            $sms->enviar($user->id, $user->telefono, $mensaje_sms, $link);
            Mail::to(config('app.mail_admin'))->send(new AnuncioVenceMail($anuncio, 'en 3 días'));
        }
        #por cada uno envío el mail notificando
        return 0;
    }
}
