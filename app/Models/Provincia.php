<?php

namespace App\Models;

use App\Models\Seo\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Provincia
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property Municipio[] $municipios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Provincia extends Model
{
    use SoftDeletes;

  public function getRouteKeyName()
  {
    return 'slug';
  }

    static $rules = [
    'nombre' => 'required|unique:provincias,nombre,NULL,id,deleted_at,NULL',
    'slug' => 'required|unique:provincias,slug,NULL,id,deleted_at,NULL',
    ];

    protected $perPage = 25;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug', 'texto_seo', 'state_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany('App\Models\Municipio', 'provincia_id', 'id');
    }

  public function state()
  {
    return $this->hasOne('App\Models\State', 'id', 'state_id');
  }

  public function municipios_anunciados()
  {
    // $municipios = Municipio::->get();
    $municipios = Municipio::selectRaw('municipios.* , count(anuncios.id) as cant_anun')
    ->join('anuncios', 'municipios.id', '=', 'anuncios.municipio_id')
    ->where('municipios.provincia_id', $this->id)
    ->where('anuncios.verificacion', '=', 'Si')
    ->where('anuncios.estado', 'Publicado')
    ->groupBy('municipios.id', 'municipios.nombre', 'municipios.slug', 'municipios.provincia_id', 'municipios.created_at', 'municipios.updated_at', 'municipios.deleted_at')
    ->orderByRaw('cant_anun desc')
    ->get();

    return $municipios;
  }

  public static function buscar_nombre($nombre){
    $provincia=Provincia::where('nombre', 'like', '%' . $nombre . '%')->first();
    return $provincia;

  }

  public function seo() : MorphOne {

    return $this->morphOne(Content::class, 'contentable');

}


}
