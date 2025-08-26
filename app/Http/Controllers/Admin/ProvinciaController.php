<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProvinciaRequest;
use App\Models\Provincia;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\Seo\Word;


/**
 * Class ProvinciaController
 * @package App\Http\Controllers
 */
class ProvinciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.provincias.index')->only('index');
        $this->middleware('can:admin.provincias.edit')->only('edit', 'update');
        $this->middleware('can:admin.provincias.create')->only('create', 'store');
        $this->middleware('can:admin.provincias.show')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::all();

        return view('admin.provincia.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincia = new Provincia();
        $states = State::all()->pluck('name', 'id');
        return view('admin.provincia.create', compact('provincia', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Provincia::$rules);

        $provincia = Provincia::create($request->all());

        return redirect()->route('provincias.index')
            ->with('success', trans('messages.create-confirm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provincia $provincia)
    {
        //$provincia = Provincia::find($id);

        return view('admin.provincia.show', compact('provincia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provincia $provincia)
    {
        // $provincia = Provincia::find($id);
        $provincia->title = null;
        $provincia->description = null;    
        $provincia->keywords = null;

        if($provincia->seo) {
            
            $provincia->title = $provincia->seo->title;
            $provincia->description = $provincia->seo->description;
            $provincia->keywords = $provincia->seo->keywords->map(fn($e) => $e->value);
            $provincia->keywords = implode(", ",$provincia->keywords->toArray());

        }

        $states = State::all()->pluck('name', 'id');
        return view('admin.provincia.edit', compact('provincia', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Provincia $provincia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinciaRequest $request, Provincia $provincia)
    {
        //request()->validate(Provincia::$rules);
        $words = explode(",", $request->input('keywords'));
        $words = collect($words);
        $words = $words->take(10);
        $words = $words->map(fn($e) => trim($e));
        $wordsIds = $words->map(fn($e) => Word::updateOrCreate([
            'value' => $e
        ])->id);

        if(!$provincia->seo) {
            //Hay que crearle seo
            $provincia->seo()->create([
                'title' => $request->input('title')
                , 'description' => $request->input('description')
            ]); 
            
            $provincia->refresh();
            
        }
        
        if($provincia->seo) {
            //Hay que crearle seo
            $provincia->seo()->update([
                'title' => $request->input('title')
                , 'description' => $request->input('description')
            ]);    
            
        }
        
        $provincia->seo->keywords()->sync($wordsIds->toArray());
        
        $provincia->update($request->all());

        return redirect()->route('provincias.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Provincia $provincia)
    {
        $provincia->delete();

        return redirect()->route('provincias.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
