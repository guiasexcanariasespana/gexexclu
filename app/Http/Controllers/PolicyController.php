<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;


class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $policyFile = Jetstream::localizedMarkdownPath('policy.md');

        try {
        if (!file_exists($policyFile)) {
            throw new Exception("El archivo no existe");
        }
    
        $contenido = file_get_contents($policyFile);
        if ($contenido === false) {
            throw new Exception("Error al leer el archivo");
        }
    
        $html = Str::markdown($contenido);
        } catch (Exception $e) {
            $html = "<p>Error: " . $e->getMessage() . "</p>";
        }
         return view('policy', ['policy' => $html,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
