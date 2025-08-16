<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;;

use App\Models\Precio;
use Illuminate\Http\Request;

/**
 * Class PrecioController
 * @package App\Http\Controllers
 */
class PrecioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.zones.precio')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precios = Precio::paginate();

        return view('admin.precio.index', compact('precios'))
            ->with('i', (request()->input('page', 1) - 1) * $precios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precio = new Precio();
        return view('admin.precio.create', compact('precio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Precio::$rules);

        $precio = Precio::create($request->all());

        return redirect()->route('precios.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precio = Precio::find($id);

        return view('admin.precio.show', compact('precio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $precio = Precio::find($id);

        return view('admin.precio.edit', compact('precio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Precio $precio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precio $precio)
    {
        request()->validate(Precio::$rules);

        $precio->update($request->all());

        return redirect()->route('precios.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $precio = Precio::find($id)->delete();

        return redirect()->route('precios.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
