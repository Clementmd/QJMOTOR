<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Produit;
use App\Models\Essai;
use App\Models\Type;
use App\Models\Categorie;

class DashboardController extends Controller
{
    public function index()
    {
        $countActus = Actualite::count();
        $countTypes = Type::count();
        $countProduits = Produit::count();
        $countEssais = Essai::count();
        $countCategories = Categorie::count(); 

        $categories = Categorie::orderBy('nom', 'asc')->get();
        $types = Type::orderBy('nom', 'asc')->get();
        $produits = Produit::orderBy('nom', 'asc')->get();
        $essaisDistincts = Essai::select('nom', 'prenom')->orderBy('nom', 'asc')->get();

        $derniersActus = Actualite::with('categorie')->orderBy('created_at', 'desc')->get();
        $tousLesProduits = Produit::with('type')->orderBy('created_at', 'desc')->get();
        $derniersEssais = Essai::with(['produit.type'])->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact(
            'countActus', 
            'countProduits', 
            'countEssais', 
            'countTypes', 
            'countCategories',
            'categories',
            'types',
            'produits',
            'essaisDistincts',
            'derniersActus',
            'derniersEssais',
            'tousLesProduits'
        ));
    }
}