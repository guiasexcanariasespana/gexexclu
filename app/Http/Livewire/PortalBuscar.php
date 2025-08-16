<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Categoria;
use App\Models\Clase;
use App\Models\Anuncio;
use App\Models\Isla;
use App\Models\Provincia;
use App\Models\Municipio;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Cache;

class PortalBuscar extends Component
{
    public $search = '';
    public $categoriaSeleted;
    public $provincia_id;
    public $municipio_id;
    public $state_id;
    public $provincias;
    public $municipios;
    public $color_oro;


    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }
    // protected $listeners = ['cambio_categoria' => 'change_categoria',
    //                     'searching' => 'updatingSearch',
    //     'selecciono_provincia'=>'updatingProvinciaId' ,
    //     'selecciono_muni'=> 'updatingMunicipioId'];

    protected $listeners = [
        'cambio_categoria' => 'render',
        'searching' => 'render',
        'selecciono_provincia' => 'render',
        'selecciono_muni' => 'render',
        'lanzar_busqueda' => 'render',
        'cambio_isla'  => 'render',
        'cambio_muni'  => 'render',


    ];


    // protected $queryString = ['search'];


    public function mount()
    {

        // SEOTools::setTitle('Home');
        // SEOTools::setDescription('This is my page description');
        // SEOTools::opengraph()->setUrl('http://current.url.com');
        // SEOTools::setCanonical('https://codecasts.com.br/lesson');
        // SEOTools::opengraph()->addProperty('type', 'articles');
        // // SEOTools::twitter()->setSite('@LuizVinicius73');
        // SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');
    }






    public function render()
    {
        $clase_color = Clase::where('nombre', 'ORO')->first();
        $this->color_oro = $clase_color->color;

        if (!is_null(session('categoriaSel'))) {
            $this->categoriaSeleted = session('categoriaSel');
        }

        $categorias = Categoria::all()->sortBy('nombre');
        if (is_null($this->categoriaSeleted)) {
            $categoria = null;
            $this->categoriaSeleted = 0;
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



        if (!is_null(session('provinciaSel'))) {
            $this->provincia_id = session('provinciaSel');
            $this->municipios = Municipio::where('provincia_id', '=', $this->provincia_id)->orderBy('nombre')->get();
        } else {
            $this->provincia_id = null;
            $this->municipios = [];
        }

        if (!is_null(session('muniSelec'))) {
            $this->municipio_id = session('muniSelec');
        } else {
            $this->municipio_id = null;
        }


        if (!is_null(session('search'))) {
            $this->search = session('search');
        }

        //$clase = Clase::where('nombre', 'ORO')->first();
        if (is_null($this->categoriaSeleted)) {
            $anuncios_oro = [];
        } else {
            $clase = 'ORO';
            $anuncios_oro = $this->buscar_anuncios($this->categoriaSeleted, $clase);
        }


        //$clase = Clase::where('nombre', 'PLATA')->first();
        if (is_null($this->categoriaSeleted)) {

            $anuncios_plata = [];
        } else {
            $clase = 'PLATA';
            $anuncios_plata = $this->buscar_anuncios($this->categoriaSeleted, $clase);
        }


        //$clase = Clase::where('nombre', 'BRONCE')->first();
        if (is_null($this->categoriaSeleted)) {

            $anuncios_bronce = [];
        } else {
            $clase = 'BRONCE';
            $anuncios_bronce = $this->buscar_anuncios($this->categoriaSeleted, $clase);
        }


        //$clase = Clase::where('nombre', 'NORMAL')->first();
        if (is_null($this->categoriaSeleted)) {
            $anuncios_normal = [];
        } else {
            $clase = 'NORMAL';
            $anuncios_normal = $this->buscar_anuncios($this->categoriaSeleted, $clase);
        }


        //$clase = Clase::where('nombre', 'DIAMANTE')->first();
        if (is_null($this->categoriaSeleted)) {
            $anuncios_diamante = [];
        } else {
            $clase = 'DIAMANTE';
            $anuncios_diamante = $this->buscar_anuncios($this->categoriaSeleted, $clase);
        }

        if (is_null($this->categoriaSeleted)) {
        $anuncios_doble = [];
        } else {

        $anuncios_doble = $this->buscar_anuncios_dobles($this->categoriaSeleted);
        }
        if (is_null(session('categoriaSel'))) {
            $categoria = null;
            $categorianombre = 'escort-masajes-trans';
        } else {
            if(session('categoriaSel') == 0){
                $categoria = null;
                $categorianombre = 'escort-masajes-trans';
            }else{
                $categoria = Categoria::find(session('categoriaSel'));
                $categorianombre = $categoria->nombre;
            }
        }

        if (!is_null(session('provinciaSel'))) {
            $provincia = Provincia::find(session('provinciaSel'));
            $locacion = $provincia->nombre;
        }else {
            $provincia = null;
            $locacion = null;
        }

        if (!is_null(session('muniSelec'))) {
            $municipio = Municipio::find(session('muniSelec'));
            $locacion = $municipio->nombre . ' ' . $provincia->nombre;
        } else {
            $municipio = null;

        }


        // //Sumo los destacados
        // //Oro y diamante
        // $cantidad_anuncios_destacados = count($anuncios_diamante) + count($anuncios_oro);
        // $modulo = $cantidad_anuncios_destacados % 6;
        // if ($modulo > 0 && ($this->search == "")){
        //     //debo buscar para completar
        //     $buscar = 6 - $modulo;
        //     $anuncios_destacados_complemento = $this->buscar_anuncios_complemento($this->categoriaSeleted, 'Si', $buscar);
        // }else{
        //     $anuncios_destacados_complemento = [];
        // }


        



        return view('livewire.portal-buscar', compact('prov_laspalmas', 'prov_tenerife', 'categoria', 'municipio',
        'provincia',
        'categorias', 'anuncios_oro', 'anuncios_plata', 'anuncios_bronce', 'anuncios_normal', 'anuncios_diamante', 'anuncios_doble'));
    }


    public function updatingSearch($search)
    {
        $this->search = $search;
    }

    public function updatingCategoriaSeleted($categoriaSeleted)
    {
        $this->categoriaSeleted = $categoriaSeleted;
    }

    public function updatingProvinciaId($provincia_id)
    {
        $this->provincia_id = $provincia_id;
    }


    public function updatingMunicipioId($municipio_id)
    {
        $this->municipio_id = $municipio_id;
    }


    public function change_categoria($categoriaSeleted)
    {
        $this->categoriaSeleted = $categoriaSeleted;
    }



    protected function buscar_anuncios($categoria_id, $clase)
    {

        if($categoria_id == "0"){
         $anuncios =  $this->buscar_anuncios_todos($clase);
        }else{
          $anuncios = $this->buscar_anuncios_categoria($categoria_id, $clase);
        }
        return $anuncios;
    }

    protected function buscar_anuncios_dobles($categoria_id)
    {
        //if($categoria_id == "0"){
        $anuncios = $this->buscar_anuncios_dobles_todos($categoria_id);
        // }else{
        // $anuncios = $this->buscar_anuncios_categoria($categoria_id, $clase);
        // }
        return $anuncios;
    }

    protected function buscar_anuncios_categoria($categoria_id, $clase){
            if (is_null($this->municipio_id)) {
            // No hay municipio solo filtro por provincia            
            $anuncios = Anuncio::select('anuncios.*')
            ->Join('clases','clases.id', '=', 'anuncios.clase_id')
            ->where('clases.nombre', $clase)
            ->where('anuncios.tipo', '<>', 'Doble')
            ->where('anuncios.verificacion', '=', 'Si')
            ->where('anuncios.estado', 'Publicado')
            ->where('categoria_id', $categoria_id)
            ->where(
            function ($query) {
            $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.telefono_publicacion', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
            }
                );
                if(!is_null($this->provincia_id)){
                     $anuncios = $anuncios->Where('anuncios.provincia_id', $this->provincia_id);
                }
                $anuncios =  $anuncios->orderByRaw("RAND()")->get();
            $municipio_ids = Municipio::where('provincia_id', $this->provincia_id)->pluck('id');
            } else {
            $anuncios = Anuncio::select('anuncios.*')
            ->Join('clases', 'clases.id', '=', 'anuncios.clase_id')
            ->where('clases.nombre', $clase)
            ->where('anuncios.verificacion', '=', 'Si')
            ->where('anuncios.estado', 'Publicado')
            ->where('anuncios.tipo', '<>', 'Doble')
            ->Where('anuncios.municipio_id', $this->municipio_id)
            ->where('categoria_id', $categoria_id)
            ->where(
            function ($query) {
            $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.telefono_publicacion', 'like', '%' . $this->search . '%')
            ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
            }
            )->orderByRaw("RAND()")->get();
        }



            return $anuncios;
    }

    protected function buscar_anuncios_todos($clase){
    if (is_null($this->municipio_id)) {
        // No hay municipio solo filtro por provincia
        $anuncios = Anuncio::select('anuncios.*')
        ->Join('clases','clases.id', '=', 'anuncios.clase_id')
        ->where('clases.nombre', $clase)
        ->where('anuncios.verificacion', '=', 'Si')
        ->where('anuncios.tipo', '<>', 'Doble')
        ->where('anuncios.estado', 'Publicado')
        ->where(
        function ($query) {
        $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.telefono_publicacion', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
        });
        if(!is_null($this->provincia_id)){
        $anuncios = $anuncios->Where('anuncios.provincia_id', $this->provincia_id);
        }
        $anuncios = $anuncios->orderByRaw("RAND()")->get();

        $municipio_ids = Municipio::where('provincia_id', $this->provincia_id)->pluck('id');
    } else {
        $anuncios = Anuncio::select('anuncios.*')
            ->Join('clases', 'clases.id', '=', 'anuncios.clase_id')
            ->where('clases.nombre', $clase)
            ->where('anuncios.verificacion', '=', 'Si')
            ->where('anuncios.estado', 'Publicado')
            ->Where('anuncios.municipio_id', $this->municipio_id)->where(
            function ($query) {
                $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
                ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
                ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
                ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
                ->orWhere('anuncios.telefono_publicacion', 'like', '%' . $this->search . '%')
                ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
            }
        )->orderByRaw("RAND()")->get();
    }

    return $anuncios;
    }


    protected function buscar_anuncios_dobles_todos($categoria_id){
    if (is_null($this->municipio_id)) {
    // No hay municipio solo filtro por provincia
    $anuncios = Anuncio::select('anuncios.*')
    ->Join('clases','clases.id', '=', 'anuncios.clase_id')
    ->where('anuncios.verificacion', '=', 'Si')
    ->where('anuncios.estado', 'Publicado')
    ->where('anuncios.tipo', 'Doble')
    ->where(
    function ($query) {
    $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
    ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
    ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
    ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
    ->orWhere('anuncios.telefono_publicacion', 'like', '%' . $this->search . '%')
    ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
    }
    );
    if($categoria_id != 0){
        $anuncios = $anuncios->where('categoria_id', $categoria_id);
    }
    if(!is_null($this->provincia_id)){
        $anuncios = $anuncios->Where('anuncios.provincia_id', $this->provincia_id);
    }
    $anuncios = $anuncios->orderByRaw("RAND()")->get();
    $municipio_ids = Municipio::where('provincia_id', $this->provincia_id)->pluck('id');
    } else {
    $anuncios = Anuncio::select('anuncios.*')
    ->Join('clases', 'clases.id', '=', 'anuncios.clase_id')
    ->where('anuncios.verificacion', '=', 'Si')
    ->where('anuncios.estado', 'Publicado')
    ->where('anuncios.tipo', 'Doble')
    ->Where('anuncios.municipio_id', $this->municipio_id)
    ->where(
        function ($query) {
        $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.telefono_publicacion', 'like', '%' . $this->search . '%')
        ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
        }
        );
        if($categoria_id != 0){
        $anuncios = $anuncios->where('categoria_id', $categoria_id);
        }
        $anuncios = $anuncios->orderByRaw("RAND()")->get();
    }



    return $anuncios;
    }

    protected function buscar_anuncios_complemento($categoria_id, $destacados, $cantidad)
    {
        if($destacados == 'Si'){
           $clase = ['DIAMANTE', 'ORO'];
        }else{
            $clase = ['BRONCE', 'NORMAL', 'PLATA'];
        }
        if (is_null($this->municipio_id)) {
            // No hay municipio solo filtro por provincia
            $anuncios = Anuncio::select('anuncios.*')
            ->Join('clases', 'clases.id', '=', 'anuncios.clase_id')
            ->whereIn('clases.nombre', $clase)
                ->where('anuncios.verificacion', '=', 'Si')
                ->where('anuncios.estado', 'Publicado')
                ->Where('anuncios.provincia_id', $this->provincia_id)
                ->where('anuncios.categoria_id', $categoria_id)->where(
                    function ($query) {
                        $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.presentacion', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
                    }
                )->orderByRaw("RAND()")->take($cantidad)->get();
            $municipio_ids = Municipio::where('provincia_id', $this->provincia_id)->pluck('id');
        } else {
            $anuncios = Anuncio::select('anuncios.*')
            ->Join('clases', 'clases.id', '=', 'anuncios.clase_id')
            ->whereIn('clases.nombre', $clase)
                ->where('anuncios.verificacion', '=', 'Si')
                ->where('anuncios.estado', 'Publicado')
                ->Where('anuncios.provincia_id', $this->provincia_id)
                ->Where('anuncios.municipio_id', '<>',$this->municipio_id)
                ->where('anuncios.categoria_id', $categoria_id)->where(
                    function ($query) {
                        $query->where('anuncios.nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.titulo', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.nacionalidad', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.profesion', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.presentacion', 'like', '%' . $this->search . '%')
                        ->orWhere('anuncios.edad', 'like', '%' . $this->search . '%');
                    }
                )->orderByRaw("RAND()")->take($cantidad)->get();
        }



        return $anuncios;

    }





}
