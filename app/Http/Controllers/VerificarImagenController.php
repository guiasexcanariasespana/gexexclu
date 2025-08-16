<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificarImagenController extends Controller
{
    //
     public function upload_imagen_verificar(){
        //muestra boton para subir imagen
        return view('verificar_imagen.upload_imagen_verificar');
    }
}
