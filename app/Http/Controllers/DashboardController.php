<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use App\Models\Anuncio;
use App\Models\Zone;
use App\Models\Clase;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Anuncio $anuncio = null)
    {
       
        $user = auth()->user();
        if (auth()->user()->hasRole('Admin')){
            //dd('hola');
           return redirect(route('admin.home'));
        }
        if ($user->estado_wsp == 'Pendiente'){
           
            return view('estado_wsp_pendiente', compact('user'));
     
        }
        if(is_null($anuncio)){
            $anuncio = $user->anuncios->whereIn('estado', ['Borrador', 'Publicado', 'Pausado'])
                ->where('estado_pago', 'Si')->SortBy('created_at desc')->last();
        }
       
        $tags_al = Tag::where('rubro', 'AL')->orderBy('nombre')->get();
        $tags_etc =  Tag::where('rubro', 'ETC')->orderBy('nombre')->get();
        $tags_ec =  Tag::where('rubro', 'EC')->orderBy('nombre')->get();
        $tags_in =  Tag::where('rubro', 'In')->orderBy('nombre')->get();    

       


        $categoria = Categoria::where('nombre', 'Chicas')->first();
        $categoria_id = $categoria->id;
        

        $clase = null;
        $anuncios_oro = [];
        $anuncios_plata = [];
        $anuncios_bronce = [];
        $anuncios_normal = [];
        $anuncios_diamante = [];
        if (Cache::has('cantidad' . $categoria_id)) {
            $cantidad = Cache::get('cantidad' . $categoria_id);
        } else {
            $cantidad = Anuncio::cantidad_anuncios($categoria_id);
            Cache::put('cantidad' . $categoria_id, $cantidad, 1200);
        }



       
        return view('dashboard', compact('user','cantidad', 'anuncio', 'tags_al','tags_etc','tags_ec','tags_in', 'anuncios_oro', 'anuncios_plata' ,'anuncios_bronce' ,'anuncios_normal','anuncios_diamante'));

        
    }

    public function enviar_codigo_validacion()
    {
        $user = auth()->user();
        $codigo= mt_rand(0,999999);
        $codigo_ws=  str_pad($codigo, 6, "0", STR_PAD_LEFT);
        $user->update(['codigo_ws'=> $codigo_ws]);
        $paso= 2;
        $user->update(['paso'=> $paso]);
        $sms = new MensajeController;
        $sms_mensaje = 'Hola ' . $user->name . '. Tu codigo de validacion en CANARIAS EXCLUSIVA es: ' . $codigo_ws . '. Ingresalo en el sitio para validar tu telefono.';
        $link = route('index_general');
        $sms->enviar($user->id, $user->telefono, $sms_mensaje, $link);
        return view('envio_codigo_ws', compact('user', 'paso'));
    }

    public function verificar_codigows(Request $request)
    {
        
       
        $user = auth()->user();
       
        
        if ($request->codigows==$user->codigo_ws){
          
            $user->update(['estado_wsp'=> 'Validado', 'codigo_ws'=> null]);
            return redirect()->route('comprar_anuncio')->with('create-confirm', trans('messages.ws_error'));
        
            }    
            else
            { 
                $user->update(['codigo_ws'=> null]);
                return redirect()->route('dashboard')
            ->with('error', trans('messages.ws_error'));
            };
        
        
        
    }


      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function no_valido_ws()
    {

        return view('estado_wsp_pendiente');
    }



    public function edit_anuncio(Anuncio $anuncio){
        $user = auth()->user();
        if( $user->id != $anuncio->user_id){
            return redirect()->route('dashboard')
            ->with('error', 'No autorizado');
        }
        $tags_al = Tag::where('rubro', 'AL')->orderBy('nombre')->get();
        $tags_etc =  Tag::where('rubro', 'ETC')->orderBy('nombre')->get();
        $tags_ec =  Tag::where('rubro', 'EC')->orderBy('nombre')->get();
        $tags_in =  Tag::where('rubro', 'In')->orderBy('nombre')->get();

        $anuncios_usuario = $user->anuncios;


        $categoria = Categoria::where('nombre', 'Chicas')->first();
        $categoria_id = $categoria->id;


        $clase = null;
        $anuncios_oro = [];
        $anuncios_plata = [];
        $anuncios_bronce = [];
        $anuncios_normal = [];
        $anuncios_diamante = [];
        if (Cache::has('cantidad' . $categoria_id)) {
            $cantidad = Cache::get('cantidad' . $categoria_id);
        } else {
            $cantidad = Anuncio::cantidad_anuncios($categoria_id);
            Cache::put('cantidad' . $categoria_id, $cantidad, 1200);
        }




        return view('dashboard', compact('user', 'anuncios_usuario', 'cantidad', 'anuncio', 'tags_al', 'tags_etc', 'tags_ec', 'tags_in', 'anuncios_oro', 'anuncios_plata', 'anuncios_bronce', 'anuncios_normal', 'anuncios_diamante'));

    }

    
}
