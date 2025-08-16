<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Imagen;
use App\Models\Anuncio;

class ImagensController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:admin.gestion.imagenes');
    }

    public function aceptar_imagen(Imagen $imagen){

        $imagen->update(['estado'=>'Verificada']);
        return redirect()->route('admin.users.edit_anuncio', $imagen->anuncio)
        ->with('success', trans('messages.edit-confirm')); 
    }

    public function rechazar_imagen(Imagen $imagen)
    {

        $anuncio = $imagen->anuncio;
        
        $path = public_path() . '/images/anuncio/' . $anuncio->id . '/';
        $pathoriginal = public_path() . '/images/anuncio/' . $anuncio->id . '/original' . '/';
        //para la del anuncio
        $mi_imagen = $path . $imagen->nombre ;
        if (@getimagesize($mi_imagen)) {
            unlink($mi_imagen);
         }
        $mi_imagen_original = $pathoriginal . $imagen->nombre;
        if (@getimagesize($mi_imagen_original)) {
            unlink($mi_imagen_original);
        } // } else {
            //     /ech( "El archivo no existe");
            // }
        if($imagen->id == $anuncio->portada_id){
            //es la de portada
            $anuncio->update(['portada_id'=>null]);
        }    
        $imagen->delete();
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }


}
