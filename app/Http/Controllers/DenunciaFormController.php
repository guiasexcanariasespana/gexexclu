<?php

namespace App\Http\Controllers;

use App\Mail\DenunciaForm;
use App\Models\Anuncio;
use App\Models\Categoria;
use App\Models\Denuncia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class DenunciaFormController extends Controller
{
    public function form(Anuncio $anuncio)
    {
        if (!is_null(session('categoriaSel'))) {
            $categoria = Categoria::find(session('categoriaSel'));
        } else {
            $categoria = Categoria::where('nombre', 'Chicas')->first();
            session()->put('categoriaSel', $categoria->id);
        }
        $categoria_id = (isset($categoria->id)) ? $categoria->id : "";
        if (Cache::has('cantidad' . $categoria_id)) {
            $cantidad = Cache::get('cantidad' . $categoria_id);
        } else {
            $cantidad = Anuncio::cantidad_anuncios($categoria_id);
            Cache::put('cantidad' . $categoria_id, $cantidad, 1200);
        }

        return view('denuncia', compact('cantidad', 'anuncio'));
    }

    public function send(Request $request, Anuncio $anuncio)
    {

        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'motivo' => 'required',
            'mensaje' => 'required',
            'telefono' => 'required',
            'terms' => ['accepted', 'required'],
            'g-recaptcha-response' => 'required|captcha',
        ]);
    
        #  dd($data);
        try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to(config('app.mail_admin'))->send(new DenunciaForm($anuncio, $data));
            } else {
                \Log::warning('El usuario no tiene email configurado para enviar notificación', [
                    'anuncio_id' => $anuncio->id,
                    'user_id' => $anuncio->user->id
                ]);
            }
        } catch (\Swift_TransportException $e) {
                 // Error específico de transporte (problemas SMTP, conexión)
            \Log::error('Error de transporte al enviar email: ' . $e->getMessage());
            } catch (\Exception $e) {
                // Cualquier otro error
                \Log::error('Error inesperado al enviar email: ' . $e->getMessage());
        }
        return back()->with('data', $data)->with('message', ['success', 'Message sent succesfully']);
    }

   public function store(Request $request, Anuncio $anuncio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'motivo_denuncia' => 'required|string|max:200',
            'mensaje' => 'required|string',
            'terms' => 'accepted',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        // Crear la denuncia
        $denuncia = Denuncia::create([
            'user_id' => auth()->id(), // Si está autenticado
            'nombre' => $validated['nombre'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'motivo_denuncia' => $validated['motivo_denuncia'],
            'mensaje' => $validated['mensaje'],
            'anuncio_id' => $anuncio->id
        ]);

        return redirect()->back()
            ->with('success', 'Denuncia enviada correctamente. La revisaremos a la brevedad.');
    }

}
