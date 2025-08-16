<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class State
 *
 * @property $id
 * @property $name
 * @property $slug
 * @property $created_at
 * @property $updated_at
 *
 * @property Zone[] $zones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class State extends Model
{
    use SoftDeletes;
    static $rules = [
		'name' => 'required',
		'slug' => 'required',
    ];


  public function getRouteKeyName()
  {
    return 'slug';
  }

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','slug'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provincias()
    {
        return $this->hasMany('App\Models\Provincia', 'state_id', 'id');
    }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  // Relacion uno a muchos
  public function precios()
  {
    return $this->hasMany(Precio::class);
  }

}
