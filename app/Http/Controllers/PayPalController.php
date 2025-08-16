<?php

namespace App\Http\Controllers;

use App\Mail\AvisoAdminMail;
use App\Models\Anuncio;
use App\Models\Pago;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Mail\CompraconfirmMail;
use App\Models\Plane;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PayPalController extends Controller
{
    //

    private $client;
    private $clientId;
    private $secret;


    public function __construct()
    {
        if (config('app.paypal_mode') == 'sandbox') {
            $this->client = new Client([
                //'base_uri' => 'https://api-m.paypal.com'
                'base_uri' => 'https://api-m.sandbox.paypal.com'
            ]);
        } else {

            $this->client = new Client([
                'base_uri' => 'https://api-m.paypal.com'
                //'base_uri' => 'https://api-m.sandbox.paypal.com'
            ]);
        }

        $this->clientId = config('app.paypal_client_id');
        $this->secret = config('app.paypal_client_secret');
    }


    // public function guardar($data)
    // {
    //     dd($data);
    // }




    private function getAccessToken()
    {
        $response = $this->client->request(
            'POST',
            '/v1/oauth2/token',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => 'grant_type=client_credentials',
                'auth' => [$this->clientId, $this->secret, 'basic']
            ]
        );

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function process($orderId, Request $request)
    {


        $accessToken = $this->getAccessToken();

        $requestUrl = "/v2/checkout/orders/" . $orderId . '/capture';

        $response = $this->client->request('POST', $requestUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'COMPLETED') {
            $captures = $data['purchase_units'][0]['payments']['captures'];
            $payPalPaymentId = $captures[0]['id'];
            $amount = $captures[0]['amount']['value'];
            $create_time = $captures[0]['create_time'];
            $paypal_fee = $captures[0]['seller_receivable_breakdown']['paypal_fee']['value'];
            $payer_email = $data['payer']['email_address'];
            if (!is_null($create_time)) {
                //doy formato
                $create_time = \Carbon\Carbon::parse($create_time)->format('Y-m-d H:i:s');
            } else {
                $create_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            }
            //     //what we want to do?
            //guardo el pago
            $anuncio = Anuncio::find($request->anuncio_id);
            // if ($anuncio->precio < $amount + 0.1 ){
            $anuncio->update(['estado_pago' => 'Si']);
            //  }            
            $user = $anuncio->user;
            $pago = Pago::create([
                'user_id' => $user->id, //Auth::id(),
                'mail_pago' => $payer_email,
                'anuncio_id' => $request->anuncio_id,
                'moneda_precio' => 'EUR',
                'precio' => $anuncio->precio,
                'moneda_pago' => 'EUR',
                'monto_pago' => $amount,
                'fee' => $paypal_fee,
                'medio_pago' => 'Paypal',
                'nro_transac' => $orderId,
                'fecha_transac' => $create_time, #fecha del pago
                'estado' => 'Aprobado',
            ]);
            //Enviar mail de notificación
            $anuncio = Anuncio::find($request->anuncio_id);
            $correo = new CompraconfirmMail($anuncio,$amount, 'Compra');
            Mail::to($user->email)->send($correo);
            $mensaje = 'Hemos registrado el pago del anuncio '  . $anuncio->nombre . ' ' . $anuncio->dias . ' días del  Usuario ' . $user->name .
                '<br>Monto: €' . $amount .
                '<br>nro_transac: ' . $orderId .
                '<br>mail_pago: '  . $payer_email;
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Paypal', 'Cobro Recibido', $mensaje, $anuncio));
        } else {
            $anuncio = Anuncio::find($request->anuncio_id);
            $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre . ' con oder_id = ' . $orderId;
            $mensaje .= ' usuario ' . $anuncio->user->name . '<br>';
            $mensaje .= ' Anuncio ' . $anuncio->id .  ' ' .  $anuncio->titulo .  '<br>';            
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Paypal', 'No se pudo cobrar', $mensaje, $anuncio));
            return [
                'success' => false
            ];
        }

        return [
            'success' => true,
            'url' => route('dashboard', $anuncio),
        ];
        //$data = json_decode($response->getBody(), true);


    }


    public function process_ext($orderId, Request $request)
    {


        $accessToken = $this->getAccessToken();

        $requestUrl = "/v2/checkout/orders/" . $orderId . '/capture';

        $response = $this->client->request('POST', $requestUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'COMPLETED') {
            $captures = $data['purchase_units'][0]['payments']['captures'];
            $payPalPaymentId = $captures[0]['id'];
            $amount = $captures[0]['amount']['value'];
            $create_time = $captures[0]['create_time'];
            $paypal_fee = $captures[0]['seller_receivable_breakdown']['paypal_fee']['value'];
            $payer_email = $data['payer']['email_address'];
            if (!is_null($create_time)) {
                //doy formato
                $create_time = \Carbon\Carbon::parse($create_time)->format('Y-m-d H:i:s');
            } else {
                $create_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            }
            //     //what we want to do?

            $plan = Plane::find($request->plan_id);

            //guardo el pago
            $anuncio = Anuncio::find($request->anuncio_id);
            ///Sumo los días
            $dias_tot = $anuncio->dias + $plan->dias;
            //recalculo la fecha de caducidad
            $fecha_fin = Carbon::parse($anuncio->fecha_caducidad);
            $hora_actual = Carbon::now()->format('H');

            $precio_tot = $anuncio->precio +  $plan->precio;
            //$hora_actual = $fecha_publi->format('H');
            if ($hora_actual > config('app.hora_agregar_dia')) {
                $fecha_fin->addDays($plan->dias);
            } else {
                $fecha_fin->addDays($plan->dias - 1);
            }


            $user = $anuncio->user;
            // $debe_pagar = $plan->precio;
            // if($amount + 0.1 >= $debe_pagar ){
            //pago lo que corresponde
            $pago = Pago::create([
                'user_id' => $user->id, //Auth::id(),
                'mail_pago' => $payer_email,
                'anuncio_id' => $request->anuncio_id,
                'moneda_precio' => 'EUR',
                'precio' => $anuncio->precio,
                'moneda_pago' => 'EUR',
                'monto_pago' => $amount,
                'fee' => $paypal_fee,
                'medio_pago' => 'Paypal',
                'nro_transac' => $orderId,
                'fecha_transac' => $create_time, #fecha del pago
                'estado' => 'Aprobado',
            ]);
            $anuncio->update([
                'dias' => $dias_tot,
                'fecha_caducidad' => $fecha_fin,
                'precio' => $precio_tot,
                'estado_pago' => 'Si'
            ]);
            // }
            //si paso algo y pago de menos
            //lo registro y Sumo al precio del plan
            // $pago = Pago::create([
            //     'user_id' => $user->id, //Auth::id(),
            //     'mail_pago' => $payer_email,
            //     'anuncio_id' => $request->anuncio_id,
            //     'moneda_precio' => 'EUR',
            //     'precio' => $anuncio->precio,
            //     'moneda_pago' => 'EUR',
            //     'monto_pago' => $amount,
            //     'fee' => $paypal_fee,
            //     'medio_pago' => 'Paypal',
            //     'nro_transac' => $orderId,
            //     'fecha_transac' => $create_time, #fecha del pago
            //     'estado' => 'Aprobado',
            // ]);


            //Enviar mail de notificación
            $anuncio = Anuncio::find($request->anuncio_id);
            $correo = new CompraconfirmMail($anuncio, $amount, 'Extension');
            Mail::to($user->email)->send($correo);
            $mensaje = 'Hemos registrado el pago de la extensión de tu anuncio '  . $anuncio->nombre . ' ' . $anuncio->dias . ' días del  Usuario ' . $user->name .
                '<br>Monto: €' . $amount .
                '<br>nro_transac: ' . $orderId .
                '<br>mail_pago: '  . $payer_email;
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Paypal', 'Cobro Recibido', $mensaje, $anuncio));
        } else {
            $anuncio = Anuncio::find($request->anuncio_id);
            $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre . ' con oder_id = ' . $orderId;
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Paypal', 'No se pudo cobrar', $mensaje, $anuncio));
            return [
                'success' => false
            ];
        }

        return [
            'success' => true,
            'url' => route('dashboard', $anuncio),
        ];
        //$data = json_decode($response->getBody(), true);


    }

    public function process_cambio($orderId, Request $request)
    {

        $accessToken = $this->getAccessToken();

        $requestUrl = "/v2/checkout/orders/" . $orderId . '/capture';

        $response = $this->client->request('POST', $requestUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'COMPLETED') {
            $captures = $data['purchase_units'][0]['payments']['captures'];
            $payPalPaymentId = $captures[0]['id'];
            $amount = $captures[0]['amount']['value'];
            $create_time = $captures[0]['create_time'];
            $paypal_fee = $captures[0]['seller_receivable_breakdown']['paypal_fee']['value'];
            $payer_email = $data['payer']['email_address'];
            if (!is_null($create_time)) {
                //doy formato
                $create_time = \Carbon\Carbon::parse($create_time)->format('Y-m-d H:i:s');
            } else {
                $create_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            }
            //     //what we want to do?

            $plan = Plane::find($request->plan_id);

            $precio_pago = $request->precio;
            //guardo el pago
            $anuncio = Anuncio::find($request->anuncio_id);
            ///Como abono descontandos los días no usados 
            //anulos los días y sumo desde hoy x días
            //
            // $debe_pagar = $plan->precio - $anuncio->saldo_a_favor();
            // if ($amount + 0.1 >= $debe_pagar) {
            $dias_tot = $plan->dias;
            //recalculo la fecha de caducidad
            $fecha_fin =  Carbon::now();
            $hora_actual = Carbon::now()->format('H');
            //$hora_actual = $fecha_publi->format('H');
            if ($anuncio->estado == 'Publicado' || $anuncio->estado == 'Pausado') {
                if ($hora_actual > config('app.hora_agregar_dia')) {
                    $fecha_fin->addDays($plan->dias);
                } else {
                    $fecha_fin->addDays($plan->dias - 1);
                }

                if ($anuncio->estado == 'Publicado'){ 
                      $anuncio->update([
                        'plane_id' => $plan->id,
                        'clase_id' => $plan->clase_id,
                        'dias' => $dias_tot,
                        'fecha_caducidad' => $fecha_fin,
                        'precio' => $plan->precio,
                        'fecha_de_publicacion' => Carbon::now(),
                        'estado_pago' => 'Si'
                    ]);
                }else{
                    //pausado, pongo como actualla fecha de pausa
                    $anuncio->update([
                        'plane_id' => $plan->id,
                        'clase_id' => $plan->clase_id,
                        'dias' => $dias_tot,
                        'fecha_caducidad' => $fecha_fin,
                        'precio' => $plan->precio,
                        'fecha_de_publicacion' => Carbon::now(),
                        'fecha_pausa' => Carbon::now(),
                        'estado_pago' => 'Si'
                    ]);
                }
            }else{
                $anuncio->update([
                    'plane_id' => $plan->id,
                    'clase_id' => $plan->clase_id,
                    'dias' => $dias_tot,                    
                    'precio' => $plan->precio,                    
                    'estado_pago' => 'Si'
                ]);

            }
            
            // }else{
            //     //Algo paso y pago menos
            //     $anuncio->update([                   
            //         'precio' => $anuncio->precio + $amount,
            //     ]);
            // }

            $user = $anuncio->user;
            Pago::create([
                'user_id' => $user->id, //Auth::id(),
                'mail_pago' => $payer_email,
                'anuncio_id' => $request->anuncio_id,
                'moneda_precio' => 'EUR',
                'precio' => $plan->precio,
                'moneda_pago' => 'EUR',
                'monto_pago' => $amount,
                'fee' => $paypal_fee,
                'medio_pago' => 'Paypal',
                'nro_transac' => $orderId,
                'fecha_transac' => $create_time, #fecha del pago
                'estado' => 'Aprobado',
            ]);
            //Enviar mail de notificación
            $anuncio = Anuncio::find($request->anuncio_id);
            $correo = new CompraconfirmMail($anuncio,$amount, 'Cambio Plan');
            Mail::to($user->email)->send($correo);
            $mensaje = 'Hemos registrado el pago de cambio de plan de tu anuncio '  . $anuncio->nombre . ' ' . $anuncio->dias . ' días del  Usuario ' . $user->name .
                '<br>Monto: €' . $amount .
                '<br>nro_transac: ' . $orderId .
                '<br>mail_pago: '  . $payer_email;
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Paypal', 'Cobro Recibido', $mensaje, $anuncio));
        } else {
            $anuncio = Anuncio::find($request->anuncio_id);
            $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre . ' con oder_id = ' . $orderId;
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Paypal', 'No se pudo cobrar', $mensaje, $anuncio));
            return [
                'success' => false
            ];
        }

        return [
            'success' => true,
            'url' => route('dashboard', $anuncio),
        ];
        //$data = json_decode($response->getBody(), true);


    }
}
