<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class AvisoLegalController extends Controller
{
    /**
     * Show the terms of service for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $avisoFile = Jetstream::localizedMarkdownPath('aviso.md');

        return view('aviso_legal', [
            'aviso' => Str::markdown(file_get_contents($avisoFile)),
        ]);
    }
}
