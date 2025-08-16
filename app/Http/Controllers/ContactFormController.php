<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\Anuncio;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function form()
    {
        $data['nombre'] = '';
        $data['telefono'] = '';
        $data['email'] = '';
        $data['motivo'] = '';
        $data['mensaje'] = '';
        if (!is_null(session('categoriaSel'))) {
            $categoria = Categoria::find(session('categoriaSel'));
        } else {
            $categoria = Categoria::where('nombre', 'Chicas')->first();
            session()->put('categoriaSel', $categoria->id);
        }

        $categoria_id = $categoria->id;
        if (Cache::has('cantidad' . $categoria_id)) {
            $cantidad = Cache::get('cantidad' . $categoria_id);
        } else {
            $cantidad = Anuncio::cantidad_anuncios($categoria_id);
            Cache::put('cantidad' . $categoria_id, $cantidad, 1200);
        }

        return view('contact', compact('cantidad', 'data'));
    }

    public function send(Request $request)
    {
        
        $data = $request->validate([
            'nombre' => 'required',            
            'email' => 'required',
            'motivo' => 'required',
            'mensaje' => 'required',
            'telefono' => '',
            'terms' => ['accepted', 'required'],
            'g-recaptcha-response' => 'required|captcha',
        ]);
      #  dd($data);
        Mail::to(config('app.mail_admin'))->send(new ContactForm($data));

        return back()->with('data', $data)->with('message', ['success', 'Message sent succesfully']);
    }
}
