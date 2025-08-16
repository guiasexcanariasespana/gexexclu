<?php

namespace App\Models\Seo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'value'
    ];

    public function contents() : BelongsToMany {

        return $this->belongsToMany(Content::class);
        
    }
}
