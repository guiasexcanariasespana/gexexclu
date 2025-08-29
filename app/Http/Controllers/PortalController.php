<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Categoria;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Cache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;


class PortalController extends Controller
{

    public function index_general()
    {

        //     SEOMeta::setTitle('Escort, acompañantes en Canarias España');
        //     SEOMeta::setDescription('Escort en Canarias España para encuentros. Acompañantes chicas, chicos, travestis, servicios de masajistas en España, no anuncios de sexo ni putas en España');
        //     SEOMeta::setCanonical('https://guiasexcanarias.com/escort');

        //     OpenGraph::setDescription('Escort en Canarias España para encuentros. Acompañantes chicas, chicos, travestis, servicios de masajistas en España, no anuncios de sexo ni putas en España');
        //     OpenGraph::setTitle('Escort, acompañantes en Canarias España - guiasexcanarias.com');
        //     OpenGraph::setUrl('https://guiasexcanarias.com/escort');
        //     OpenGraph::addProperty('type', 'articles');

        //     TwitterCard::setTitle('Escort, acompañantes en Canarias España - guiasexcanarias.com');
        //     // TwitterCard::setSite('@LuizVinicius73');

        //     JsonLd::setTitle('Escort, acompañantes en Canarias España - guiasexcanarias.com');
        //     JsonLd::setDescription('Escort en Canarias España para encuentros. Acompañantes chicas, chicos, travestis, servicios de masajistas en Canarias España, no anuncios de sexo ni putas en Canarias España');
        //     JsonLd::addImage(config('app.url') . '/img/logo.png');

            SEOMeta::addKeyword(['guiasexcanarias', 'exclusiva', 'excluivas canarias' , 'canarias exclusivas', 'españa exclusivas', 'guia sex canarias', 'giasex canarias' ,'chicos' ,'excluivas españa', 'escort', 'escort españa', 'canarias', 'masajistas', 'masajes canarias', 'masajes españa' , 'acompañantes', 'españa', 'travestis', 'acompañantes españa', 'acompañantes canarias', 'amistad', 'conocer gente', 'citas en línea',
            'encontrar pareja en línea', 'conocer gente nueva', 'sitio de citas', 'relaciones en línea', 'amor en línea', 'búsqueda de pareja', 'encuentros en línea', 'solteros en línea', 'chat en línea', 'consejos de citas', 'servicio de citas', 'personas solteras', 'matchmaking', 'parejas compatibles', 'amistades en línea', 'relaciones serias', 'buscando amor',
            'citas seguras', 'citas exitosas', 'encuentros rápidos', 'citas virtuales', 'encuentros amorosos', 'citas en línea seguras', 'red social de citas', 'servicio de emparejamiento', 'parejas felices', 'encontrar amor en línea', 'personas solteras cerca de mí', 'conexiones en línea', 'encuentros románticos', 'no_putas' ]);
        // // OR
        // if (Cache::has('categorias')) {
        //     $categorias = Cache::get('categorias');
        // } else {
        //     $categorias = Categoria::all();
        //     Cache::put('categorias', $categorias, 1800);
        // }

        $ultima_provincia = null;
        $ultima_categoria = null;
        if (!is_null(session('provinciaSel'))) {
            $ultima_provincia = Provincia::find(session('provinciaSel'));
        }

        $ultima_categoria = null;
        if (!is_null(session('categoriaSel'))) {
            $ultima_categoria = Categoria::find(session('categoriaSel'));
        }


        if (Cache::has('prov_laspalmas')) {
            $prov_laspalmas = Cache::get('prov_laspalmas');
        } else {
            $prov_laspalmas = Provincia::where('nombre', 'like', 'Las palmas')->first();
            Cache::put('prov_laspalmas', $prov_laspalmas, 600);
        }

        if (Cache::has('prov_tenerife')) {
            $prov_tenerife = Cache::get('prov_tenerife');
        } else {
            $prov_tenerife = Provincia::where('nombre', 'like', 'S.C. Tenerife%')->first();
            Cache::put('prov_tenerife', $prov_tenerife, 600);
        }


        // if (Cache::has('provincias2')) {
        //     $provincias = Cache::get('provincias');
        // } else {
        //     $provincias = Provincia::selectRaw('provincias.* , SUM(if(anuncios.estado = "Publicado" and anuncios.verificacion = "Si" , 1, 0)) as cant_anun')
        //         ->leftjoin('anuncios', 'provincias.id', '=', 'anuncios.provincia_id')
        //         ->whereNotIn('provincias.id', [$prov_tenerife->id, $prov_valencia->id, $prov_laspalmas->id, $prov_barcelona->id, $prov_madrid->id])
        //         ->groupBy('provincias.id')
        //         ->orderByRaw('cant_anun desc')
        //         ->get();
        //     Cache::put('provincias', $provincias, 1800);
        // }


        if (Cache::has('categorias2')) {
            $categorias = Cache::get('categorias');
        } else {
            $categorias = Categoria::all();
            Cache::put('categorias', $categorias, 600);
        }

        $cat_provincias = [];
        foreach ($categorias as $categoria) {
            $nombre_de_variable = "provincias_" . strtolower($categoria->nombre);

            if (Cache::has('provincias2')) {
                ${"provincias_" . strtolower($categoria->nombre)} = Cache::get($$nombre_de_variable);
            } else {
                $$nombre_de_variable = Provincia::selectRaw('provincias.* , SUM(if(anuncios.estado = "Publicado" and anuncios.verificacion = "Si" , 1, 0)) as cant_anun')
                    ->leftjoin('anuncios', function ($join) use ($categoria) {
                        $join->on('provincias.id', '=', 'anuncios.provincia_id')
                            ->where('anuncios.categoria_id', '=', "$categoria->id")
                            ->where('anuncios.estado', '=', "Publicado")
                            ->where('anuncios.verificacion', '=', "Si");
                    })
                    ->whereNotIn('provincias.id', [$prov_tenerife->id,  $prov_laspalmas->id])
                    ->groupBy('provincias.id')
                    ->orderByRaw('cant_anun desc')
                    ->get();
                Cache::put($$nombre_de_variable, $$nombre_de_variable, 1800);
            }
            $cat_provincias[$nombre_de_variable] = $$nombre_de_variable;
        }


        return view('index', compact('ultima_categoria', 'ultima_provincia', 'categorias', 'cat_provincias', 'prov_laspalmas', 'prov_tenerife'));
    }

