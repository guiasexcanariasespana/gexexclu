<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Clase
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
class Clase extends Model
{

  use SoftDeletes;
    
    static $rules = [
    'nombre' => 'required|unique:clases,nombre,NULL,id,deleted_at,NULL',
    'slug' => 'required|unique:clases,slug,NULL,id,deleted_at,NULL',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug', 'color'];

  public function getRouteKeyName()
  {
    return 'slug';
  }


}
