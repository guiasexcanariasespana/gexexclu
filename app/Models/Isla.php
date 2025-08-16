<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isla extends Model
{
    use HasFactory;
    //

    // static $rules = [
    //     'nombre' => 'required|unique:clases,nombre,NULL,id,deleted_at,NULL',
    //     'slug' => 'required|unique:clases,slug,NULL,id,deleted_at,NULL',
    // ];

    // protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'slug', 'state_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function municipios()
    {
        return $this->hasMany('App\Models\Municipio', 'isla_id', 'id');
    }

    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }





}
