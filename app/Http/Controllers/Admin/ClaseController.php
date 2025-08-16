<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClaseRequest;
use App\Models\Clase;

use Illuminate\Http\Request;

/**
 * Class ClaseController
 * @package App\Http\Controllers
 */
class ClaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.clases.index')->only('index');
        $this->middleware('can:admin.clases.edit')->only('edit', 'update');
        $this->middleware('can:admin.clases.create')->only('create', 'store');
        $this->middleware('can:admin.clases.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clases = Clase::all();

        return view('admin.clase.index', compact('clases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clase = new Clase();
        return view('admin.clase.create', compact('clase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Clase::$rules);

        $clase = Clase::create($request->all());

        return redirect()->route('clases.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Clase $clase)
    {
        #$clase = Clase::find($id);

        return view('admin.clase.show', compact('clase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Clase $clase)
    {
        #$clase = Clase::find($id);

        return view('admin.clase.edit', compact('clase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Clase $clase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClaseRequest $request, Clase $clase)
    {
        //request()->validate(Clase::$rules);

        $clase->update($request->all());

        return redirect()->route('clases.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Clase $clase)
    {
        #$clase = Clase::find($id)->delete();
        $clase->delete();

        return redirect()->route('clases.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