    // public function set_provincia(Provincia $provincia)
    // {
    //     session()->put('provinciaSel', $provincia->id);
    //     session()->put('muniSelec', null);
    //     session()->put('categoriaSel', null);
    //     return redirect()->route('index', $provincia);
    // }

    // public function set_municipio(Municipio $municipio)
    // {
    // session()->put('muniSelec', $municipio);
    // session()->put('categoriaSel', null);
    // return redirect()->route('index', [$municipio->provincia, $municipio]);
    // }

    // public function set_provincia_y_categoria(Provincia $provincia = null, Categoria $categoria)
    // {
    //     session()->put('provinciaSel', $provincia->id);
    //     session()->put('categoriaSel', $categoria->id);
    //     session()->put('muniSelec', null);


    //     return redirect()->route('index', [$provincia, $categoria]);
    // }

    // public function index_prev()
    // {
    //     // if (is_null(session('muniSelec'))) {
    //     //     ##veo si hay provincia
    //     //     if (is_null(session('provinciaSel'))) {
    //     //         return redirect()->route('index');
    //     //     }else{
    //     //         $provincia = Provincia::find(session('provinciaSel'));
    //     //         return redirect()->route('index_provincia', [$provincia]);
    //     //     }
    //     // }else{
    //     //     $municipio = Municipio::find(session('muniSelec'));
    //     //     $provincia = $municipio->provincia;
    //     // return redirect()->route('index_provincia_municipio', [$provincia, $municipio]);
    //     // }
    //     return redirect()->route('index');
    // }

