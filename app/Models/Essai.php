<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Essai extends Model
{
    use HasFactory;

    protected $table = 'demandes_essais';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'produit_id', 
        'statut'    
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}