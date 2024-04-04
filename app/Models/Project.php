<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome_progetto',
        'slug',
        'descrizione_progetto',
        'linguaggi',
        'immagine',
        'type_id'
       
    ];

    public static function generateSlug($nome_progetto){
        return Str::slug($nome_progetto, '-');
    }

    public function type(): BelongsTo{
        return $this->belongsTo(Type::class);
    }

    public function technologies(): BelongsToMany{
        return $this->belongsToMany(Technology::class);
    }
}
