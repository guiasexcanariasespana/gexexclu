<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnuncioCreateAdminRequest;
use App\Http\Requests\UpdateAnuncioRequest;
use App\Mail\VerificacionPerfilMail;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use App\Models\Clase;
use App\Models\State;
use App\Models\Tag;
use App\Models\Zone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
        $this->middleware('can:admin.users.create')->only('create', 'store');
        $this->middleware('can:admin.tags.show')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $anuncios = $user->anuncios;
        $notas = $user->notas;
        return view('admin.users.show', compact('user', 'anuncios', 'notas'));
    }


    public function create()
    {
        //
        $roles = Role::all();
        $user = new User;
        $zones = Zone::orderBy('nombre')->pluck('nombre', 'id');
        return view('admin.users.create', compact('roles', 'user', 'zones'));
    }

    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required', // ACA DECIA NOMBRE
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:6', // this will check password 
            'edad' => 'required|numeric|gt:17',
            'telefono' => 'required'

        ]);

        $user = User::create([
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
            'fecha_de_nacimiento' => $request->fecha_de_nacimiento,
            'codigo_ws' => $request->codigo_ws,
            'estado_wsp' => $request->estado_wsp,
            'verificado' => $request->verificado,
            'nacionalidad' => $request->nacionalidad,
            'profesion' => $request->profesion,
            'direccion' => $request->direccion,
            'direccion_a_mostrar' => $request->direccion_a_mostrar,
            'gps' => $request->gps,
            'name' => $request->name,
            'edad' => $request->edad,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ])->assignRole('Usuario');

        return redirect()->route('admin.users.show', $user)->with('info', trans('messages.create-confirm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editroles(User $user)
    {
        //
        $roles = Role::all();
        return view('admin.users.editroles', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateroles(Request $request, User $user)
    {
        //
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.editroles', $user)->with('info', trans('messages.rol-asignado'));
    }



    public function edit($id)
    {
        $user = User::find($id);
        $zones = Zone::orderBy('nombre')->pluck('nombre', 'id');
        return view('admin.users.edit', compact('user', 'zones'));
    }

    public function suplantar($id)
    {
    $other_user = User::find($id);
    
    //IN CASE YOU WANT TO STORE THE ORIGINAL ADMIN USER FOR REVERTING THE SESSION
    $adminUserId = auth()->user()->id;

    //FLUSH THE SESSION SO THAT THE NEXT TIME LOGIN IS CALLED IT RUNS THROUGH ALL AUTH PROCEDURES
    Session::flush();

    //LOGIN AS THE USER
    Auth::login($other_user);

    //IN CASE YOU WANT TO STORE THE ORIGINAL ADMIN USER FOR REVERTING THE SESSION

    Session::put('admin_user_id', $adminUserId);
    
    //Auth::logout();

    Auth::login($other_user);
    return redirect()->route('dashboard');
    }

   public function leaveImpersonate()
   {
   auth()->user()->leaveImpersonation();

   return redirect()->route('dashboard');
   }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {


        $request->validate([
            'name' => 'required', // ACA DECIA NOMBRE
            'email' => 'required|unique:users,email,' . $user->id,        
            'edad' => 'required|numeric|gt:17',
            'telefono' => 'required',            
        ]);

        $user->fill([
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,         
            'estado_wsp' => $request->estado_wsp,
            'verificado' => $request->verificado,
            'nacionalidad' => $request->nacionalidad,
            'profesion' => $request->profesion,
            'direccion' => $request->direccion,            
            'gps' => $request->gps,
            'name' => $request->name,
            'edad' => $request->edad,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at,
              
        ]);
        if ($request->password) {
            $request->validate([
                'password' => 'sometimes|min:8',
            ]);
            $user->fill(['password' => Hash::make($request->password)]);
        }
        $user->save();
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully');
    }


    #####Autorizar o no el perfil
    public function edit_autorizar($id)
    {
        $user = User::find($id);
        $anuncios = $user->anuncios;
        $notas = $user->notas;
        return view('admin.users.edit_autorizar', compact('user', 'anuncios', 'notas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function aprobar_perfil($id)
    {
        $user = User::find($id);
        $user->update(['verificado' => 'Si']);
        Mail::to($user->email)->send(new VerificacionPerfilMail($user));
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully');
    }

    public function rechazar_perfil($id)
    {
        $user = User::find($id);
        $user->update(['verificado' => 'Rechazado']);
        Mail::to($user->email)->send(new VerificacionPerfilMail($user));
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            // Eliminar relaciones antes de borrar el usuario
            $user->anuncios()->delete();
            $user->pagos()->delete();

            // Anonimizar el email antes de eliminarlo
            $user->update(['email' => $user->email . '.borrado' . $user->id]);

            // Eliminar usuario
            $user->delete();

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.new.accesos')
                ->with('success', trans('messages.delete-confirm'));

        } catch (\Throwable $e) {
            // Si hay error, regresar a la página anterior con mensaje de error
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }



    public function create_anuncio(User $user)
    {
        //$user->anuncios;
        $categorias = Categoria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clases = Clase::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $states = State::orderBy('name', 'asc')->pluck('name', 'id');

        $anuncio = new Anuncio();
        $anuncio->user_id = $user->id;
        $anuncio->ip_address = $_SERVER['REMOTE_ADDR'];
        $anuncio->port = $_SERVER['REMOTE_PORT'];
        $anuncio->telefono = $user->telefono;
        $anuncio->edad = $user->edad;
        // if(!is_null($user->fecha_de_nacimiento)){
        //     $anuncio->fecha_nacimiento = date('Y-m-d', strtotime($user->fecha_de_nacimiento));           
        //     $years = Carbon::parse($user->fecha_de_nacimiento)->age;
        //     $anuncio->edad = $years;
        // }
        $anuncio->nacionalidad = $user->nacionalidad;
        $anuncio->profesion = $user->profesion;
        $tag_al = Tag::where('rubro', 'AL')->orderby('nombre')->get();
        $tag_etc = Tag::where('rubro', 'ETC')->orderby('nombre')->get();
        $tag_ec = Tag::where('rubro', 'EC')->orderby('nombre')->get();
        $tag_in = Tag::where('rubro', 'IN')->orderby('nombre')->get();
        return view('admin.users.create_anuncio', compact('tag_in', 'tag_etc', 'tag_ec', 'tag_al', 'user', 'anuncio', 'categorias', 'clases', 'states',));
    }


    public function store_anuncio(AnuncioCreateAdminRequest $request, User $user)
    {
        //$user->anuncios;

        //request()->validate(Anuncio::$rules);


        $anuncio = Anuncio::create($request->all());
        if (!is_null($request->fecha_de_publicacion) && is_null($request->fecha_de_caducidad)) {
            $fecha_publi = Carbon::parse($request->fecha_de_publicacion);
            $hora_actual = $fecha_publi->format('H');
            if ($hora_actual > config('app.hora_agregar_dia')) {
                $fecha_fin =  $fecha_publi->addDays($anuncio->dias);
            } else {
                $fecha_fin = $fecha_publi->addDays($anuncio->dias - 1);
                $fecha_fin = $fecha_fin->format('Y-m-d');
            }
            $request->fecha_de_caducidad = $fecha_fin;
        }
        //dd($fecha_fin);
        $anuncio->update(['fecha_caducidad' => $request->fecha_de_caducidad, 'presentacion' => $request->presentacion_aux]);
        if (!str_contains($request->slug, $anuncio->id)) {
            $request->slug =  $anuncio->id . '-' . $request->slug;
            $anuncio->update(['slug' => $request->slug]);
        }
        if ($request->tags) {
            $anuncio->tags()->attach($request->tags);
        }
        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Anuncio creado correctamente.');
    }


    public function edit_anuncio(Anuncio $anuncio)
    {
        //$user->anuncios;
        $categorias = Categoria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clases = Clase::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        // $zones = Zone::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $user =  $anuncio->user;
        $notas = $anuncio->notas;
        $pagos = $anuncio->pagos;
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
        $tag_al = Tag::where('rubro', 'AL')->orderBy('nombre')->get();
        $tag_etc = Tag::where('rubro', 'ETC')->orderBy('nombre')->get();
        $tag_ec = Tag::where('rubro', 'EC')->orderBy('nombre')->get();
        $tag_in = Tag::where('rubro', 'IN')->orderby('nombre')->get();
        return view('admin.users.edit_anuncio', compact('imagenes_drop_zone', 'tag_in', 'tag_etc', 'tag_ec', 'tag_al', 'user', 'anuncio', 'categorias', 'clases', 'notas', 'pagos'));
    }


    public function update_anuncio(UpdateAnuncioRequest $request, Anuncio $anuncio)
    {
        
        //$user->anuncios;
        //request()->validate(Anuncio::$rules);
        $cambia_fecha_fin = false;

        // Verifico si cambia fecha de inicio o cantidad de dias
        //dd($anuncio->fecha_de_publicacion . ' - ' . $request->fecha_de_publicacion . '  - ' .$anuncio->dias . ' - ' . $request->dias);
        if (!is_null($anuncio->fecha_de_publicacion)) {
            $fecha_publicado = \Carbon\Carbon::parse($anuncio->fecha_de_publicacion)->format('Y-m-d');
            if (($fecha_publicado != $request->fecha_de_publicacion) or ($anuncio->dias != $request->dias)) {
                $cambia_fecha_fin = true;
            }
        } else {
            //fecha nula y ahora trae algo
            if (!is_null($request->fecha_de_publicacion)) {
                $cambia_fecha_fin = true;
            }
        }
        
        $anuncio->update($request->all());
        if (!str_contains($anuncio->slug, $anuncio->id)) {

            $slug =  $anuncio->id . '-' . $request->slug;
            $anuncio->update(['slug'=>$slug]);
        }        
        if ($request->tags) {
            $anuncio->tags()->sync($request->tags);
        }
        // Verifico si cambia fecha de inicio o cantidad de dias

        if ($cambia_fecha_fin) {
            //recalculo fecha de fin

            if (is_null($request->fecha_de_publicacion)) {
                $fecha_fin = null;
            } else {
                $fecha_publi = Carbon::parse($request->fecha_de_publicacion);
                $hora_actual = $fecha_publi->format('H');
                if (
                    $hora_actual > config('app.hora_agregar_dia')
                ) {
                    $fecha_fin =  $fecha_publi->addDays($anuncio->dias);
                } else {
                    $fecha_fin = $fecha_publi->addDays($anuncio->dias - 1);
                    $fecha_fin = $fecha_fin->format('Y-m-d');
                }
            }
            //dd($fecha_fin);
            $anuncio->update(['fecha_caducidad' => $fecha_fin]);
        }

        $anuncio->update(['presentacion' => $request->presentacion_aux, 'mostrar_telefono'=>'Si']);

        return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', trans('messages.edit-confirm'));
 
    }
}
