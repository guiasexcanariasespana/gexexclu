<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class CookiesPolicyController extends Controller
{
    /**
     * Show the terms of service for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $cookiesFile = Jetstream::localizedMarkdownPath('cookies.md');

        return view('cookies', [
            'cookies' => Str::markdown(file_get_contents($cookiesFile)),
        ]);
    }
}
