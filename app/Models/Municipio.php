<?php

namespace App\Models;

use App\Models\Seo\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Municipio
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $provincia_id
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property Provincia $provincia
 * @property Zone[] $zones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model
{
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    static $rules = [
        'nombre' => 'required|unique:municipios,nombre,NULL,id,deleted_at,NULL',
        'slug' => 'required|unique:municipios,slug,NULL,id,deleted_at,NULL',
        'provincia_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug','provincia_id', 'texto_seo', 'isla_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function provincia()
    {
        return $this->hasOne('App\Models\Provincia', 'id', 'provincia_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zones()
    {
        return $this->hasMany('App\Models\Zone', 'municipio_id', 'id');
    }


    public function isla()
    {
        return $this->hasOne('App\Models\Isla', 'id', 'isla_id');
    }

    public function seo() : MorphOne {

        return $this->morphOne(Content::class, 'contentable');

    }
    

}
