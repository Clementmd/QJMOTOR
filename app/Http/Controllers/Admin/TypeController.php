<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
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

    public function delete(Type $type)
    {
        return view('admin.types.delete', compact('type'));
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('success', 'Le type de véhicule a bien été supprimé.');
    }
}