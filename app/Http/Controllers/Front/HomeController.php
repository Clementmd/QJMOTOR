<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produit; 
use App\Models\Actualite; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $actualites = Actualite::orderBy('created_at', 'desc')->get();

        $produits = Produit::with('categorie') 
                            ->orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();

        return view('welcome', compact('actualites', 'produits'));
    }
}