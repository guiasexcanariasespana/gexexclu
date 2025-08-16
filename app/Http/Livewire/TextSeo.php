<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Municipio;
use App\Models\Provincia;
use Livewire\Component;

use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;


class TextSeo extends Component
{
    public function render()
    {
        if (is_null(session('categoriaSel'))) {
            $categoria = Categoria::where('nombre', 'Chicas')->first();
        }else{
            $categoria = Categoria::find(session('provinciaSel'));
        }

        if (!is_null(session('provinciaSel'))) {
            $provincia = Provincia::find(session('provinciaSel'));
        }

        if (!is_null(session('muniSelec'))) {
            $municipio = Municipio::find(session('muniSelec'));
            $locacion = $municipio->nombre . ' ' . $provincia->nombre;
        } else {
            $locacion = $provincia->nombre;
        }

        SEOMeta::setTitle($categoria->nombre . ' escort en ' . $locacion . ' España');
        SEOMeta::setDescription('Escort en ' . $locacion . ' España para encuentros. Acompañantes ' . $categoria->nombre . ' en ' . $locacion . ' en España, no anuncios de sexo ni putas en España');
        SEOMeta::setCanonical('https://canariasexclusiva.com/esccort');

        OpenGraph::setDescription('Escort en ' . $locacion . ' España para encuentros. Acompañantes ' . $categoria->nombre . ' en ' . $locacion . ' en España, no anuncios de sexo ni putas en España');
        OpenGraph::setTitle($categoria->nombre . ' escort, acompañantes en ' . $locacion . ' España');
        OpenGraph::setUrl('https://canariasexclusiva.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Escort, acompañantes en ' . $locacion . ' España');
        // TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($categoria->nombre . ' escort, acompañantes en ' . $locacion . ' España');
        JsonLd::setDescription('Escort en ' . $locacion . ' España para encuentros. Acompañantes ' . $categoria->nombre . ' en ' . $locacion . ' en España, no anuncios de sexo ni putas en España');
        JsonLd::addImage(config('app.url') . '/img/logo.png');

        
        return view('livewire.text-seo');
    }
}
