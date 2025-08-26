<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAnuncioRequest;
use App\Mail\AnuncioFueMailable;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Clase;
use App\Models\Imagen;
use App\Models\Plane;
use App\Models\User;
use App\Models\State;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AnuncioCreateAdminRequest;
use App\Mail\AvisoAdminMail;
use App\Mail\ReactivoAdminMail;
use App\Mail\VerificacionPerfilMail;
use App\Models\Pago;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Services\AnuncioNotaService;

/**
 * Class AnuncioController
 * @package App\Http\Controllers
 */
class AnuncioController extends Controller
{

    protected $anuncioNotaService;

    public function __construct(AnuncioNotaService $anuncioNotaService)
    {
        $this->anuncioNotaService = $anuncioNotaService;
        $this->middleware('can:admin.anuncios');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anuncios = Anuncio::paginate();

        return view('admin.anuncio.index', compact('anuncios'))
            ->with('i', (request()->input('page', 1) - 1) * $anuncios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clases = Clase::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $states = State::orderBy('name', 'asc')->pluck('name', 'id');
        $zones = Zone::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $planes = Plane::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $anuncio = new Anuncio();
        return view('admin.anuncio.create', compact('anuncio', 'categorias', 'clases', 'states', 'zones', 'planes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnuncioCreateAdminRequest $request)
    {
        // request()->validate(Anuncio::$rules);

        $anuncio = Anuncio::create($request->all());

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncio $anuncio)
    {
        // $anuncio = Anuncio::find($id);
        $notas = $anuncio->notas;
        $pagos = $anuncio->pagos;
        $tags_al = $anuncio->tags->where('rubro', 'AL');
        $tags_etc = $anuncio->tags->where('rubro', 'ETC');
        $tags_ec = $anuncio->tags->where('rubro', 'EC');
        $tags_in = $anuncio->tags->where('rubro', 'In');
        return view('admin.anuncio.show', compact('pagos', 'tags_in', 'tags_etc', 'tags_ec', 'tags_al', 'anuncio', 'notas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuncio $anuncio)
    {
        //$anuncio = Anuncio::find($id);

        return view('admin.anuncio.edit', compact('anuncio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Anuncio $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnuncioRequest $request, Anuncio $anuncio)
    {
        //request()->validate(Anuncio::$rules);
        if (!str_contains($request->slug, $anuncio->id)) {
            $request->slug =  $anuncio->id . '-' . $request->slug;
        }
        dd($request->all());
        $anuncio->update($request->all());

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio deleted successfully');
    }

    public function create_images(Anuncio $anuncio)
    {
        $imagenes_drop_zone = [];
        $imagenes = $anuncio->imagenes_ordenadas->toArray();
        array_walk($imagenes, function ($imagen) use (&$imagenes_drop_zone, $anuncio) {
            $imagenes_drop_zone[] = array(
                'id'   => $imagen['id'],
                'name' => $imagen['nombre'],
                'url'  => '/images/anuncio/' . $anuncio->id . '/' . $imagen['nombre'],
                'position' => $imagen['position']
            );
        });


        return view('admin.anuncio.create_images', compact('anuncio', 'imagenes_drop_zone'));
    }

    public function store_images(Request $request, Anuncio $anuncio)
    {
        $files = $request->file('images');
        $pendiente = $anuncio->imagenes_pendientes();
        $path = public_path() . '/images/anuncio/' . $anuncio->id . '/';
        $pathoriginal = public_path() . '/images/anuncio/' . $anuncio->id . '/original' . '/';
    
        $portada = $request->portada;
        if ($pendiente > 0 && !is_null($files)) {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if (!file_exists($pathoriginal)) {
                mkdir($pathoriginal, 0777, true);
            }
            foreach ($files as $k => $file) {
                $nombreOriginal = uniqid() . $file->getClientOriginalName();
                $nombreWebp = uniqid() . '.webp'; // Convertir a WebP
    
                $img = Image::make($file);
                $img->resize(null, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                });
    
                // Guardar la imagen original
                $img->save($pathoriginal . $nombreOriginal);
    
                // Aplicar marca de agua
                $watermark = Image::make(public_path() . '/images/logo300.png');
                $img->insert($watermark, 'center');
    
                // Guardar en WebP con calidad 80%
                $img->save($path . $nombreWebp, 80, 'webp');
    
                $aImage = new Imagen();
                $aImage->anuncio_id = $anuncio->id;
                $aImage->user_id = $anuncio->user->id;
                $aImage->nombre = $nombreWebp; // Guardamos la versión WebP
                $aImage->estado = 'Verificada';
                $aImage->position = $k;
                $aImage->portada = ($k == $portada) ? 'Si' : 'No';
                $aImage->save();
    
                if ($k == $portada) {
                    $anuncio->update(['portada_id' => $aImage->id]);
                }
            } // Fin foreach
        } // Fin if de pendientes
    
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }
    

    public function fileDestroy(Request $request, Anuncio $anuncio)
    {
        //$anuncio = Anuncio::find($id);
        $filename =  $request->get('filename');
        Imagen::where('nombre', $filename)->delete();
        $path = public_path() . '/images/anuncio/' . $anuncio->id . '/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }


    public function gestion_imagenes(Anuncio $anuncio)
    {

        return view('admin.anuncio.gestion_imagenes', compact('anuncio'));
    }


    public function aprobar_anuncio(Anuncio $anuncio)
    {        
        if(is_null($anuncio->fecha_de_publicacion)){
            $fecha_publi = Carbon::now();      
        }else{
            $fecha_publi = Carbon::parse($anuncio->fecha_de_publicacion);
        }  
        $fecha_fin = Carbon::now();
        $hora_actual = $fecha_publi->format('H');
        if ($hora_actual > config('app.hora_agregar_dia')) {
            $fecha_fin->addDays($anuncio->dias);
        } else {
            $fecha_fin->addDays($anuncio->dias - 1);
        }
        $anuncio->update([
            'estado' => 'Publicado',
            'verificacion' => 'Si',
            'fecha_de_publicacion' => $fecha_publi,
            'fecha_caducidad' => $fecha_fin
        ]);
        try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Aprobado'));
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
        // Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Aprobado'));
        return redirect()->route('admin.anuncios.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    public function rechazar_anuncio(Anuncio $anuncio)
    {

         $anuncio->update(['estado' => 'Rechazado']);
        $correo = new AnuncioFueMailable($anuncio, 'Rechazado');
        try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to($anuncio->user->email)->send($correo);
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
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    
    }

    public function pausar_anuncio(Anuncio $anuncio)
    {
        // dd(Carbon::now()->format('m-d-Y H:i:s'));
         $fecha_pausa = Carbon::now()->format('d-m-Y H:i:s');
        $anuncio->update([
            'estado' => 'Pausado',
            'fecha_pausa' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $titulo = 'Inicio Pausa';
        $texto = 'El anuncio ' . $anuncio->slug . ' se pausó el ' . $fecha_pausa . '. Aún le restan ' .
        $anuncio->dias_restantes() . ' día/s';
        $this->anuncioNotaService->store_nota_anuncio($anuncio->id, $titulo, $texto);
       
        try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Pausado'));
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
        
         try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                $mensaje = 'Se ha pausado el anuncio ' . $anuncio->slug . 'del Usuario ' . $anuncio->user->name . '. El mismo
                está publicado en la catergoría ' . $anuncio->categoria->nombre .
                ' en la localidad ' . $anuncio->localidad . ' de la provincia ' . $anuncio->provincia->nombre . ' y le restan '
                . $anuncio->dias_restantes() . ' de los ' . $anuncio->plane->dias . ' contratados. El día de en que se pausó se
                considera como utilizado';
                Mail::to(config('app.mail_admin'))->send(new AvisoAdminMail('Anuncio', 'Pausado', $mensaje, $anuncio));
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
        
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }


    public function reactivar_anuncio(Anuncio $anuncio)
    {
        
        $fecha_pausa = $anuncio->fecha_pausa;
        $fecha_pausa = Carbon::parse($fecha_pausa);
        $fecha_pausa = $fecha_pausa->format('d-m-Y H:i:s');
        // $dias_totales = ($anuncio->dias - $dias_pausa);
        $dias_restantes = $anuncio->dias_restantes();
        ###Se reinicia la fecha
        # $fecha_publi = Carbon::parse($anuncio->fecha_de_publicacion);
        $fecha_publi = Carbon::now();
        
        ###Se reinicia la fecha
        # $fecha_publi = Carbon::parse($anuncio->fecha_de_publicacion);       
        $fecha_fin = Carbon::now();
        
        ####El precio debe ser coherente con los dias        
        $fecha_fin = $fecha_fin->addDays($dias_restantes -1);
        //dd($fecha_publi);
        $anuncio->update([
            'estado' => 'Publicado',
            'fecha_pausa' => null,
            'dias' => $dias_restantes,        
            'fecha_caducidad' => $fecha_fin,
            'fecha_de_publicacion' => $fecha_publi
        ]);
        $titulo = 'Reactivado - Fin Pausa';
        $fechaPublicacion = Carbon::parse($fecha_publi);
        $fechaPublicacion = $fechaPublicacion->format('d-m-Y');
        $texto = 'El anuncio ' . $anuncio->slug . ' se reactivo el ' . $fechaPublicacion . '. Aún le restan ' .
        $anuncio->dias_restantes() . ' día/s. El día de en que se pausó se considera como utilizado';
        $this->anuncioNotaService->store_nota_anuncio($anuncio->id, $titulo, $texto);
        try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Reactivado'));
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
        // Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Reactivado'));
        try {
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to($anuncio->user->email)->send(new ReactivoAdminMail($anuncio, $fecha_pausa));
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
        // Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Reactivado'));
        // Mail::to(config('app.mail_admin'))->send(new ReactivoAdminMail($anuncio, $fecha_pausa));
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function finalizar_anuncio(Anuncio $anuncio)
    {
        #Le pido al anuncio la cantidad de días que le queda ya que estaba pausado
        $anuncio->update([
            'estado' => 'Finalizado',
            'estado_pago' => 'No',
            'fecha_pausa' => null,
        ]);
        try{
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Finalizado'));
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
        // Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Finalizado'));
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function imagenes(Anuncio $anuncio)
    {

        return view('admin.anuncio.imagenes', compact('anuncio'));
    }

    public function definir_portada(Anuncio $anuncio)
    {
        return view('admin.anuncio.definir_portada', compact('anuncio'));
    }


    public function guardar_portada(Request $request, Anuncio $anuncio)
    {

        $anuncio->update($request->all());

        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Portada definida');
    }



    public function ordernar_imagenes(Anuncio $anuncio)
    {

        return view('admin.anuncio.imagenes_ordenar', compact('anuncio'));
    }


    public function guardar_orden(Request $request, Anuncio $anuncio)
    {

        foreach ($request->imagen as $k => $img) {

            $id = $img['id'];
            $mi_img = Imagen::find($id);
            if ($mi_img->estado == 'Pendiente') {
                $mi_img->update(['position' => $img['posicion'], 'estado' => 'Verificada']);
            } else {
                $mi_img->update(['position' => $img['posicion']]);
            }
        }
        if ($request->portada_id) {
            $anuncio->update(['portada_id' => $request->portada_id]);
        }


        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Las imagenes se actualizaron correctamente');
    }


    public function cargar_video(Anuncio $anuncio)
    {

        return view('admin.anuncio.subir_video', compact('anuncio'));
    }

    public function guardar_video(Request $request, Anuncio $anuncio)
    {

        $file = $request->file('image');
        $fileName = uniqid() . $file->getClientOriginalName();
        $path = public_path() . '/videos/anuncios/' . $anuncio->id . '/';
        // Public Folder
        $request->image->move($path, $fileName);

        $anuncio->update(['video' => $fileName]);

        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Anuncio updated successfully');
    }

    public function registrar_pago(Anuncio $anuncio)
    {
        $fecha_t = Carbon::now()->format('Y-m-d');
        $user=User::find($anuncio->user_id);
        $pago = new Pago([
            'user_id' => $anuncio->user_id,
            'anuncio_id' => $anuncio->id,
            'mail_pago' => $anuncio->user->email,
            'moneda_precio' => 'EUR',
            'moneda_pago' => 'EUR',
            'precio' => $anuncio->precio,
            'monto_pago' => $anuncio->precio,
            'fecha_transac' => $fecha_t,
        ]);

        return view('admin.anuncio.registrar_pago', compact('anuncio', 'pago', 'user'));
    }

    public function store_pago(Request $request, Anuncio $anuncio)
    {
        request()->validate(Pago::$rules);

        $pago = Pago::create($request->all());

        if ($pago->estado == 'Aprobado') {
            $anuncio->update(['estado_pago' => 'Si']);
        }
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Pago created successfully.');
    }

    public function aceptar_video(Anuncio $anuncio)
    {

        $anuncio->update(['estado_video' => 'Verificado']);
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function rechazar_video(Anuncio $anuncio)
    {
        $path = public_path() . '/videos/anuncios/' . $anuncio->id . '/';
        $mi_video = $path . $anuncio->video;
        if (@getimagesize($mi_video)) {
            unlink($mi_video);
        }
        $anuncio->update(['estado_video' => 'Pendiente', 'video' => null]);
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function suspender_anuncio(Anuncio $anuncio)
    {

        $anuncio->update(['estado' => 'Suspendido']);
        try{
            // Verificar que el usuario tenga email antes de intentar enviar
            if (!empty($anuncio->user->email)) {
                // Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Finalizado'));
                Mail::to($anuncio->user->email)->send(new AnuncioFueMailable($anuncio, 'Suspendido'));
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


        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function verificar_user(Anuncio $anuncio)
    {
        $user = $anuncio->user;
        $user->update(['verificado' => 'Si']);
        Mail::to($user->email)->send(new VerificacionPerfilMail($user));
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'User updated successfully');
    }

    public function rechazar_user(Anuncio $anuncio)
    {
        $user = $anuncio->user;
        $user->update(['verificado' => 'Rechazado']);
        Mail::to($user->email)->send(new VerificacionPerfilMail($user));
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'User updated successfully');
    }


    public function a_borrador(Anuncio $anuncio)
    {
        $anuncio->update(['estado' => 'Borrador']);
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }


    public function a_a_publicar(Anuncio $anuncio)
    {
        $anuncio->update(['estado' => 'A_Publicar']);
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }


    public function subir_verificar_perfil(Request $request, Anuncio $anuncio)
    {
        $file = $request->file('uploadPerfil');
        $fileName = uniqid() . $file->getClientOriginalName();
        $path = public_path() . '/images/perfil/' . $anuncio->id . '/';
        // Public Folder
        $file->move($path, $fileName);

        $anuncio->update(['imagen_verificacion' => $fileName]);

        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Anuncio updated successfully');
    }

    public function quitar_foto_verificacion(Anuncio $anuncio)
    {

        $path = public_path() . '/images/perfil/' . $anuncio->id . '/';

        //para la del anuncio
        $mi_imagen = $path . $anuncio->imagen_verificacion;
        if (@getimagesize($mi_imagen)) {
            unlink($mi_imagen);
        }
        $anuncio->update(['imagen_verificacion' => null]);

        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function imagenes_guardar_orden(Request $request, Anuncio $anuncio)
    {
        dd($request->all());
        if ($request->has('images')) {            
            $imagenes = json_decode($request->images, true);
            foreach ($imagenes as $position => $img_id) {
                $mi_img = Imagen::find($img_id);
                $mi_img->update(['position' => $position, 'estado'=>'Verificada']);
            }
        }
        $imagenes_pen = $anuncio->imagens()->where('estado', 'Pendinte');
        foreach ($imagenes_pen as $img) {
            $img->update(['estado' => 'Verificada']);
        }
        
        
        $img_portada = $anuncio->imagens()->orderBy('position')->first();
        $anuncio->portada_id = $img_portada->id;
        $anuncio->save();
       
        
        // Mail::to(config('app.mail_admin'))->send(new NuevasImagenMaileable($anuncio));
        return response()->json([
            'result' => true,
            'message' => 'Las imagenes se actualizaron correctamente'
        ]);
    }

    public function eliminar_imagen(Request $request)
    {
        if ($request->has('image_id')) {

            $imagen = Imagen::find($request->image_id);
            $anuncio = $imagen->anuncio;

            $path = public_path() . '/images/anuncio/' . $anuncio->id . '/';
            $pathoriginal = public_path() . '/images/anuncio/' . $anuncio->id . '/original' . '/';

            //para la del anuncio
            $mi_imagen = $path . $imagen->nombre;
            if (@getimagesize($mi_imagen)) {
                unlink($mi_imagen);
            }

            $mi_imagen_original = $pathoriginal . $imagen->nombre;
            if (@getimagesize($mi_imagen_original)) {
                unlink($mi_imagen_original);
            }

            if ($imagen->id == $anuncio->portada_id) {
                //es la de portada
                $anuncio->update(['portada_id' => null]);
            }
            $imagen->delete();

            return response()->json([
                'result' => true,
                'message' => 'Imagen eliminada correctamente.'
            ]);
        }

        return response()->json([
            'result' => false,
            'message' => 'La imagen no puede ser eliminada, por favor, intente nuevamente.'
        ]);
    }

    public function guardar_imagen(Request $request, Anuncio $anuncio)
    {
        $image = $request->file('image');
    
        if (!$image) {
            return response()->json([
                'result' => false,
                'message' => 'No se recibió la imagen.'
            ]);
        }
    
        // Asegurar que el archivo tenga una extensión válida
        $extension = $image->getClientOriginalExtension();
        if (!$extension) {
            $extension = explode('/', $image->getMimeType())[1]; // Obtener desde MIME type
        }
    
        if (!in_array($extension, ['jpeg', 'jpg', 'png', 'webp'])) {
            return response()->json([
                'result' => false,
                'message' => 'Formato de imagen no válido.'
            ]);
        }
    
        // Rutas de almacenamiento
        $path = public_path() . '/images/anuncio/' . $anuncio->id . '/';
        $pathoriginal = public_path() . '/images/anuncio/' . $anuncio->id . '/original/';
    
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        if (!file_exists($pathoriginal)) {
            mkdir($pathoriginal, 0777, true);
        }
    
        $nombreWebp = uniqid() . '.webp'; // Nombre en formato WebP
    
        try {
            // Intentar abrir la imagen con Intervention Image
            $img = Image::make($image->getRealPath());
        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => 'Error al procesar la imagen: ' . $e->getMessage()
            ]);
        }
    
        // Redimensionar imagen
        $img->resize(null, 1200, function ($constraint) {
            $constraint->aspectRatio();
        });
    
        // Guardar la imagen original en WebP
        $img->save($pathoriginal . $nombreWebp, 80, 'webp');
    
        // Aplicar marca de agua
        $watermark = Image::make(public_path() . '/images/logo.png');
        $por = 25;
        $watermark->resize(
            $watermark->width() * ($por / 100),
           $watermark->height() * ($por / 100),
        );
        $img->insert($watermark, 'center');
    
        // Guardar la imagen procesada en WebP con marca de agua
        $img->save($path . $nombreWebp, 80, 'webp');
    
        $last_position = Imagen::orderBy('position', 'desc')->limit(1)->value('position') ?? 0;
    
        $aImage = new Imagen();
        $aImage->anuncio_id = $anuncio->id;
        $aImage->user_id = $anuncio->user_id;
        $aImage->nombre = $nombreWebp;
        $aImage->estado = 'Verificada';
        $aImage->position = $last_position + 1;
        $aImage->portada = 'No';
        $aImage->save();
    
        return response()->json([
            'result' => true,
            'id' => $aImage->id,
            'position' => $aImage->position
        ]);
    }
    
    

    public function marcar_portada_doble(Request $request){
        $anuncio = Anuncio::find($request->anuncio_id);

        if ($request->has('imagen_slider')){
            $anuncio->update([
                'imagen_slider' => $request->imagen_slider]
            );    
            return redirect()->route('admin.users.edit_anuncio', $anuncio)
                    ->with('success', trans('messages.edit-confirm'));
        }
        
        $anuncio->update([
            'dobleportada_id' => $request->imagen_id]
        );
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
        ->with('success', trans('messages.edit-confirm'));
    }

    public function quitar_portada_doble(Request $request){
        $anuncio = Anuncio::find($request->anuncio_id);
        $anuncio->update(['dobleportada_id' => null]);
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
        ->with('success', trans('messages.edit-confirm'));
    }




}
