<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'anuncio_id', 'user_id', 'estado', 'position', 'portada'];

    // Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(Anuncio::class);
    }


    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }


}
