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

class AnuncioVenceTomorrow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anuncio:vence_tomorrow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía un correo avisando que el anuncio vence tomorrow';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now()->addDays(1);
        #busco los anuncios a vencer en esa fecha
        $anuncios = Anuncio::vence_en($date->format('Y-m-d'));
        foreach ($anuncios as $anuncio) {
            //envio mail
            Mail::to($anuncio->user->email)->send(new VencimientosMailable($anuncio, '1'));
            $user = $anuncio->user;
            $plan = $anuncio->plane;
            //$zona = $anuncio->zone;
            $municipio = $anuncio->municipio;
            $provincia = $anuncio->provincia;
            $fecha_caducidad = $anuncio->fecha_caducidad ? date('d/m/Y', strtotime($anuncio->fecha_caducidad)) : 'N/D';
            $link =  route('edit_anuncio', $anuncio);            
            $mensaje_sms = 'Tu anuncio Canarias Exclusivas caduca mañana. Renueva en BBVA ES81 0182 5194 5602 0164 9056. Concepto: ' . $anuncio->nombre . ' ' . $anuncio->telefono_publicacion;
            $sms = new MensajeController;
            $sms->enviar($user->id, $user->telefono, $mensaje_sms, $link);
            Mail::to(config('app.mail_admin'))->send(new AnuncioVenceMail($anuncio, 'Mañana'));
        }
        return 0;
    }
}
