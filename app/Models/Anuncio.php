<?php

namespace App\Models;
use Illuminate\Support\Str; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Anuncio
 *
 * @property $id
 * @property $usuario
 * @property $nombre
 * @property $Slug
 * @property $presentacion
 * @property $tipo
 * @property $orientacion
 * @property $telefono
 * @property $whatsapp
 * @property $categoria_id
 * @property $clase_id
 * @property $state_id
 * @property $zone_id
 * @property $localidad
 * @property $plan_id
 * @property $fecha_nacimiento
 * @property $edad
 * @property $nacionalidad
 * @property $profesion
 * @property $gps
 * @property $ip_address
 * @property $port
 * @property $estado
 * @property $destacado
 * @property $verificacion
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Clase $clase
 * @property Plane $plane
 * @property State $state
 * @property Zone $zone
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Anuncio extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($anuncio) {
            $slugBase = Str::slug($anuncio->nombre);
            $telefono = preg_replace('/[^0-9]/', '', $anuncio->telefono_publicacion); // Limpia el teléfono (solo números)
            $anuncio->slug = $slugBase . '-' . $telefono; 
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    // static $rules = [

    // ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'nombre', 'slug', 'presentacion', 'tipo', 'orientacion', 'telefono',
        'whatsapp', 'categoria_id', 'clase_id', 'state_id', 'zone_id', 'localidad', 'plane_id', 'precio',
        'fecha_nacimiento', 'edad', 'nacionalidad', 'profesion', 'gps', 'ip_address', 'port', 'estado',
        'destacado', 'verificacion', 'fecha_pausa', 'fecha_de_publicacion', 'dias', 'fecha_caducidad',
        'portada_id', 'titulo', 'provincia_id', 'orientacion_otra', 'municipio_id', 'estado_pago', 'visitas',
        'video', 'mostrar_telefono', 'tarifa', 'mayor_edad', 'estado_video', 'telefono_publicacion',
        'treinta_minutos', 'cuarenta_y_cinco_minutos', 'una_hora', 'medio_dia', 'todo_el_dia', 'fin_de_semana',
        'hora_desplazamiento', 'horario', 'presentacion_aux', 'mostrar_en_redes', 'imagen_verificacion',
        'dobleportada_id','imagen_slider'
    ];

    // Relacion muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function pagos()
    {
        return $this->hasMany('App\Models\Pago', 'anuncio_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clase()
    {
        return $this->hasOne('App\Models\Clase', 'id', 'clase_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plane()
    {
        return $this->hasOne('App\Models\Plane', 'id', 'plane_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }


    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }


    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zone()
    {
        return $this->hasOne('App\Models\Zone', 'id', 'zone_id');
    }

    // Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function portada()
    {
        return $this->belongsTo(Imagen::class);
    }

    public function dobleportada()
    {
    return $this->belongsTo(Imagen::class);
    }

    /*
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagens()
    {
        return $this->hasMany('App\Models\Imagen', 'anuncio_id', 'id');
    }

    public function imagenes_verificadas()
    {
        $tiene = $this->imagens()->where('estado', '=', 'Verificada')->get();
        return $tiene;
    }

    public function imagenes_no_verificadas()
    {
        return $this->imagens()->where('estado', '!=', 'Verificada')->orderBy('position')->get();
    }

    public function cantidad_imagenes_subidas()
    {
        return $this->imagens()->count();
    }

    public function imagenes_pendientes()
    {
        $tiene = $this->imagens()->whereIn('estado', ['Pendiente', 'Verificada'])->get();
        if (count($tiene)) {
            //hay imagenes cuento cuantas y las resto
            // a las indicadas como max_images en .env
            $pendientes = config('app.max_images') - count($tiene);
        } else {
            //No hay cargadas
            //devuelvo el maximo
            $pendientes = config('app.max_images');
        }
        return $pendientes;
    }


    public function cantidad_img_verificar()
    {
        $tiene = $this->imagens()->where('estado', '=', 'Pendiente')->get();
        return count($tiene);
    }


    public function imagenes_verificar()
    {
        return $this->imagens()->where('estado', '=', 'Pendiente')->get();
    }

    public function dias_transcurridos()
    {
        if (is_null($this->fecha_pausa)) {
            $fecha = Carbon::now();
            
        } else {
            $fecha = Carbon::parse($this->fecha_pausa);
          // $fecha->addDays(1);
        }
        $fecha->addDays(1);
        $fecha_inicio = Carbon::parse($this->fecha_de_publicacion);
        $diasDiferencia = $fecha_inicio->diffInDays($fecha) ;       
        return $diasDiferencia;
        
    }

    public function dias_restantes()
    {
        $dias_usados = $this->dias_transcurridos();

        return $this->dias - $dias_usados;
    }

    public function saldo_a_favor()
    {
        //precio_dia = Precio / dias
        $precio_dia = $this->precio / $this->dias;

        $dias_usados = $this->dias_transcurridos();

        return $this->dias_restantes() * $precio_dia;
    }

    public function dias_pausado()
    {
        $fecha = Carbon::now();
        $fecha_pausa = Carbon::parse($this->fecha_pausa);
        $hora_actual = $fecha_pausa->format('H');
        $dias_pausado = $fecha_pausa->diffInDays($fecha);
        if ($hora_actual > config('app.hora_agregar_dia')) {
            $dias_pausado =  $dias_pausado - 1;
        }
        return $dias_pausado;
    }

    public function fecha_finalizacion($fecha, $dias)
    {
        $fecha_publi = Carbon::parse($fecha);
        #obtengo la hora para saber si sumo un día mas a la fecha de publicacion
        $fecha_fin = $fecha_publi->addDays($dias);

        return $fecha_fin;
    }


    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public static function vence_en($fecha)
    {
        if (!is_null($fecha)) {
            //$fecha_format = $fecha->format('Y-m-d');  
            $anuncios = Anuncio::where('estado', '=', 'Publicado')
                ->where('fecha_caducidad', '=', $fecha)->get();
            return $anuncios;
        }
    }

    public static function vence_en_15()
    {
        $date = Carbon::now()->addDays(15);
        #busco los anuncios a vencer en esa fecha
        return $anuncios = Anuncio::vence_en($date->format('Y-m-d'));
    }

    public static function finalizaron()
    {
        $fechaAyer = Carbon::yesterday(); // Obtiene la fecha de ayer con formato YYYY-MM-DD
    
        $anuncios = Anuncio::where('estado', '=', 'Publicado')
            ->whereDate('fecha_caducidad', '<=', $fechaAyer) // Solo los que caducaron ayer
            ->get();
    
        return $anuncios;
    }
    

    public function mayor_orden()
    {
        return  $this->imagens->max('position');
    }

    public function imagenes_ordenadas()
    {
        return  $this->imagens()->orderBy('position');
    }

    public function imagenes_verificadas_ordenadas()
    {
        return   $this->imagens()->where('estado', '=', 'Verificada')->orderBy('position');
    }

    public function imagen_posicion($posicion)
    {
        return  $this->imagens()->whereIn('estado', ['Pendiente', 'Verificada'])
            ->where('position', '=', $posicion)->first();
    }


    public static function a_verificar()
    {
        $anuncios = Anuncio::where('verificacion', '=', 'Pendiente')
            ->where('estado', 'A_Publicar')->get();
        return $anuncios;
    }

    public function se_puede_republicar()
    {
        $puede = ($this->user->puede_comprar()) and (($this->estado == 'Finalizado') || ($this->estado_pago == 'No'));

        return $puede;
    }

    public function se_puede_editar()
    {
        $puede = ((($this->estado == 'Borrador') ||  ($this->estado == 'Publicado') || ($this->estado == 'Pausado') || ($this->estado == 'Suspendido')) );

        return $puede;
    }


    public function se_puede_extender()
    {
        $puede = (($this->estado == 'Publicado') || ($this->estado_pago == 'Pausado'));

        return $puede;
    }

    public function marcar_portada()
    {
        $primera_img = $this->imagens()->orderBy('position')->first();
        $cambio = 'No';
        if (($this->portada_id != $primera_img->id) && ($primera_img->portada == 'No') ) {
            $cambio = 'Si';
            $primera_img->update(['portada' => 'Si']);
        }
        $demas_img = $this->imagens()->where('id', '!=', $primera_img->id)->get();
        foreach ($demas_img as $img) {
            $img->update(['portada' => 'No']);
        }
        return $cambio;
    }

    #########################################################
    ####Metodos para los anuncios
    public static function anuncios_clase_categoria($clase_id, $categoria_id)
    {
        $anuncios = Anuncio::where('verificacion', '=', 'Si')
            ->where('estado', 'Publicado')
            ->where('categoria_id', $categoria_id)
            ->where('clase_id', $clase_id)
            ->orderByRaw("RAND()")->get();
        return $anuncios;
    }

    public static function anuncios_clase($clase_id)
    {
        $anuncios = Anuncio::where('verificacion', '=', 'Si')
            ->where('estado', 'Publicado')
            ->where('clase_id', $clase_id)
            ->orderByRaw("RAND()")->get()->get();
        return $anuncios;
    }

    public static function anuncios_categoria($categoria_id)
    {
        $anuncios = Anuncio::where('verificacion', '=', 'Si')
            ->where('estado', 'Publicado')
            ->where('categoria_id', $categoria_id)
            ->orderByRaw("RAND()")->get();
        return $anuncios;
    }

    public function relacionados()
    {
        $anuncios = Anuncio::where('verificacion', '=', 'Si')
            ->where('estado', 'Publicado')
            ->where('id', '!=', $this->id)
            ->where('categoria_id', $this->categoria_id)
            ->where('clase_id', $this->clase_id)
            ->where('municipio_id', $this->municipio_id)
            ->orderByRaw("RAND()")->limit(4)->get();
        return $anuncios;
    }


    public static function cantidad_anuncios($categoria_id)
    {
        $anuncios = Clase::selectRaw("COUNT(CASE WHEN clases.nombre = 'ORO' THEN 1 ELSE NULL END) AS 'oro',
                    COUNT(CASE WHEN clases.nombre = 'PLATA' THEN 1 ELSE NULL END) AS 'plata',
                    COUNT(CASE WHEN clases.nombre = 'BRONCE' THEN 1 ELSE NULL END) AS 'bronce',
                    COUNT(CASE WHEN clases.nombre = 'DIAMANTE' THEN 1 ELSE NULL END) AS 'diamante',
                    COUNT(CASE WHEN clases.nombre = 'NORMAL' THEN 1 ELSE NULL END) AS 'normal'")
            ->join('anuncios', 'clases.id', '=', 'anuncios.clase_id')
            ->where('anuncios.verificacion', '=', 'Si')
            ->where('anuncios.estado', 'Publicado')
            ->where('anuncios.categoria_id', $categoria_id)->first();
        return $anuncios;
    }


    // public static function ultimas_publicaciones()
    // {
    //     $anuncios = Anuncio::where('verificacion', '=', 'Si')
    //         ->where('estado', 'Publicado')            
    //         ->where('municipio_id', $this->municipio_id)
    //         ->orderByRaw("RAND()")->limit(5)->get();
    //     return $anuncios;
    // }

    public function scopeActive($query){
        return $query
            ->where('estado', 'Publicado')
            // ->where('fecha_caducidad', '>=' , Carbon::today()->format('Y-m-d'))
            ->whereRaw('fecha_caducidad >= CURDATE()')
            ;
    }

    public function scopeSlider($query){
        return $query
            ->whereNotNull('imagen_slider')
            ->whereIn('clase_id', [
                7,11
            ]);
    }

    public function miDoble(){
        
        return $this->imagens
            ->where('id', $this->dobleportada_id )
            ->first();
    }

    public function mySlider(){
        
        return $this->imagens
            ->where('id', $this->imagen_slider )
            ->first();
    }

    public function mostrar(){
        
        $today = Carbon::now();
        
        $caduca = Carbon::parse($this->fecha_caducidad);
        
        $dias = $today->diffInDays($caduca, false);

        if ($dias >= 0) {
            
            return false;

        }

        return true;
    }

    public function scopeVenceEn($query, $dias){
        return $query
            ->whereRaw(
                'DATEDIFF(NOW(), fecha_caducidad) = ?' , $dias)
            ;
    }






}
