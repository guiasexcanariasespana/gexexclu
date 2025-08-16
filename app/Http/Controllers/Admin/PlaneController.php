<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Categoria;
use App\Models\Clase;
use App\Models\Plane;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePlanRequest;

/**
 * Class PlaneController
 * @package App\Http\Controllers
 */
class PlaneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.planes.index')->only('index');
        $this->middleware('can:admin.planes.edit')->only('edit', 'update');
        $this->middleware('can:admin.planes.create')->only('create', 'store');
        $this->middleware('can:admin.planes.show')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $planes = Plane::all();

        return view('admin.planes.index', compact('planes'));
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
        $plane = new Plane();
        return view('admin.planes.create', compact('plane', 'categorias', 'clases'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlanRequest $request)
    {
        //equest()->validate(Plane::$rules);

        $plane = Plane::create($request->all());

        if (!str_contains($request->slug, $plane->id)) {
            $request->slug =  $plane->id . '-' . $request->slug;
            $plane->update(['slug' => $request->slug]);
        }

        return redirect()->route('planes.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plane $plane)
    {
        #$plane = Plane::find($id);

        return view('admin.planes.show', compact('plane'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plane $plane)
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $clases = Clase::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        #$plane = Plane::find($id);

        return view('admin.planes.edit', compact('plane', 'categorias', 'clases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Plane $plane
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request, Plane $plane)
    {
        //request()->validate(Plane::$rules);
        if (!str_contains($request->slug, $plane->id)) {
            $request->slug =  $plane->id . '-' . $request->slug;
        }
        $plane->update($request->all());

        return redirect()->route('planes.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Plane $plane)
    {
        #$plane = Plane::find($id)->delete();
        $plane->delete();
        return redirect()->route('planes.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