    public function index(Provincia $provincia, Categoria $categoria = null)
    {
        // dd(session('provinciaSel'));
        //session()->put('provinciaSel', $provincia->id);

        // if (!is_null(session('provinciaSel'))) {
        //     $provincia = Categoria::find(session('categoriaSel'));
        // } else {
        //     $provincia = Categoria::where('nombre', 'Chicas')->first();
        //     session()->put('categoriaSel', $categoria->id);
        // }
        #Meto las provincias en cache cada una en su variable
        $municipios = [];
        $municipio = null;

        if (Cache::has('prov_laspalmas')) {
            $prov_laspalmas = Cache::get('prov_laspalmas');
        } else {
            $prov_laspalmas = Provincia::where('nombre', 'like', 'Las palmas')->first();
            Cache::put('prov_laspalmas', $prov_laspalmas, 600);
        }

        if (Cache::has('prov_tenerife')) {
            $prov_tenerife = Cache::get('prov_tenerife');
        } else {
            $prov_tenerife = Provincia::where('nombre', 'like', 'S.C. Tenerife%')->first();
            Cache::put('prov_tenerife', $prov_tenerife, 600);
        }

        if (!is_null(session('categoriaSel'))) {
            $categoria = Categoria::find(session('categoriaSel'));
        } else {
            $categoria = null;
            session()->put('categoriaSel', 0);
        }

        if (!is_null(session('muniSelec'))) {
            $municipio = Municipio::find(session('muniSelec'));
            $locacion = $municipio->nombre . ' ' . $provincia->nombre;
        } else {
            $locacion = $provincia->nombre;
        }


        if (is_null($categoria)) {
            $categoria_nombre = 'escorts';
        } else {
            if ($categoria->nombre != 'Transexuales') {
                $categoria_nombre = $categoria->nombre;
                SEOMeta::addKeyword($categoria->nombre);
            } else {
                $categoria_nombre = 'Travestis';
                SEOMeta::addKeyword('Travestis');
            }
        }
        SEOMeta::setTitle('Escorts '. $categoria_nombre .' en ' . $locacion . ' islas Canarias');
        $description = 'Escorts en islas Canarias para encuentros. Acompañantes ' . $categoria_nombre . ' en ' . 'Islas Canarias, no anuncios de sexo ni putas en Islas Canarias';

        if($locacion){
            $locacion = rtrim($locacion);
            $description = 'Escorts en '.$locacion.', islas Canarias para encuentros. Acompañantes ' . $categoria_nombre . 's en ' . $locacion . ' islas Canarias, no anuncios de sexo ni putas en islas Canarias';
        }
        SEOMeta::setDescription($description);
        
        $seo_url = url('/');
        if (!is_null($provincia->slug)) {
            $seo_url = $seo_url . '/' . $provincia->slug;
        }

        $wordList = [
            'guiasexcanarias', 'excluiva', 'excluivas canarias', 'canarias exclusivas', 'españa exclusivas', 'guia sex canarias', 'giasex canarias', 'chicos', 'excluivas españa', 'escorts', 'escorts españa', 'canarias', 'masajistas', 'masajes canarias', 'masajes españa', 'acompañantes', 'españa', 'travestis', 'acompañantes españa', 'acompañantes canarias', 'amistad', 'conocer gente', 'citas en línea',
            'encontrar pareja en línea', 'conocer gente nueva', 'sitio de citas', 'relaciones en línea', 'amor en línea', 'búsqueda de pareja', 'encuentros en línea', 'solteros en línea', 'chat en línea', 'consejos de citas', 'servicio de citas', 'personas solteras', 'matchmaking', 'parejas compatibles', 'amistades en línea', 'relaciones serias', 'buscando amor',
            'citas seguras', 'citas exitosas', 'encuentros rápidos', 'citas virtuales', 'encuentros amorosos', 'citas en línea seguras', 'red social de citas', 'servicio de emparejamiento', 'parejas felices', 'encontrar amor en línea', 'personas solteras cerca de mí', 'conexiones en línea', 'encuentros románticos', 'no_putas', 'no_puta'

        ];

        $wordList = ["amistad", "turismo"];

        SEOMeta::addKeyword($wordList);

        SEOMeta::setCanonical($seo_url);

        OpenGraph::setDescription('Escorts en ' . $locacion . ' islas Canarias para encuentros. Acompañantes ' . $categoria_nombre . ' en ' . $locacion . ' en islas Canarias, no anuncios de sexo ni putas en islas Canarias');
        OpenGraph::setTitle($categoria_nombre . ' escorts, acompañantes en ' . $locacion . ' islas Canarias');

        OpenGraph::setUrl($seo_url);
        OpenGraph::addProperty('type', 'articles');

        //TwitterCard::setTitle('Escort, acompañantes en ' . $locacion . ' islas Canarias');
        // TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($categoria_nombre . ' escorts, acompañantes en ' . $locacion . ' islas Canarias');
        JsonLd::setDescription('Escorts en ' . $locacion . ' islas Canarias para encuentros. Acompañantes ' . $categoria_nombre . ' en ' . $locacion . ' en islas Canarias, no anuncios de sexo ni putas en islas Canarias');
        JsonLd::addImage(config('app.url') . '/img/logo300.png');

        $categorias = Categoria::all()->sortBy('nombre');
        $provincia  = null;
        return view('welcome', compact(
            'municipio',
            'prov_tenerife',
            'prov_laspalmas',
            'municipios',
            'categoria',
            'categorias',
            'provincia'
        ));
    }

