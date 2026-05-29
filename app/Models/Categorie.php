<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug', 'type_id', 'titre', 'image_fond', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categorie) {
            $categorie->slug = Str::slug($categorie->nom);
        });

        static::updating(function ($categorie) {
            $categorie->slug = Str::slug($categorie->nom);
        });
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }
}