<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Essai;
use App\Models\Produit; 
use Illuminate\Http\Request;

class EssaieController extends Controller
{
    public function index()
    {
        $essais = Essai::with('produit')->orderBy('created_at', 'desc')->get();

        $produits = Produit::orderBy('nom', 'asc')->get();

        return view('admin.essaies.index', compact('essais', 'produits'));
    }

    public function create()
    {
        $produits = Produit::orderBy('nom', 'asc')->get();
        return view('admin.essaies.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'telephone' => 'required|string|max:20',
            'produit_id' => 'nullable|exists:produits,id',
            'statut' => 'required|string|max:20'
        ]);

        Essai::create($request->all());

        return redirect()->route('admin.essaies.index')->with('success', 'Demande d\'essai ajoutée avec succès !');
    }

    public function edit($id)
    {
        $essai = Essai::findOrFail($id);
        $produits = Produit::orderBy('nom', 'asc')->get();
        return view('admin.essaies.edit', compact('essai', 'produits'));
    }

    public function update(Request $request, $id)
    {
        $essai = Essai::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'telephone' => 'required|string|max:20',
            'produit_id' => 'nullable|exists:produits,id',
            'statut' => 'required|string|max:20'
        ]);

        $essai->update($request->all());

        return redirect()->route('admin.essaies.index')->with('success', 'Demande d\'essai mise à jour !');
    }

    public function delete($id)
    {
        $essai = Essai::findOrFail($id);
        return view('admin.essaies.delete', compact('essai'));
    }

    public function destroy($id)
    {
        $essai = Essai::findOrFail($id);
        $essai->delete();

        return redirect()->route('admin.essaies.index')->with('success', 'Demande d\'essai supprimée !');
    }
}