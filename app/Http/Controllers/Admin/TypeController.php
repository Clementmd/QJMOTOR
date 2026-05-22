<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Produit;   
use App\Models\Categorie;
use Illuminate\Http\Request;

class TypeController extends Controller
{
public function index()
    {
        $types = Type::orderBy('nom', 'asc')->get(); 
        
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:types,nom',
        ], [
            'nom.unique' => 'Ce type de véhicule existe déjà.',
            'nom.required' => 'Le champ nom est obligatoire.'
        ]);

        Type::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('admin.types.index')->with('success', 'Le type de véhicule a bien été ajouté !');
    }

    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:types,nom,' . $type->id,
        ], [
            'nom.unique' => 'Ce type de véhicule existe déjà.',
            'nom.required' => 'Le champ nom est obligatoire.'
        ]);

        $type->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('admin.types.index')->with('success', 'Le type de véhicule a bien été modifié !');
    }

    public function confirmDelete($id)
    {
        $type = Type::findOrFail($id);

        return view('admin.types.delete', compact('type'));
    }


    public function delete(Request $request, $id)
    {
        $type = Type::findOrFail($id);
        
        $vehiculesBehavior = $request->input('delete_vehicules_behavior', 'set_null');
        if ($vehiculesBehavior === 'cascade') {
            Produit::where('type_id', $type->id)->delete();
        } else {
            Produit::where('type_id', $type->id)->update(['type_id' => null]);
        }

        $categoriesBehavior = $request->input('delete_categories_behavior', 'set_null');
        if ($categoriesBehavior === 'cascade') {
            Categorie::where('type_id', $type->id)->delete();
        } else {
            Categorie::where('type_id', $type->id)->update(['type_id' => null]);
        }

        $type->delete();

        return redirect()->route('admin.types.index')->with('success', 'Le type de véhicule a bien été supprimé.');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('success', 'Le type de véhicule a bien été supprimé.');
    }
}