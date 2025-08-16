<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anuncio;


/**
 * Class NotaController
 * @package App\Http\Controllers
 */
class NotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.notas');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::paginate();

        return view('nota.index', compact('notas'))
            ->with('i', (request()->input('page', 1) - 1) * $notas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nota = new Nota();
        return view('nota.create', compact('nota'));
    }

    public function usercreate(User $user)
    {
        $nota = new  Nota();
        return view('admin.nota.usercreate', compact('nota', 'user'));
    }

    public function anunciocreate(Anuncio $anuncio)
    {
        $nota = new Nota();
        return view('admin.nota.anunciocreate', compact('nota', 'anuncio'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     request()->validate(Nota::$rules);
    //     $nota = new  Nota($request->all());
    //    # $nota = Nota::create($request->all());

    //     return redirect()->route('admin.anuncio.show', $anuncio)
    //         ->with('success', 'Nota created successfully.');
    }

    public function userstore(Request $request, User $user)
    {
        request()->validate(Nota::$rules);
        //  $nota = new $user->notas($request->all());
        //$nota = Nota::create($request->all());
        // $nota = $user->notas->create($request->all());
        $nota = new  Nota($request->all());
        $nota->user_id = $user->id;
        $nota->save();
        return redirect()->route('admin.users.show', $user)
        ->with('success', 'Nota created successfully.');
    }


    public function anunciostore(Request $request, Anuncio $anuncio)
    {
        request()->validate(Nota::$rules);

        $nota = new  Nota($request->all());
        $nota->anuncio_id = $anuncio->id;
        $nota->save();
        return redirect()-> route('admin.users.edit_anuncio', $anuncio)
        ->with('success', 'Nota created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = Nota::find($id);

        return view('admin.nota.show', compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        #$nota = Nota::find($id);

        return view('admin.nota.edit', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Nota $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        request()->validate(Nota::$rules);

        $nota->update($request->all());

        return redirect()->route('admin.notas.show', $nota)
            ->with('success', 'Nota updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();
        if(is_null($nota->user_id)){
            $anuncio = $nota->anuncio;            
            return redirect()->route('admin.users.edit_anuncio', $anuncio)
            ->with('success', 'Nota deleted successfully');
        }else{
            $user = $nota->user;
            return redirect()->route('admin.users.show', $user)
            ->with('success', 'Nota deleted successfully');
        }
        


       
    }
}
