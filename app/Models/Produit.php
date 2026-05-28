<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'type_id', 'categorie_id', 'nom', 'prix','permis',  
        'garantie', 'image_principale', 'image_fond', 
        'couleurs','images_carrousel','descriptions_carrousel',
        'caracteristiques', 'cylindree', 'puissance', 'couple', 'poids', 
        'titre', 'description_courte', 'galeries_photos', 'description', 'actif'
    ];

    protected $casts = [
        'galeries_photos' => 'array',
        'actif' => 'boolean',
        'images_carrousel' => 'array',      
        'descriptions_carrousel' => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}