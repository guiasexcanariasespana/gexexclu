<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Zone
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $created_at
 * @property $updated_at
 * @property $state_id
 *
 * @property State $state
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Zone extends Model
{

  use SoftDeletes;
  
  // public function getRouteKeyName()
  // {
  //   return 'slug';
  // }

  static $rules = [
    'nombre' => 'required|unique:zones,nombre,NULL,id,deleted_at,NULL',
    'slug' => 'required|unique:zones,slug,NULL,id,deleted_at,NULL',
    'municipio_id' =>'required'
    #'state_id' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['nombre', 'slug', 'municipio_id', 'provincia_id'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function municipio()
  {
    return $this->belongsTo(Municipio::class);
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  // Relacion uno a muchos
  public function precios()
  {
    return $this->hasMany(Precio::class);
  }


  public function planes_ids(){
    $planes = Precio::select('plan_id')
                      ->where('zone_id', '=', $this->id)
                      ->whereOr('state_id', '=', $this->state_id )
                      ->distinct()->pluck('plan_id');
    
                      return $planes;
  }



}
