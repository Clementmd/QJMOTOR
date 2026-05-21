<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\CatActu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActualiteController extends Controller
{
    public function index()
    {
        $actus = Actualite::with('categorie')->orderBy('date_publication', 'desc')->get();
        
        $categories = CatActu::orderBy('nom', 'asc')->get();

        return view('admin.actus.index', compact('actus', 'categories'));
    }
    public function create()
    {
        $categories = CatActu::orderBy('nom', 'asc')->get();
        return view('admin.actus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'cat_actu_id' => 'required|exists:cat_actus,id',
            'date_publication' => 'required|date',
            'description' => 'required|string',
            'image_couverture' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' 
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'cat_actu_id.required' => 'La catégorie est obligatoire.',
            'date_publication.required' => 'La date est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'image_couverture.required' => 'L\'image de couverture est obligatoire.'
        ]);

        $data = $request->except(['image_couverture', 'images']);

        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('actus/couvertures', 'public');
            $data['image_couverture'] = $path;
        }

        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                $uploadedImages[] = $file->store('actus/galerie', 'public');
            }
            $data['images'] = $uploadedImages; 
        }

        Actualite::create($data);

        return redirect()->route('admin.actus.index')->with('success', 'L\'actualité a été ajoutée avec succès !');
    }

    public function edit($id)
    {
        $actu = Actualite::findOrFail($id);
        $categories = CatActu::orderBy('nom', 'asc')->get();

        return view('admin.actus.edit', compact('actu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $actu = Actualite::findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'cat_actu_id' => 'required|exists:cat_actus,id',
            'date_publication' => 'required|date',
            'description' => 'required|string',
            'image_couverture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'cat_actu_id.required' => 'La catégorie est obligatoire.',
            'date_publication.required' => 'La date est obligatoire.',
            'description.required' => 'Le contenu de la description est requis.'
        ]);

        $data = $request->except(['image_couverture', 'images']);

        if ($request->hasFile('image_couverture')) {
            if ($actu->image_couverture) {
                Storage::disk('public')->delete($actu->image_couverture);
            }
            $data['image_couverture'] = $request->file('image_couverture')->store('actus/couvertures', 'public');
        }

        if ($request->hasFile('images')) {
            if ($actu->images && is_array($actu->images)) {
                foreach ($actu->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                $uploadedImages[] = $file->store('actus/galerie', 'public');
            }
            $data['images'] = $uploadedImages;
        }

        $actu->update($data);

        return redirect()->route('admin.actus.index')->with('success', 'L\'actualité a été modifiée avec succès !');
    }

    public function delete($id)
    {
        $actu = Actualite::findOrFail($id);
        
        return view('admin.actus.delete', compact('actu'));
    }


    public function destroy($id)
    {
        $actu = Actualite::findOrFail($id);

        if ($actu->image_couverture) {
            Storage::disk('public')->delete($actu->image_couverture);
        }

        if ($actu->images && is_array($actu->images)) {
            foreach ($actu->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $actu->delete();

        return redirect()->route('admin.actus.index')->with('success', 'L\'actualité a été supprimée avec succès !');
    }
}