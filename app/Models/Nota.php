<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Nota
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Nota extends Model
{

    use SoftDeletes;

    static $rules = [
        // 'user_id' => 'required',
        // 'anuncio_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'anuncio_id', 'nota', 'titulo', 'estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function anuncio()
    {
        return $this->hasOne('App\Models\Anuncio', 'id', 'anuncio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
