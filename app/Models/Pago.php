<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 *
 * @property $id
 * @property $user_id
 * @property $mail_pago
 * @property $anuncio_id
 * @property $moneda_precio
 * @property $precio
 * @property $moneda_pago
 * @property $monto_pago
 * @property $medio_pago
 * @property $nro_transac
 * @property $fecha_transac
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Anuncio $anuncio
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pago extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 10;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','mail_pago','anuncio_id','moneda_precio','precio',
    'moneda_pago','monto_pago','medio_pago','nro_transac','fecha_transac','estado', 'fee'];


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
