<?php

namespace App\Models\Seo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
        , 'description'
    ];

    public function keywords() : BelongsToMany {
        
        return $this->belongsToMany(Word::class);
        
    }

    public function contentable() : MorphTo {

        return $this->morphTo();
        
    }
}
