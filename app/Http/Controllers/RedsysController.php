<?php

namespace App\Http\Controllers;

use App\Mail\AvisoAdminMail;
use Illuminate\Http\Request;

use Ssheduardo\Redsys\Facades\Redsys;
use Exception;
use Sermepa\Tpv\TpvException;
use App\Models\Pago;
use App\Models\Anuncio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompraconfirmMail;
use App\Mail\Fallapagomail;
use App\Models\Plane;
use App\Models\User;

class RedsysController extends Controller
{
    public static function index($amount, $display = true, $des = false, $anuncio_id)
    {
        try {

            $order = Carbon::now()->format('zHm') . $anuncio_id;
            $order = str_pad($order, 12, 0, STR_PAD_LEFT);
            $key = config('redsys.key');
            $merchantcode = config('redsys.merchantcode');
            $terminal = config('redsys.terminal');
            $enviroment = config('redsys.enviroment');
            $urlOk = (route('redsys.comprobar', $anuncio_id));
            $urlKo = url(config('redsys.url_ko'));
            $urlNotification = url(config('redsys.url_notification'));
            $tradeName = config('redsys.tradename');
            $titular = config('redsys.titular');
            $description = $des ? $des : config('redsys.description');
            Redsys::setAmount($amount);
            Redsys::setOrder($order);
            Redsys::setMerchantcode($merchantcode);
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal($terminal);
            Redsys::setMethod('C');
            Redsys::setNotification(config('redsys.url_notification'));
            Redsys::setUrlOk(route('redsys.comprobar', $anuncio_id));
            Redsys::setUrlKo(config('redsys.url_ko'));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName($tradeName);
            Redsys::setTitular($titular);
            Redsys::setProductDescription($description);
            Redsys::setEnviroment($enviroment);
            $signature = Redsys::generateMerchantSignature($key);
            //sdd(Redsys::generateMerchantParameters());
            Redsys::setMerchantSignature($signature);
            if ($display == false) {
                Redsys::setAttributesSubmit('btn_submit', 'btn_id', 'Enviar', 'display:none');
                return Redsys::executeRedirection();
            } else {
                Redsys::setAttributesSubmit('btn_submit', 'btn_id', 'Pagar con Redsys', '');
                $form = Redsys::createForm();
                return $form;
            }
        } catch (Exception $e) {
            echo 'error' . $e->getMessage();
        }
    }


    public static function index_bizum($amount, $display = true, $des = false, $anuncio_id)
    {
        try {

            $order = Carbon::now()->format('zHm') . $anuncio_id;
            $order = str_pad($order, 12, 0, STR_PAD_LEFT);
            $key = config('redsys.key');
            $merchantcode = config('redsys.merchantcode');
            $terminal = config('redsys.terminal');
            $enviroment = config('redsys.enviroment');
            $urlOk = (route('redsys.comprobar', $anuncio_id));
            $urlKo = url(config('redsys.url_ko'));
            $urlNotification = url(config('redsys.url_notification'));
            $tradeName = config('redsys.tradename');
            $titular = config('redsys.titular');
            $description = $des ? $des : config('redsys.description');
            Redsys::setAmount($amount);
            Redsys::setOrder($order);
            Redsys::setMerchantcode($merchantcode);
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal($terminal);
            Redsys::setMethod('z');
            Redsys::setNotification(config('redsys.url_notification'));
            Redsys::setUrlOk(route('redsys.comprobar', $anuncio_id));
            Redsys::setUrlKo(config('redsys.url_ko'));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName($tradeName);
            Redsys::setTitular($titular);
            Redsys::setProductDescription($description);
            Redsys::setEnviroment($enviroment);
            $signature = Redsys::generateMerchantSignature($key);
            //sdd(Redsys::generateMerchantParameters());
            Redsys::setMerchantSignature($signature);
            if ($display == false) {
                Redsys::setAttributesSubmit('btn_submit', 'btn_id', 'Enviar', 'display:none');
                return Redsys::executeRedirection();
            } else {
                Redsys::setAttributesSubmit('btn_submit', 'btn_id', 'Pagar Con Bizum', '');
                $form = Redsys::createForm();
                return $form;
            }
        } catch (Exception $e) {
            echo 'error' . $e->getMessage();
        }
    }


