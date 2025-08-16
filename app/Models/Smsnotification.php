<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Smsnotification
 *
 * @property $id
 * @property $user_id
 * @property $anuncio_id
 * @property $telefono
 * @property $mensaje
 * @property $respuesta
 * @property $sms_id
 * @property $error_id
 * @property $error_msg
 * @property $created_at
 * @property $updated_at
 *
 * @property Anuncio $anuncio
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Smsnotification extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','anuncio_id','telefono','mensaje','respuesta','sms_id','error_id','error_msg'];


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
