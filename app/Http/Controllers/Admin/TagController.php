<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class TagController
 * @package App\Http\Controllers
 */
class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();
        return view('admin.tag.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => ['required', 'max:50', Rule::unique('tags')->where(fn ($query) => $query->where('rubro', $request->rubro)->whereNull('deleted_at'))],
            'slug' => 'required',
            'color' => 'required',
            'visible' => 'required',
            'menu' => 'required',
        ]);

        $tag = Tag::create($request->all());

        return redirect()->route('tags.index')
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
        $tag = Tag::find($id);

        return view('admin.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        $tag = Tag::find($id);
        request()->validate([
            'nombre' => ['required', 'max:50', Rule::unique('tags')->where(fn ($query) => $query->where('rubro', $request->rubro)->where('id', $request->id)->whereNull('deleted_at'))],
            'slug' => 'required',
            'color' => 'required',
            'visible' => 'required',
            'menu' => 'required',
        ]);
        $tag->update($request->all());

        return redirect()->route('tags.index')
            ->with('success', trans('messages.edit-confirm'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tag = Tag::find($id)->delete();
        return redirect()->route('tags.index')
            ->with('success', trans('messages.delete-confirm'));
    }
}
