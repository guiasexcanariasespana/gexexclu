<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

/**
 * Class Tag
 *
 * @property $id
 * @property $nombre
 * @property $slug
 * @property $color
 * @property $visible
 * @property $menu
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tag extends Model
{
    use SoftDeletes;
    // public $rules = [
    // 'nombre' =>['required',Rule::unique("tags")->ignore($user->id, "rubro")],
    // 'slug' => 'required',
		// 'visible' => 'required',
		// 'menu' => 'required',
    // ];

    public $rubros = ["AL" => "Exterior",
    "IN" => "Interior", 
    "EC" => "En casa", 
    "ETC" => "En Tu Casa",]  ;

    protected $perPage = 20;

  // Relacion uno a muchos
  public function anuncios()
  {
    return $this->belongsToMany(Anuncio::class);
  }


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','slug','color','visible','menu', 'rubro'];




}
