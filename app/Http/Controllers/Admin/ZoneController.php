<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Municipio;
use App\Models\State;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Models\Plane;
use App\Models\Precio;
use App\Models\Provincia;
/**
 * Class ZoneController
 * @package App\Http\Controllers
 */
class ZoneController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.zones.index')->only('index');
        $this->middleware('can:admin.zones.edit')->only('edit', 'update');
        $this->middleware('can:admin.zones.create')->only('create', 'store');
        $this->middleware('can:admin.zones.show')->only('show');
        $this->middleware('can:admin.zones.precio')->only('create_precio', 'store_precio', 'edit_precio', 'destroy_precio');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::paginate();

        return view('admin.zone.index', compact('zones'))
            ->with('i', (request()->input('page', 1) - 1) * $zones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $municipios = Municipio::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $zone = new Zone();
        return view('admin.zone.create', compact('zone', 'municipios', 'provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Zone::$rules);

        $zone = Zone::create($request->all());

        return redirect()->route('zones.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        # $zone = Zone::find($id);

        return view('admin.zone.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $provincias = Provincia::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $municipios = Municipio::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        #$zone = Zone::find($id);

        return view('admin.zone.edit', compact('zone', 'municipios', 'provincias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZoneRequest $request, Zone $zone)
    {
       // request()->validate(Zone::$rules);

        $zone->update($request->all());

        return redirect()->route('zones.index')
            ->with('success', trans('messages.edit-confirm'));
    }

  
    public function destroy(Zone $zone)
    {
        #$zone = Zone::find($id)->delete();
        $zone->delete();
        return redirect()->route('zones.index')
            ->with('success', trans('messages.delete-confirm'));
    }


    public function create_precio(Zone $zone)
    {
         //recupero los planes ya listado en la provincia
        $planes_ids = Precio::where('zone_id', '=', $zone->id)->pluck('plan_id');
       
        $planes = Plane::whereNotIn('id', $planes_ids)->orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $precio = new Precio();
        $precio->zone_id = $zone->id;
        return view('admin.zone.createprecio', compact('zone', 'planes', 'precio'));
    }

    public function store_precio(Request $request)
    {

        request()->validate(Precio::$rules);

        $precio = Precio::create($request->all());
        $zone =  $precio->zone;
        $precios = $zone->precios;
        return redirect()->route('zones.show', $zone)
            ->with('success', trans('messages.create-confirm'));
    }


    public function edit_precio(Precio $precio)
    {
        $planes = Plane::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $zone = $precio->zone;
        return view('admin.zone.editprecio', compact('zone', 'planes', 'precio'));
    }

    public function update_precio(Request $request, Precio $precio)
    {

        request()->validate(Precio::$rules);

        $precio->update($request->all());
        $zone =  $precio->zone;

        return redirect()->route('zones.show', $zone)
            ->with('success', trans('messages.edit-confirm'));
    }

    public function destroy_precio(Precio $precio)
    {
        $zone = $precio->zone;
        $precio->delete();
        
        return redirect()->route('zones.show', $zone)
            ->with('success', trans('messages.delete-confirm'));
    }
}
