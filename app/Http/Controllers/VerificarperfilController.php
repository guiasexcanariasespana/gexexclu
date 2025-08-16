<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Http\Request;

class VerificarperfilController extends Controller
{


    public function verificar_perfil(Request $request, User $user)
    {
        $file = $request->file('image');
        $fileName = uniqid() . $file->getClientOriginalName();
        $path = public_path() . '/images/perfil/' . $user->id . '/';
        // Public Folder
        $request->image->move($path, $fileName);
    
        $user->update(['imagen_verificacion'=> $fileName]);  

        return redirect()->route('dashboard')
            ->with('success','imagen subida');
       
    }

    public function subir_foto_valida( User $user , Request $request)
    {
        //dd($request);
       
        return view('perfil.subir_foto_valida', compact('user'));

       


    }

    public function quitar_foto_verificacion(Anuncio $anuncio){
        $user = $anuncio->user;
        $path = public_path() . '/images/perfil/' . $anuncio->id . '/';
       
        //para la del anuncio
        $mi_imagen = $path . $anuncio->imagen_verificacion;
        if (@getimagesize($mi_imagen)) {
            unlink($mi_imagen);
        }
        $anuncio->update(['imagen_verificacion' => null]);
       
        return redirect()->route('dashboard', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }




}

