<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lugar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLugarRequest;

/**
 * Class LugarController
 * @package App\Http\Controllers
 */
class LugarController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.lugares.index')->only('index');
        $this->middleware('can:admin.lugares.edit')->only('edit', 'update');
        $this->middleware('can:admin.lugares.create')->only('create', 'store');
        $this->middleware('can:admin.lugares.show')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lugars = Lugar::paginate();

        return view('admin.lugar.index', compact('lugars'))
            ->with('i', (request()->input('page', 1) - 1) * $lugars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lugar = new Lugar();
        return view('admin.lugar.create', compact('lugar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Lugar::$rules);

        $lugar = Lugar::create($request->all());

        return redirect()->route('lugars.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lugar $lugar)
    {
        #$lugar = Lugar::find($id);

        return view('admin.lugar.show', compact('lugar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lugar $lugar)
    {
       # $lugar = Lugar::find($id);

        return view('admin.lugar.edit', compact('lugar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Lugar $lugar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLugarRequest $request, Lugar $lugar)
    {
        //request()->validate(Lugar::$rules);

        $lugar->update($request->all());

        return redirect()->route('lugars.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Lugar $lugar)
    {
        # $lugar = Lugar::find($id)->delete();
        $lugar->delete();
        return redirect()->route('lugars.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