    public function comprobar($anuncio_id, Request $request)
    {
        try {

            //$anuncio_id = 1;
            $anuncio = Anuncio::find($anuncio_id);
            $key = config('redsys.key');
            $parameters = Redsys::getMerchantParameters($request->input('Ds_MerchantParameters'));
            $DsResponse = $parameters["Ds_Response"];
            $DsResponse += 0;
            if (Redsys::check($key, $request->input()) && $DsResponse <= 99) {
                $DsResponse = $parameters["Ds_Response"];
                $anuncio = Anuncio::find($anuncio_id);
                $user = $anuncio->user;

                // $captures = $data['purchase_units'][0]['payments']['captures'];
                // $payPalPaymentId = $captures[0]['id'];
                // $amount = $captures[0]['amount']['value'];
                // $create_time = $captures[0]['create_time'];
                // $paypal_fee = $captures[0]['seller_receivable_breakdown']['paypal_fee']['value'];
                // $payer_email = $data['payer']['email_address'];
                // if (!is_null($create_time)) {
                //     //doy formato
                //     $create_time = \Carbon\Carbon::parse($create_time)->format('Y-m-d H:i:s');
                // } else {
                //     $create_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                // }
                ####ANDA
                $orderId = $parameters["Ds_Order"];
                $amount = $parameters["Ds_amount"];
                $method = $parameters["Ds_ProcessedPayMethod"];
                $anuncio->update(['estado_pago' => 'Si']);
                $pago = Pago::create([
                    'user_id' => $anuncio->user_id, //Auth::id(),
                    //'mail_pago' => '',
                    'anuncio_id' => $anuncio_id,
                    'moneda_precio' => 'EUR',
                    'precio' => $anuncio->precio,
                    'moneda_pago' => 'EUR',
                    'monto_pago' => $amount,
                    //'fee' => $paypal_fee,
                    'medio_pago' => 'Redsys ' . $method,
                    'nro_transac' => $orderId,
                    //'fecha_transac' => $create_time, #fecha del pago
                    'estado' => 'Aprobado',
                ]);
                $correo = new CompraconfirmMail($anuncio, $amount, 'Compra');
                Mail::to($user->email)->send($correo);
                // lo que quieras que haya si es positiva la confirmación de redsys
                $mensaje = 'Hemos registrado el pago por Redsys del anuncio '  . $anuncio->nombre . ' ' . $anuncio->dias . ' días en ' . $anuncio->zona->nombre . ' en la categoría ' . $anuncio->categoria->nombre .
                    ' del  Usuario ' . $anuncio->user->name .
                    '<br>Monto: €' . $anuncio->precio;
                Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos Redsys', 'Cobro Recibido', $mensaje, $anuncio));
            } else {
                $mensaje = 'No pudimos completar el pago de ' . $request->anuncio_id . ' del usuario = ' . $anuncio->user->nombre;
                Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos RedSys', 'No se pudo cobrar', $mensaje, $anuncio));
            }
        } catch (TpvException $e) {
            echo $e->getMessage();
        }
    }


