<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'type_id', 'titre', 'image_fond', 'description'];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }
}