    public function index_provincia(Provincia $provincia)
    {

        $categoria = null;
        $municipio = null;
        session()->put('provinciaSel', $provincia->id);
        session()->put('muniSelec', null);
        session()->put('categoriaSel', null);
        $categorias = Categoria::all()->sortBy('nombre');
        $municipios = $provincia->municipios_anunciados();
        $prov_laspalmas = $this->set_prov_las_palmas();

        $prov_tenerife = $this->set_prov_tenerife();
        $categoria     = $this->set_categoria();

        if($provincia->seo){
            
            SEOMeta::setTitle($provincia->seo->title);
            SEOMeta::setDescription($provincia->seo->description);
            
            $provincia->seo->keywords->map(
                fn($e) => SEOMeta::addKeyword($e->value)
            );
            
        }
        
        if(!$provincia->seo){
            $this->defino_seo($categoria, $provincia);
        }
        return view('welcome', compact(
            'prov_tenerife',
            'prov_laspalmas',
            'municipios',
            'provincia',
            'categoria',
            'categorias',
            'municipio'
        ));
    }



    public function index_provincia_municipio(Provincia $provincia, Municipio $municipio)
    {

        $categoria = null;
        session()->put('provinciaSel', $provincia->id);
        session()->put('muniSelec', $municipio->id);
        session()->put('categoriaSel', null);
        $categorias = Categoria::all()->sortBy('nombre');
        $municipios = $provincia->municipios_anunciados();

        $prov_laspalmas = $this->set_prov_las_palmas();

        $prov_tenerife = $this->set_prov_tenerife();
        $categoria = $this->set_categoria();

        if($municipio->seo){
            
            SEOMeta::setTitle($municipio->seo->title);
            
            SEOMeta::setDescription($municipio->seo->description);
            
            $municipio->seo->keywords->map(
                fn($e) => SEOMeta::addKeyword($e->value)
            );
            
            
        }
        
        if(!$municipio->seo){
            
            $this->defino_seo($categoria, $provincia);

        }


        return view('welcome', compact(
            'prov_tenerife',
            'prov_laspalmas',
            'municipios',
            'provincia',
            'categoria',
            'categorias',
            'municipio'
        ));
    }