    public function recibir_pago(Request $request)
    {
        //$concept, $userId, $planId, $option, $success, $adId, $amount, $message, $dsOrder,  $dsResponse, $authorisationCode
        //$anuncio_id, $plan_id, $precio, $opcion, $medio_pago, $transaccion_nro

        // $adId = $_GET['adId'];
        // $planId = $_GET['planId'];
        // $option = $_GET['option'];
        // $amount = $_GET['amount'];
        // $concept = $_GET['concept'];
        // $success = $_GET['success'];
        // $dsOrder = $_GET['dsOrder'];
        // $concept = $_GET['concept'];
        $success = $request->success;
        $intValSuccess = intval($success); 
        $adId = $request->adId;
        $anuncio = Anuncio::find($adId);
        $user = $anuncio->user;
        $dsOrder = $request->dsOrder;
        $transaccion_nro = $dsOrder;
        $planId = $request->planId;
        $option = $request->optionDescription;
        $amount = $request->amount;
        $concept = $request->concept;
        $dsResponse = $request->dsResponse;
        $authorisationCode = $request->authorisationCode;
        $mensaje = $request->mensaje;
        $valuesAsString = $concept . $amount . $user->id . $adId . $planId . $option . $dsOrder . $dsResponse . $authorisationCode . $intValSuccess;
        $encryptionPassphrase = config('app.tpvsecret');
        $signature = sha1($valuesAsString . $encryptionPassphrase);
        if ($success == 1) {
            if ($signature == $request->signature) {
                if (!is_null($amount)) {
                    $amount = number_format((($amount / 100)), 2, '.', ' ');
                }

                $plan = Plane::find($planId);
                $create_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $opcion = $option;
                $precio = $amount;

                $pago = Pago::create([
                    'user_id' => $user->id, //Auth::id(),
                    'mail_pago' => $user->email,
                    'anuncio_id' => $anuncio->id,
                    'moneda_precio' => 'EUR',
                    'precio' => $plan->precio,
                    'moneda_pago' => 'EUR',
                    'monto_pago' => $amount,
                    'medio_pago' => 'TPV - ' . $concept,
                    'nro_transac' => $dsOrder,
                    'fecha_transac' => $create_time, #fecha del pago
                    'estado' => 'Aprobado',
                ]);
                # si es una compra llama al metodo procesar
                if ($opcion == 'compra') {
                    $this->procesar_pago($anuncio, $user, $plan, $precio, $transaccion_nro);
                }

                # si extiende llama al metodo extender
                if ($opcion == 'extension') {

                    $this->procesar_pago_ext($anuncio, $user, $plan, $precio, $transaccion_nro);
                }
                # si es cambiar plan llamo al metodo cambiar plan
                if ($opcion == 'cambio_plan') {
                    $this->procesar_pago_cambio($anuncio, $user, $plan, $precio, $transaccion_nro);
                }

                // return redirect()->route('edit_anuncio', $anuncio);
                //return view('anuncios.confirmar_pago_tpv', compact('anuncio'));
                return response()->json([
                    'success' => true,
                    // Otros datos que quieras incluir en la respuesta
                ]);
            } else {

                $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre .  ' con oder_id = ' . $transaccion_nro . ' y concepto ' . $concept;
                $mensaje .= ' usuario ' . $anuncio->user->name . '<br>';
                $mensaje .= ' Anuncio ' . $anuncio->id .  ' ' .  $anuncio->titulo .  '<br>';
                $mensaje .= 'Nro Orden de pago: ' . $transaccion_nro . ' con codigo de aprobación: ' . $authorisationCode;
                Mail::to($anuncio->user->email)->send(new Fallapagomail($mensaje, $anuncio));
                $mensaje .= ' No coinciden las firmas. Puede ser una adulteración';
                Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'No se pudo cobrar', $mensaje, $anuncio));
                //Problema con el pago
                return response()->json([
                    'success' => true,
                    // Otros datos que quieras incluir en la respuesta
                ]);
                //return view('anuncios.problema_pago_tpv', compact('anuncio'));
            }
        } else {

            $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre .  ' con oder_id = ' . $transaccion_nro . ' y concepto ' . $concept;
            $mensaje .= ' usuario ' . $anuncio->user->name . '<br>';
            $mensaje .= ' Anuncio ' . $anuncio->id .  ' ' .  $anuncio->titulo .  '<br>';
            $mensaje .= 'Nro Orden de pago: ' . $transaccion_nro . ' con codigo de aprobación: ' . $authorisationCode;
            Mail::to($anuncio->user->email)->send(new Fallapagomail($mensaje, $anuncio));
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'No se pudo cobrar', $mensaje, $anuncio));
            //Problema con el pago
            return response()->json([
                'success' => true,
                // Otros datos que quieras incluir en la respuesta
            ]);
            // return view('anuncios.problema_pago_tpv', compact('anuncio'));
        }
    }



    public function procesar_pago(Anuncio $anuncio, User $user, Plane $plan, $precio, $transaccion_nro)
    {
        # si es una compra llama al metodo procesar
        $anuncio->update([
            'estado_pago' => 'Si',
            'plane_id' => $plan->id,
            'clase_id' => $plan->clase_id,
            'dias' => $plan->dias,
            'precio' => $plan->precio,
        ]);

        $correo = new CompraconfirmMail($anuncio, $precio, 'Compra');
        Mail::to($user->email)->send($correo);
        $mensaje = 'Hemos registrado el pago del anuncio '  . $anuncio->nombre . ' plan' . $anuncio->plane->nombre . ' del  Usuario ' . $user->name .
            '<br>Monto: €' . $precio .
            '<br>nro_transac: ' . $transaccion_nro .
            '<br>mail_pago: '  . $user->email;
        Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'Cobro Recibido', $mensaje, $anuncio));
    }

    public function procesar_pago_ext(Anuncio $anuncio, User $user, Plane $plan, $precio, $transaccion_nro)
    {
        # si extiende llama al metodo extender

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

        $anuncio->update([
            'dias' => $dias_tot,
            'fecha_caducidad' => $fecha_fin,
            'precio' => $precio_tot,
            'estado_pago' => 'Si'
        ]);
        //Enviar mail de notificación
        $correo = new CompraconfirmMail($anuncio, $precio, 'Extension');
        Mail::to($user->email)->send($correo);
        $mensaje = 'Hemos registrado el pago de la extensión de tu anuncio '  . $anuncio->nombre . ' ' . $anuncio->dias . ' días del  Usuario ' . $user->name .
            '<br>Monto: €' . $precio .
            '<br>nro_transac: ' . $transaccion_nro .
            '<br>mail_pago: '  . $user->email;
        Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'Cobro Recibido', $mensaje, $anuncio));
    }


    public function procesar_pago_cambio(Anuncio $anuncio, User $user, Plane $plan, $precio, $transaccion_nro)
    {
        # si extiende llama al metodo extender

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
        if ($hora_actual > config('app.hora_agregar_dia')) {
            $fecha_fin->addDays($plan->dias);
        } else {
            $fecha_fin->addDays($plan->dias - 1);
        }
        $anuncio->update([
            'plane_id' => $plan->id,
            'clase_id' => $plan->clase_id,
            'dias' => $dias_tot,
            'fecha_caducidad' => $fecha_fin,
            'precio' => $plan->precio,
            'fecha_de_publicacion' => Carbon::now(),
            'estado_pago' => 'Si'
        ]);
        // }else{
        //     //Algo paso y pago menos
        //     $anuncio->update([                   
        //         'precio' => $anuncio->precio + $amount,
        //     ]);
        // }

        $user = $anuncio->user;

        //Enviar mail de notificación

        $correo = new CompraconfirmMail($anuncio, $precio, 'Cambio Plan');
        Mail::to($user->email)->send($correo);
        $mensaje = 'Hemos registrado el pago de cambio de plan de tu anuncio '  . $anuncio->nombre . ' ' . $anuncio->dias . ' días del  Usuario ' . $user->name .
            '<br>Monto: €' . $precio .
            '<br>nro_transac: ' . $transaccion_nro .
            '<br>mail_pago: '  . $user->email;
        '<br>Plan: '  . $plan->nombre;
        '<br>Plan precio: '  . $plan->precio;
        '<br>Plan dias: '  . $plan->dias;
        Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'Cobro Recibido', $mensaje, $anuncio));
    }


    public function recibir_pago_test(Request $request)
    {
        //$concept, $userId, $planId, $option, $success, $adId, $amount, $message, $dsOrder,  $dsResponse, $authorisationCode
        //$anuncio_id, $plan_id, $precio, $opcion, $medio_pago, $transaccion_nro

        // $adId = $_GET['adId'];
        // $planId = $_GET['planId'];
        // $option = $_GET['option'];
        // $amount = $_GET['amount'];
        // $concept = $_GET['concept'];
        // $success = $_GET['success'];
        // $dsOrder = $_GET['dsOrder'];
        // $concept = $_GET['concept'];
        $success = $request->success;
        $adId = $request->adId;
        $anuncio = Anuncio::find($adId);
        $user = $anuncio->user;
        $dsOrder = $request->dsOrder;
        $transaccion_nro = $dsOrder;
        $planId = $request->planId;
        $option = $request->optionDescription;
        $amount = $request->amount;
        $concept = $request->concept;
        $dsResponse = $request->dsResponse;
        $authorisationCode = $request->authorisationCode;
        $mensaje = $request->mensaje;
        $valuesAsString = $concept . $amount . $user->id . $adId . $planId . $option . $dsOrder . $dsResponse . $authorisationCode . $success;
        $encryptionPassphrase = config('app.tpvsecret');
        $signature = sha1($valuesAsString . $encryptionPassphrase);
        if ($success == 'true') {
            if ($signature == $request->signature) {

                $plan = Plane::find($planId);
                $create_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $opcion = $option;
                $precio = $amount;

                $pago = Pago::create([
                    'user_id' => $user->id, //Auth::id(),
                    'mail_pago' => $user->email,
                    'anuncio_id' => $anuncio->id,
                    'moneda_precio' => 'EUR',
                    'precio' => $plan->precio,
                    'moneda_pago' => 'EUR',
                    'monto_pago' => $amount,
                    'medio_pago' => 'TPV - ' . $concept,
                    'nro_transac' => $dsOrder,
                    'fecha_transac' => $create_time, #fecha del pago
                    'estado' => 'Aprobado',
                ]);
                # si es una compra llama al metodo procesar
                // if ($opcion == 'compra') {
                //     $this->procesar_pago($anuncio, $user, $plan, $precio, $transaccion_nro);
                // }

                // # si extiende llama al metodo extender
                // if ($opcion == 'extension') {

                //     $this->procesar_pago_ext($anuncio, $user, $plan, $precio, $transaccion_nro);
                // }
                // # si es cambiar plan llamo al metodo cambiar plan
                // if ($opcion == 'cambio_plan') {
                //     $this->procesar_pago_cambio($anuncio, $user, $plan, $precio, $transaccion_nro);
                // }

                // return redirect()->route('edit_anuncio', $anuncio);
                //return view('anuncios.confirmar_pago_tpv', compact('anuncio'));
                return response()->json([
                    'success' => true,
                    // Otros datos que quieras incluir en la respuesta
                ]);
            } else {

                $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre .  ' con oder_id = ' . $transaccion_nro . ' y concepto ' . $concept;
                $mensaje .= ' usuario ' . $anuncio->user->name . '<br>';
                $mensaje .= ' Anuncio ' . $anuncio->id .  ' ' .  $anuncio->titulo .  '<br>';
                $mensaje .= 'Nro Orden de pago: ' . $transaccion_nro . ' con codigo de aprobación: ' . $authorisationCode;
                Mail::to($anuncio->user->email)->send(new Fallapagomail($mensaje, $anuncio));
                $mensaje .= ' No coinciden las firmas. Puede ser una adulteración';
                Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'No se pudo cobrar', $mensaje, $anuncio));
                //Problema con el pago
                return response()->json([
                    'success' => true,
                    // Otros datos que quieras incluir en la respuesta
                ]);
                //return view('anuncios.problema_pago_tpv', compact('anuncio'));
            }
        } else {

            $mensaje = 'No pudimos completar el pago de ' . $anuncio->nombre .  ' con oder_id = ' . $transaccion_nro . ' y concepto ' . $concept;
            $mensaje .= ' usuario ' . $anuncio->user->name . '<br>';
            $mensaje .= ' Anuncio ' . $anuncio->id .  ' ' .  $anuncio->titulo .  '<br>';
            $mensaje .= 'Nro Orden de pago: ' . $transaccion_nro . ' con codigo de aprobación: ' . $authorisationCode;
            Mail::to($anuncio->user->email)->send(new Fallapagomail($mensaje, $anuncio));
            Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Pagos TPV', 'No se pudo cobrar', $mensaje, $anuncio));
            //Problema con el pago
            return response()->json([
                'success' => true,
                // Otros datos que quieras incluir en la respuesta
            ]);
            // return view('anuncios.problema_pago_tpv', compact('anuncio'));
        }
    }




}
