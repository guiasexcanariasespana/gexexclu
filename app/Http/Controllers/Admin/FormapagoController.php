<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFormapagoRequest;
use App\Models\Formapago;
use Illuminate\Http\Request;

/**
 * Class FormapagoController
 * @package App\Http\Controllers
 */
class FormapagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.formapagos.index')->only('index');
        $this->middleware('can:admin.formapagos.edit')->only('edit', 'update');
        $this->middleware('can:admin.formapagos.create')->only('create', 'store');
        $this->middleware('can:admin.formapagos.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formapagos = Formapago::all();

        return view('admin.formapago.index', compact('formapagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formapago = new Formapago();
        return view('admin.formapago.create', compact('formapago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Formapago::$rules);

        $formapago = Formapago::create($request->all());

        return redirect()->route('formapagos.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formapago $formapago)
    {
       // $formapago = Formapago::find($id);

        return view('admin.formapago.show', compact('formapago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Formapago $formapago)
    {
       //$formapago = Formapago::find($id);

        return view('admin.formapago.edit', compact('formapago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Formapago $formapago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormapagoRequest $request, Formapago $formapago)
    {
       // request()->validate(Formapago::$rules);

        $formapago->update($request->all());

        return redirect()->route('formapagos.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Formapago $formapago)
    {
        $formapago->delete();

        return redirect()->route('formapagos.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
