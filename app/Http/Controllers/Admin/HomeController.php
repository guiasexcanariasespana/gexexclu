<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:admin.dashboard');
    }
    
    public function index(){
        $anuncios_vencen = Anuncio::vence_en_15();
        $anuncios_a_verificar = Anuncio::a_verificar();
        $usuarios_a_verificar = User::where('verificado', 'No')->get();
        return view('admin.home.index', compact('anuncios_a_verificar', 'anuncios_vencen', 'usuarios_a_verificar'));
        
    }

    public function home(){
        
        $anuncios_a_verificar = Anuncio::where('verificacion', '=', 'Pendiente')
        ->where('estado', 'A_Publicar')
        ->paginate(10, ['*'], 'anuncios_a_verificar_page');

        $hoy = Carbon::now()->toDateString(); // Fecha de hoy en formato Y-m-d
        $en24horas = Carbon::now()->addDays(1)->toDateString();
        $en48horas = Carbon::now()->addDays(2)->toDateString();
        $en72horas = Carbon::now()->addDays(3)->toDateString();

        $usuarios_a_verificar = User::where('verificado', 'No')
        ->paginate(10, ['*'], 'usuarios_a_verificar_page');

        $anuncios_vencen = Anuncio::where('estado', '=', 'Publicado')
        ->whereIn('fecha_caducidad', [$hoy, $en24horas, $en48horas, $en72horas])
        ->orderBy('fecha_caducidad', 'asc')
        ->paginate(10, ['*'], 'anuncios_vencen_page');


        $hoycount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $hoy)
            ->count();

        $en24horascount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $en24horas)
            ->count();

        $en48horascount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $en48horas)
            ->count();

        $en72horascount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $en72horas)
            ->count();


    
        return view('admin.new.home', 
        compact(
            'anuncios_a_verificar', 
            'anuncios_vencen', 
            'hoycount', 
            'en24horascount', 
            'en48horascount', 
            'en72horascount', 
            'usuarios_a_verificar'));
        
    }

    public function accesos(){

        $users = User::role('admin')->get();

        return view('admin.new.accesos', compact('users'));

    }

    public function usuarios(){

        $users = User::role('Usuario')
        ->orderBy('created_at', 'desc') // Primero ordenamos
        ->get(); // Luego paginamos


        return view('admin.new.usuarios', compact('users'));

    }

    public function anuncios(){

        $hoy = Carbon::now()->toDateString(); // Fecha de hoy en formato Y-m-d
        $en24horas = Carbon::now()->addDays(1)->toDateString();
        $en48horas = Carbon::now()->addDays(2)->toDateString();
        $en72horas = Carbon::now()->addDays(3)->toDateString();

        $anuncios = Anuncio::orderBy('fecha_caducidad', 'desc') // Primero ordenamos
        ->get(); // Luego paginamos 

        $hoycount = Anuncio::where('estado', '=', 'Publicado')
        ->where('fecha_caducidad', $hoy)
        ->count();

        $en24horascount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $en24horas)
            ->count();

        $en48horascount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $en48horas)
            ->count();

        $en72horascount = Anuncio::where('estado', '=', 'Publicado')
            ->where('fecha_caducidad', $en72horas)
            ->count();

        return view('admin.new.anuncios', 
        compact(
            'anuncios', 
            'hoycount', 
            'en24horascount', 
            'en48horascount', 
            'en72horascount', 
        ));

    }

    public function destroy(Request $request)
    {
        $userId = $request->user_id;  // Obtén el ID desde el parámetro GET
        
        try {
            // 1. Intentar encontrar el usuario
            $user = User::findOrFail($userId);
        
            // 2. Eliminar relaciones antes de borrar el usuario
            try {
                $user->anuncios()->delete();
            } catch (\Throwable $e) {
                return back()->with('error', 'Error al eliminar los anuncios del usuario: ' . $e->getMessage());
            }

            try {
                $user->pagos()->delete();
            } catch (\Throwable $e) {
                return back()->with('error', 'Error al eliminar los pagos del usuario: ' . $e->getMessage());
            }
        
            // 3. Anonimizar el email antes de eliminarlo
            try {
                $user->update(['email' => $user->email . '.borrado' . $user->id]);
            } catch (\Throwable $e) {
                return back()->with('error', 'Error al actualizar el email del usuario: ' . $e->getMessage());
            }
        
            // 4. Eliminar usuario
            try {
                $user->delete();
            } catch (\Throwable $e) {
                return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
            }
        
            // 5. Redirigir con mensaje de éxito
            return redirect()->route('admin.accesos')
                ->with('success', trans('messages.delete-confirm'));
        
        } catch (\Throwable $e) {
            // Si algún error ocurre en el proceso, regresar con un mensaje genérico
            return back()->with('error', 'Error al procesar la eliminación: ' . $e->getMessage());
        }
    }

    
}
