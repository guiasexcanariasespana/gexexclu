<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categoria
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
  use SoftDeletes;

    static $rules = [
    'nombre' => 'required|unique:categorias,nombre,NULL,id,deleted_at,NULL',
    'slug' => 'required|unique:categorias,slug,NULL,id,deleted_at,NULL',
    ];


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug', 'texto_seo'];

  public function getRouteKeyName()
  {
    return "slug";
  }

  public function anuncios()
  {
    return $this->hasMany(Anuncio::class);
  }

  public function cantidad_anuncios_provincia($provincia_id)
  {
    return $this->anuncios->where('provincia_id', $provincia_id)
                          ->where('estado', 'Publicado')->count();
  }

  public function cantidad_anuncios_municipio($municipio_id)
  {
    return $this->anuncios->where('municipio_id', $municipio_id)
                          ->where('estado', 'Publicado')->count();
  }
  public static function buscar_nombre($nombre){
    $categoria=Categoria::where('nombre', 'like', '%' . $nombre . '%')->first();
    return $categoria;

  }

}
