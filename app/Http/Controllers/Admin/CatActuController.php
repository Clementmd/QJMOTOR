<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatActu;
use Illuminate\Http\Request;

class CatActuController extends Controller
{
    public function index()
    {
        $cat_actus = CatActu::orderBy('nom', 'asc')->get();
        
        return view('admin.catactus.index', compact('cat_actus'));
    }
    public function create()
    {
        return view('admin.catactus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:cat_actus,nom',
        ], [
            'nom.unique' => 'Cette catégorie existe déjà.',
            'nom.required' => 'Le nom est obligatoire.'
        ]);

        CatActu::create($request->all());

        return redirect()->route('admin.catactus.index')->with('success', 'Catégorie d\'actu créée avec succès !');
    }

    public function edit($id)
    {
        $cat = CatActu::findOrFail($id);
        return view('admin.catactus.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $cat = CatActu::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|unique:cat_actus,nom,' . $cat->id,
        ], [
            'nom.unique' => 'Cette catégorie existe déjà.',
            'nom.required' => 'Le nom est obligatoire.'
        ]);

        $cat->update($request->all());

        return redirect()->route('admin.catactus.index')->with('success', 'La catégorie d\'actu a été modifiée avec succès !');
    }

    public function delete($id)
    {
        $cat = CatActu::findOrFail($id);
        return view('admin.catactus.delete', compact('cat'));
    }

    public function destroy($id)
    {
        $cat = CatActu::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.catactus.index')->with('success', 'La catégorie d\'actu a été supprimée avec succès !');
    }
}