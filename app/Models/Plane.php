<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plane
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $dias
 * @property $created_at
 * @property $updated_at
 * @property $categoria_id
 *
 * @property Categoria $categoria
 * @property Precio[] $precios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Plane extends Model
{
    use SoftDeletes;
       
    static $rules = [
        'nombre' => 'required|unique:planes,nombre,NULL,id,deleted_at,NULL',
        'slug' => 'required|unique:planes,slug,NULL,id,deleted_at,NULL',
		'dias' => 'required',
		'categoria_id' => 'required',
    ];
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug','dias','categoria_id', 'clase_id', 'precio', 'interno'];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function precios()
    {
        return $this->hasMany('App\Models\Precio', 'plan_id', 'id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clase()
    {
        return $this->hasOne('App\Models\Clase', 'id', 'clase_id');
    }
    
    

    public function precio_zona($zone_id){
        $precio= $this->precios()->where('zone_id', '=' , $zone_id )->first();
        return $precio;
    }


}
