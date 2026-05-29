<?php

namespace App\Http\Controllers\Admin;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('type')->orderBy('nom', 'asc')->get();
        
        $types = Type::orderBy('nom', 'asc')->get();

        return view('admin.categories.index', compact('categories', 'types'));
    }
    public function create()
    {
        $types = Type::all();
        return view('admin.categories.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_fond' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_fond')) {
            $path = $request->file('image_fond')->store('categories', 'public');
            $data['image_fond'] = $path;
        }

        Categorie::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès !');
    }
    public function edit(Categorie $categorie)
    {
        $types = Type::all();
        return view('admin.categories.edit', compact('categorie', 'types'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_fond' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_fond')) {
            if ($categorie->image_fond && Storage::disk('public')->exists($categorie->image_fond)) {
                Storage::disk('public')->delete($categorie->image_fond);
            }

            $path = $request->file('image_fond')->store('categories', 'public');
            $data['image_fond'] = $path;
        }

        $categorie->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'La catégorie a été modifiée avec succès !');
    }

    public function confirmDelete($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categories.delete', compact('categorie'));
    }

    public function delete(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        
        $behavior = $request->input('delete_vehicules_behavior', 'set_null');

        if ($behavior === 'cascade') {
            Produit::where('categorie_id', $categorie->id)->delete();
        } else {
            Produit::where('categorie_id', $categorie->id)->update(['categorie_id' => null]);
        }

        if ($categorie->image_fond && Storage::disk('public')->exists($categorie->image_fond)) {
            Storage::disk('public')->delete($categorie->image_fond);
        }

        $categorie->delete();

        return redirect()->route('admin.categories.index')->with('success', 'La catégorie a été supprimée avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        if ($categorie->image_fond && Storage::disk('public')->exists($categorie->image_fond)) {
            Storage::disk('public')->delete($categorie->image_fond);
        }

        $categorie->delete();

        return redirect()->route('admin.categories.index')->with('success', 'La catégorie a été supprimée avec succès !');
    }

    public function showAPI($slug)
    {
        $categorie = \App\Models\Categorie::with('produits.type')
            ->where('slug', $slug)
            ->first();

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        return response()->json($categorie);
    }

    public function showFront($slug)
    {
        $categorie = \App\Models\Categorie::where('slug', $slug)->first();
        
        if (!$categorie) {
            abort(404);
        }

        return view('welcome', [
            'slug' => $categorie->slug,  
            'activeTypeSlug' => $categorie->type->nom ?? ''
        ]);
    }
}