<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Precio
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $plan_id
 * @property $zone_id
 * @property $state_id
 *
 * @property Plane $plane
 * @property State $state
 * @property Zone $zone
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Precio extends Model
{
    use SoftDeletes;
    
    static $rules = [
		'plan_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['plan_id','zone_id','state_id', 'precio'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plane()
    {
        return $this->hasOne('App\Models\Plane', 'id', 'plan_id');
    }
    
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zone()
    {
        return $this->hasOne('App\Models\Zone', 'id', 'zone_id');
    }


    

}