    public function index_categoria_provincia(Provincia $provincia, Categoria $categoria)
    {

        session()->put('provinciaSel', $provincia->id);
        session()->put('muniSelec', null);
        session()->put('categoriaSel', $categoria->id);
        $municipio = null;
        $municipios = $provincia->municipios_anunciados();
        $categorias = Categoria::all()->sortBy('nombre');
        $prov_laspalmas = $this->set_prov_las_palmas();

        $prov_tenerife = $this->set_prov_tenerife();
        $categoria = $this->set_categoria();

        $this->defino_seo($categoria, $provincia);


        return view('welcome', compact(
            'prov_tenerife',
            'prov_laspalmas',
            'municipios',
            'provincia',
            'categoria',
            'categorias',
            'municipio'
        ));
    }


    public function index_categoria_municipio(Provincia $provincia, Municipio $municipio, Categoria $categoria)
    {

        session()->put('provinciaSel', $provincia->id);
        session()->put('muniSelec', $municipio->id);
        session()->put('categoriaSel', $categoria->id);
        $categorias = Categoria::all()->sortBy('nombre');
        $municipios = $provincia->municipios_anunciados();

        $prov_laspalmas = $this->set_prov_las_palmas();

        $prov_tenerife = $this->set_prov_tenerife();
        #$categoria = $this->set_categoria();

        $this->defino_seo($categoria, $provincia);


        return view('welcome', compact(
            'prov_tenerife',
            'prov_laspalmas',
            'municipios',
            'provincia',
            'categoria',
            'categorias',
            'municipio'
        ));
    }

    public function set_prov_las_palmas()
    {
        if (Cache::has('prov_laspalmas')) {
            $prov_laspalmas = Cache::get('prov_laspalmas');
        } else {
            $prov_laspalmas = Provincia::where('nombre', 'like', 'Las palmas')->first();
            Cache::put('prov_laspalmas', $prov_laspalmas, 600);
        }
        return $prov_laspalmas;
    }

    public function set_prov_tenerife()
    {
        if (Cache::has('prov_tenerife')) {
            $prov_tenerife = Cache::get('prov_tenerife');
        } else {
            $prov_tenerife = Provincia::where('nombre', 'like', 'S.C. Tenerife%')->first();
            Cache::put('prov_tenerife', $prov_tenerife, 600);
        }
        return $prov_tenerife;
    }

    public function set_categoria()
    {
        if (!is_null(session('categoriaSel'))) {
            $categoria = Categoria::find(session('categoriaSel'));
        } else {
            $categoria = null;
            session()->put('categoriaSel', 0);
        }
        return $categoria;
    }


