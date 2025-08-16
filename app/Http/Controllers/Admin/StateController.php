<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plane;
use App\Models\State;
use Illuminate\Http\Request;
use Livewire\HydrationMiddleware\RenderView;
use App\Models\Precio;

/**
 * Class StateController
 * @package App\Http\Admin\Controllers
 */
class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.states.index')->only('index');
        $this->middleware('can:admin.states.edit')->only('edit', 'update');
        $this->middleware('can:admin.states.create')->only('create', 'store');
        $this->middleware('can:admin.states.show')->only('show');
        $this->middleware('can:admin.states.destroy')->only('destroy');
        $this->middleware('can:admin.states.precio')->only('create_precio', 'store_precio', 'edit_precio', 'destroy_precio');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::paginate();

        return view('admin.state.index', compact('states'))
            ->with('i', (request()->input('page', 1) - 1) * $states->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state = new State();
        return view('admin.state.create', compact('state'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(State::$rules);

        $state = State::create($request->all());

        return redirect()->route('states.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
       # $state = State::find($id);

        return view('admin.state.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
       # $state = State::find($id);

        return view('admin.state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  State $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        request()->validate(State::$rules);

        $state->update($request->all());

        return redirect()->route('states.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
    
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(State $state)
    {
        #$state->delete();
        $state->delete();
        return redirect()->route('states.index')
            ->with('success', trans('messages.delete-confirm'));
    }


    public function create_precio(State $state){
        //recupero los planes ya listado en la provincia
        $planes_ids = Precio::where('state_id', '=', $state->id)->pluck('plan_id');
        $planes = Plane::whereNotIn('id', $planes_ids)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $precio = new Precio();        
        $precio->state_id = $state->id;
       return view('admin.state.createprecio', compact('state', 'planes', 'precio'));
    }

    public function store_precio(Request $request)
    {

        request()->validate(Precio::$rules);

        $precio = Precio::create($request->all());
        $state =  $precio->state;
        $precios = $state->precios;
        return redirect()->route('states.show', $state)
        ->with('success', trans('messages.create-confirm'));
        
    }


    public function edit_precio(Precio $precio)
    {
        $planes = Plane::orderBy('nombre', 'asc')->pluck('nombre', 'id');        
        $state = $precio->state;
        return view('admin.state.editprecio', compact('state', 'planes', 'precio'));
    }

    public function update_precio(Request $request, Precio $precio)
    {

        request()->validate(Precio::$rules);

        $precio->update($request->all());
        $state =  $precio->state;
        
        return redirect()->route('states.show', $state)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function destroy_precio(Precio $precio)
    {
        $state= $precio->state; 
        $precio->delete();

        return redirect()->route('states.show', $state)
        ->with('success', trans('messages.delete-confirm'));
    }



}
