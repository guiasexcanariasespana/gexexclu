<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Categoria;
use App\Models\Provincia;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $provincias = Provincia::all();
        $anuncios = Anuncio::whereIn('estado', ['Publicado'])->latest()->get();

        return response()->view('sitemap',compact('anuncios', 'categorias', 'provincias'))->header('Content-Type', 'text/xml');
    }
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /login/\n";
        $content .= "Disallow: /register/\n";
        $content .= "Disallow: /password/\n";
        $content .= "Disallow: /cart/\n";
        $content .= "Disallow: /checkout/\n";
        $content .= "Disallow: /user/\n\n";
        $content .= "Allow: /\n\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
