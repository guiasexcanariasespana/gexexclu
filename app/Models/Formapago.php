<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Formapago
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Formapago extends Model
{
  use SoftDeletes;
  public function getRouteKeyName()
  {
    return 'slug';
  }

    static $rules = [
    'nombre' => 'required|unique:formapagos,nombre,NULL,id,deleted_at,NULL',
    'slug' => 'required|unique:formapagos,slug,NULL,id,deleted_at,NULL',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug'];



}
