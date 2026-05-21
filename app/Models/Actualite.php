<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $table = 'actualites';

    protected $fillable = [
        'cat_actu_id', 
        'titre', 
        'date_publication', 
        'description', 
        'image_couverture', 
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'date_publication' => 'date'
    ];

    public function categorie()
    {
        return $this->belongsTo(CatActu::class, 'cat_actu_id');
    }
}