    public function show(Provincia $provincia, Municipio $municipio, Categoria $categoria, $user_id, Anuncio $anuncio)
    {
        if ($categoria->nombre != 'Transexuales') {
            $categoria_nombre = $categoria->nombre;
            SEOMeta::addKeyword($categoria->nombre);
        } else {
            $categoria_nombre = 'Travestis';
            SEOMeta::addKeyword('Travestis');
        }

        //anuncios busco los gustos. armo un string y los sumo a las keywords
        $gustos = '';
        foreach ($anuncio->tags as $gusto) {
            $gustos .= ', ' . $gusto->nombre;
            SEOMeta::addKeyword($gusto->nombre);
        }
        $titulo = $anuncio->nombre . " " . $categoria_nombre . ' en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre . ' islas Canarias';
        $descripcion = 'Contacta con ' . $anuncio->nombre . ' ' .  $anuncio->telefono_publicacion . ' en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre . 'llámala a su teléfono ' . $anuncio->telefono_publicacion . ' y comparte con ' . $anuncio->nombre . '  ' . $anuncio->categoria->nombre . ' en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre . ' en las islas Canarias, no anuncios de sexo ni putas en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre;
        SEOMeta::setTitle($anuncio->nombre . " " . $categoria_nombre . ' en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre . ' islas Canarias');
        SEOMeta::setDescription('Contacta con ' . $anuncio->nombre .  ' en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre . 'llámala a su teléfono ' . $anuncio->telefono_publicacion . ' y comparte con ' . $anuncio->nombre . '  ' . $anuncio->categoria->nombre . ' en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre . ' en las islas Canarias, no anuncios de sexo ni putas en ' . $municipio->nombre . ' ' . $anuncio->provincia->nombre);
        # SEOMeta::setCanonical('https://guiasexcanarias.com');

        OpenGraph::setDescription($descripcion);
        OpenGraph::setTitle($titulo);
        #OpenGraph::setUrl('https://guiasexcanarias.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle($titulo);
        // TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($titulo);
        JsonLd::setDescription($descripcion);
        JsonLd::addImage(config('app.url') . '/img/logo300.png');
        // OR
        SEOMeta::addKeyword($municipio->nombre);
        SEOMeta::addKeyword($provincia->nombre);
        SEOMeta::addKeyword($provincia->texto_seo);
        SEOMeta::addKeyword($municipio->texto_seo);
        // dd(SEOMeta::addKeyword($municipio->texto_seo));
        SEOMeta::addKeyword($anuncio->edad . ' años');
        SEOMeta::addKeyword($anuncio->telefono_publicacion);
        SEOMeta::addKeyword($anuncio->profesion);
        SEOMeta::addKeyword($anuncio->titulo);
        SEOMeta::addKeyword($anuncio->nombre);
        SEOMeta::addKeyword(['escorts', 'escorts Canarias', 'acompañantes', 'españa', 'acompañantes españa', 'amistad', 'conocer gente']);

        $clase = null;
        $anuncios_oro = [];
        $anuncios_plata = [];
        $anuncios_bronce = [];
        $anuncios_normal = [];
        $anuncios_diamante = [];
        if (Cache::has('cantidad' . $anuncio->categoria_id)) {
            $cantidad = null;
        } else {
            $cantidad = null;
            Cache::put('cantidad' . $anuncio->categoria_id, $cantidad, 1200);
        }
        // dd($anuncio->mostrar());

        /* verifica que le quedan dias de acuerdo con el campo dias  */
        if($anuncio->mostrar() ){
            return redirect()->route('index_general');     
        }

        $visitas = $anuncio->visitas;
        if (is_null($visitas)) {
            $visitas = 1;
        } else {
            $visitas += 1;
        }
        $anuncio->update(['visitas' => $visitas]);
        $tags_al = $anuncio->tags->where('rubro', 'AL');
        $tags_etc = $anuncio->tags->where('rubro', 'ETC');
        $tags_ec = $anuncio->tags->where('rubro', 'EC');
        $tags_in = $anuncio->tags->where('rubro', 'In');
        
        return view('portal.show', compact('cantidad', 'tags_in', 'tags_etc', 'tags_ec', 'tags_al', 'anuncio', 'anuncios_oro', 'anuncios_plata', 'anuncios_bronce', 'anuncios_normal', 'anuncios_diamante'));
    }


    public function defino_seo(Categoria $categoria = null, Provincia $provincia)
    {
        $municipio = null;
        if (!is_null(session('muniSelec'))) {
            $municipio = Municipio::find(session('muniSelec'));
            $locacion = $municipio->nombre . ' ' . $provincia->nombre;
        } else {
            $locacion = $provincia->nombre;
        }


        if (is_null($categoria)) {
            $categoria_nombre = 'escorts';
        } else {
            if ($categoria->nombre != 'Transexuales') {
                $categoria_nombre = $categoria->nombre;
                SEOMeta::addKeyword($categoria->nombre);
            } else {
                $categoria_nombre = 'Travestis';
                SEOMeta::addKeyword('Travestis');
            }
        }


        SEOMeta::setTitle('Escorts '. $categoria_nombre .' en ' . $locacion . ' islas Canarias');
        SEOMeta::setDescription('Escorts en ' . $locacion . ' islas Canarias para encuentros. Acompañantes ' . $categoria_nombre . ' en ' . $locacion . ' en las islas Canarias, no anuncios de sexo ni putas en las islas Canarias');
        $seo_url = url('/');

        if (!is_null($provincia->slug)) {

            $seo_url = $seo_url . '/escort/' . $provincia->slug;
            #provincia no es nulo veo si  muni
            if (!is_null($municipio)) {
                #agrego municipio
                $seo_url = $seo_url . '/' . $municipio->slug;
                #provincia no es nulo veo si  muni
                if (!is_null($categoria)) {
                    #agrego categoria
                    $seo_url = $seo_url . '/' . $categoria->slug;
                    #provincia no es nulo veo si  muni
                }

            }else{
                #no hay municipiio pero categoria?
                if (!is_null($categoria)) {
                    #agrego categoria
                    $seo_url = $seo_url . '/todos/' . $categoria->slug;
                    #provincia no es nulo veo si  muni
                }
            }

        }

        $wordList = [
            'guiasexcanarias', 'exclusiva', 'exclusivas canarias', 'canarias exclusivas', 'españa
            exclusivas', 'guia sex canarias', 'giasex canarias', 'chicos', 'excluivas españa', 'escort', 'escort españa',
            'canarias', 'masajistas', 'masajes canarias', 'masajes españa', 'acompañantes', 'españa', 'travestis',
            'acompañantes españa', 'acompañantes canarias', 'amistad', 'conocer gente', 'citas en línea',
            'encontrar pareja en línea', 'conocer gente nueva', 'sitio de citas', 'relaciones en línea', 'amor en línea',
            'busqueda de pareja', 'encuentros en linea', 'solteros en linea', 'chat en linea', 'consejos de citas',
            'servicio de citas', 'personas solteras', 'matchmaking', 'parejas compatibles', 'amistades en linea', 
            'relaciones serias','buscando amor','citas seguras', 'citas exitosas', 'encuentros rápidos', 'citas virtuales', 
            'encuentros amorosos', 'citas en lineaseguras', 'red social de citas', 'servicio de emparejamiento', 
            'parejas felices', 'encontrar amor en linea','personas solteras cerca de mi', 'conexiones en linea', 
            'encuentros románticos', 'no_putas'

        ];

        $wordList = ['amor', 'turismo', 'novia'];

        SEOMeta::addKeyword($wordList);

        SEOMeta::setCanonical($seo_url);

        OpenGraph::setDescription('Escorts en ' . $locacion . ' islas Canarias para encuentros. Acompañantes ' .
            $categoria_nombre .
            ' en ' . $locacion . ' en las islas Canarias, no anuncios de sexo ni putas en las islas Canarias');
            
            OpenGraph::setTitle($categoria_nombre . ' escorts, acompañantes en ' . $locacion . ' islas Canarias');


            if($categoria_nombre == "escorts"){
                OpenGraph::setTitle($categoria_nombre . ', acompañantes en ' . $locacion . ' islas Canarias');
            }

        OpenGraph::setUrl($seo_url);
        OpenGraph::addProperty('type', 'articles');

        //TwitterCard::setTitle('Escort, acompañantes en ' . $locacion . ' España');
        // TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle($categoria_nombre . ' escorts, acompañantes en ' . $locacion . ' islas Canarias');
        JsonLd::setDescription('Escorts en ' . $locacion . ' islas Canarias para encuentros. Acompañantes ' . $categoria_nombre .
            '
        en ' . $locacion . ' en islas Canarias, no anuncios de sexo ni putas en islas Canarias');
        JsonLd::addImage(config('app.url') . '/img/logo300.png');
    }
}
