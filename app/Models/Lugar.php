<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lugar
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
class Lugar extends Model
{

  use SoftDeletes;

  public function getRouteKeyName()
  {
    return 'slug';
  }
  
    static $rules = [
    'nombre' => 'required|unique:lugars,nombre,NULL,id,deleted_at,NULL',
    'slug' => 'required|unique:lugars,slug,NULL,id,deleted_at,NULL',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug'];



}
