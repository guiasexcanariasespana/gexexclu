<?php

namespace App\Http\Controllers;

use App\Mail\AvisoAdminMail;
use App\Mail\ErrorSmsMail;
use App\Models\Smsnotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;


class MensajeController extends Controller
{

    public function test()
    {
        $to = '54610829595';
        //$to = '54610829595';
        $mensaje = 'Hola tu codigo es 139031. Saludos';
        $user_id = 1;
        $this->enviar($user_id, $to, $mensaje, '');
    }

    public function enviar($user_id, $to, $mensaje, $link)
    {
       if (!is_null($to)){
        $request = $this->get_request('34'.$to, $mensaje, $link);
        $headers = $this->get_headers();
        $response = $this->send($headers, $request);
        $response = json_decode($response);

        $estado = $response->status;
        
        if ($estado == 'ok') {
            $resultado = $response->result;
            if($resultado[0]->status == 'error'){
                    //dd($resultado[0]);
                    //$estado = $response->$resultado[0];
                    $error_id = $resultado[0]->error_id;
                    $error_msg = $resultado[0]->error_msg;
                    Smsnotification::create([
                        'user_id' => $user_id,
                        'telefono' => $to,
                        'mensaje' => $mensaje,
                        'respuesta' => $estado,
                        'error_id' => $error_id,
                        'error_msg' => $error_msg,
                    ]);

                    $mensaje = 'No pudimos enviar la notificacion por sms a ' . $to .
                        '<br> con el texto ' . $mensaje . ' <br>El error dice ' . $error_id . ' ' . $error_msg;                    
                        Mail::to(config('app.mail_admin'))->send(new ErrorSmsMail('SMS', 'No se pudo enviar', $mensaje, $user_id));
            }else {
                    $sms_id = $resultado[0]->sms_id;
                    //Anoto la notificación
                    Smsnotification::create([
                        'user_id' => $user_id,
                        'telefono' => $to,
                        'mensaje' => $mensaje,
                        'respuesta' => $estado,
                        'sms_id' => $sms_id
                    ]);
                }
            
   
        } else {
            //Algo falló, guardo error notificacion
            $estado = $response->status;
            $error_id = $response->error_id;
            $error_msg = $response->error_msg;
            Smsnotification::create([
                'user_id' => $user_id,
                'telefono' => $to,
                'mensaje' => $mensaje,
                'respuesta' => $estado,
                'error_id' => $error_id,
                'error_msg' => $error_msg,
            ]);
            
            $mensaje = 'No pudimos enviar la notificacion por sms a ' . $to . 
                '<br> con el texto ' . $mensaje . ' <br>El error dice ' . $error_id. ' ' . $error_msg;
            Mail::to(config('app.mail_admin'))->send(new ErrorSmsMail('SMS', 'No se pudo enviar',$mensaje, $user_id));
        }
        }else{
            //no hay $to
            Smsnotification::create([
                'user_id' => $user_id,
                'telefono' => $to,
                'mensaje' => $mensaje,
                'respuesta' => 'Error',
                'error_id' => '0',
                'error_msg' => 'No hay telefono definido para envio',
            ]);
            $mensaje = 'No pudimos enviar la notificacion por sms a ' . $to .
            '<br> con el texto ' . $mensaje . ' <br> Motivo no tiene numero de telefono o no fue indicado';
            Mail::to(config('app.mail_admin'))->send(new ErrorSmsMail('SMS', 'No se pudo enviar',$mensaje, $user_id));
        }
      }


    private function get_request($to, $mensaje, $link)
    {
        $request = '{
                    "api_key":"' . config('app.sms_api_key') . '",
                    "report_url":"http://yourserver.com/callback/script",                      
                    "concat":1,
                    "messages":[
                        {
                            "from":"34610829595",
                            "to":"' . $to . '",
                            "text":"' . $mensaje . '",
                            "send_at":"' . Carbon::now()->toDateTimeString() . '"
                        }
                        
                    ]
                }';
        return $request;
    }

    private function get_headers()
    {
        $headers = array('Content-Type: application/json');
        return $headers;
    }

    private function send($headers, $request)
    {
        $ch = curl_init('https://api.gateway360.com/api/3.0/sms/send');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

        $result = curl_exec($ch);

        if (curl_errno($ch) != 0) {
            die("curl error: " . curl_errno($ch));
        }
        return $result;
    }





    //     public function enviar()
    //     {

    //         $request = '{
    //     "api_key":"cdaed4d178c14604a8d042f743aedded",
    //     "report_url":"http://yourserver.com/callback/script",
    //     "concat":1,
    //     "messages":[
    //         {
    //             "from":"5493424490451",
    //             "to":"5493424490451",
    //             "text":"Hi John, today 2x1 in pizzas, watch the game like a boss with our new pepperoni pizza!",
    //             "send_at":"' . Carbon::now()->toDateTimeString() . '"
    //         }

    //     ]
    // }';

    //         $headers = array('Content-Type: application/json');

    //         $ch = curl_init('https://api.gateway360.com/api/3.0/sms/send');
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

    //         $result = curl_exec($ch);

    //         if (curl_errno($ch) != 0) {
    //             die("curl error: " . curl_errno($ch));
    //         }

    //         dd($result);
    //         // "{"status":"ok","result":[{"status":"ok","sms_id":"78c4de731aa94c43a79b370560bbff82","custom":""}]}"
    //     }
}
