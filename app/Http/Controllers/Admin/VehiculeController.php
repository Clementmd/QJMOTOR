<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Essai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Produit::with(['type', 'categorie'])->orderBy('nom', 'asc')->get();
        $types = Type::orderBy('nom', 'asc')->get();
        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('admin.vehicules.index', compact('vehicules', 'types', 'categories'));
    }

    public function create()
    {
        $types = Type::orderBy('nom', 'asc')->get();
        $categories = Categorie::orderBy('nom', 'asc')->get();
        
        return view('admin.vehicules.create', compact('types', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|integer|min:0',
            'permis' => 'nullable|string|max:50',     
            'garantie' => 'nullable|string|max:100',  
            'couleurs' => 'nullable|string', 
            'images_carrousel.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000', 
            'descriptions_carrousel.*' => 'nullable|string',
            'image_principale' => 'required|image|mimes:jpg,jpeg,png,webp|max:10000',  
            'image_fond' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'caracteristiques' => 'nullable|string',
            
            'cylindree' => 'nullable|integer|min:0', 
            'puissance' => 'nullable|numeric|min:0|max:9999.99',
            'poids' => 'nullable|numeric|min:0|max:9999.99', 
            'couple' => 'nullable|numeric|min:0|max:9999.99', 
            
            'titre' => 'nullable|string|max:255',
            'description_courte' => 'nullable|string|max:5200',
            'description' => 'nullable|string',
            'galeries_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'actif' => 'required|in:0,1',
        ]);

        $cheminsImages = [];
        $textesDescriptions = [];

        if ($request->hasFile('images_carrousel')) {
            foreach ($request->file('images_carrousel') as $key => $file) {
                $path = $file->store('carrousel', 'public');
                $cheminsImages[] = $path;

                $description = $request->input('descriptions_carrousel.' . $key);
                $textesDescriptions[] = $description ?? '';
            }
        }

        $data = $request->except(['image_principale', 'image_fond', 'galeries_photos', 'images_carrousel', 'descriptions_carrousel']);
        $data['actif'] = (bool) $request->actif;
        
        $data['images_carrousel'] = $cheminsImages;
        $data['descriptions_carrousel'] = $textesDescriptions;

        if ($request->hasFile('image_principale')) {
            $data['image_principale'] = $request->file('image_principale')->store('vehicules/principales', 'public');
        }

        if ($request->hasFile('image_fond')) {
            $data['image_fond'] = $request->file('image_fond')->store('vehicules/fonds', 'public');
        }

        if ($request->hasFile('galeries_photos')) {
            $galeriePaths = [];
            foreach ($request->file('galeries_photos') as $file) {
                $galeriePaths[] = $file->store('vehicules/galeries', 'public');
            }
            $data['galeries_photos'] = $galeriePaths;
        }

        Produit::create($data);

        return redirect()->route('admin.vehicules.index')->with('success', 'Véhicule ajouté avec succès !');
    }

    public function edit($id)
    {
        $vehicule = Produit::findOrFail($id);
        $types = Type::orderBy('nom', 'asc')->get();
        $categories = Categorie::orderBy('nom', 'asc')->get();

        return view('admin.vehicules.edit', compact('vehicule', 'types', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $vehicule = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|integer|min:0',
            'permis' => 'nullable|string|max:50',    
            'garantie' => 'nullable|string|max:100', 
            'couleurs' => 'nullable|string',
            'images_carrousel.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'descriptions_carrousel.*' => 'nullable|string',
            'image_principale' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'image_fond' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'caracteristiques' => 'nullable|string',
            'cylindree' => 'nullable|integer|min:0', 
            'puissance' => 'nullable|numeric|min:0|max:9999.99', 
            'poids' => 'nullable|numeric|min:0|max:9999.99', 
            'couple' => 'nullable|numeric|min:0|max:9999.99', 
            'titre' => 'nullable|string|max:255',
            'description_courte' => 'nullable|string|max:5200',
            'description' => 'nullable|string',
            'galeries_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'actif' => 'required|in:0,1',
        ]);

        $data = $request->except(['image_principale', 'image_fond', 'galeries_photos', 'images_carrousel', 'descriptions_carrousel']);
        $data['actif'] = (bool) $request->actif;

        if ($request->hasFile('images_carrousel')) {
            if (is_array($vehicule->images_carrousel)) {
                foreach ($vehicule->images_carrousel as $ancienneImg) {
                    Storage::disk('public')->delete($ancienneImg);
                }
            }

            $cheminsImages = [];
            $textesDescriptions = [];

            foreach ($request->file('images_carrousel') as $key => $file) {
                $path = $file->store('carrousel', 'public');
                $cheminsImages[] = $path;

                $description = $request->input('descriptions_carrousel.' . $key);
                $textesDescriptions[] = $description ?? '';
            }
            $data['images_carrousel'] = $cheminsImages;
            $data['descriptions_carrousel'] = $textesDescriptions;
        } else {
            $data['descriptions_carrousel'] = $request->input('descriptions_carrousel') ?? $vehicule->descriptions_carrousel;
        }

        if ($request->hasFile('image_principale')) {
            if ($vehicule->image_principale && Storage::disk('public')->exists($vehicule->image_principale)) {
                Storage::disk('public')->delete($vehicule->image_principale);
            }
            $data['image_principale'] = $request->file('image_principale')->store('vehicules/principales', 'public');
        }

        if ($request->hasFile('image_fond')) {
            if ($vehicule->image_fond && Storage::disk('public')->exists($vehicule->image_fond)) {
                Storage::disk('public')->delete($vehicule->image_fond);
            }
            $data['image_fond'] = $request->file('image_fond')->store('vehicules/fonds', 'public');
        }

        if ($request->hasFile('galeries_photos')) {
            $galeriePaths = $vehicule->galeries_photos ?? [];
            foreach ($request->file('galeries_photos') as $file) {
                $galeriePaths[] = $file->store('vehicules/galeries', 'public');
            }
            $data['galeries_photos'] = $galeriePaths;
        }

        $vehicule->update($data);

        return redirect()->route('admin.vehicules.index')->with('success', 'Véhicule mis à jour avec succès !');
    }

    public function showAPI($id)
    {
        $vehicule = Produit::with(['categorie', 'type'])->find($id);

        if (!$vehicule) {
            return response()->json(['message' => 'Véhicule non trouvé'], 404);
        }

        return response()->json($vehicule);
    }

    public function showFront($typeSlug, $id)
    {
        $vehicule = \App\Models\Produit::findOrFail($id);
        
        return view('welcome', [
            'vehicule' => $vehicule,
            'activeTypeSlug' => $typeSlug 
        ]);
    }
    
    public function confirmDelete($id)
    {
        $vehicule = Produit::findOrFail($id);
        return view('admin.vehicules.delete', compact('vehicule'));
    }

    public function delete(Request $request, $id)
    {
        $vehicule = Produit::findOrFail($id); 
        
        $behavior = $request->input('delete_essais_behavior', 'set_null');

        if ($behavior === 'cascade') {
            Essai::where('produit_id', $vehicule->id)->delete();
        } else {
            Essai::where('produit_id', $vehicule->id)->update(['produit_id' => null]);
        }

        if ($vehicule->image_principale && Storage::disk('public')->exists($vehicule->image_principale)) {
            Storage::disk('public')->delete($vehicule->image_principale);
        }

        if ($vehicule->image_fond && Storage::disk('public')->exists($vehicule->image_fond)) {
            Storage::disk('public')->delete($vehicule->image_fond);
        }

        if (!empty($vehicule->galeries_photos)) {
            foreach ($vehicule->galeries_photos as $photoPath) {
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }
            }
        }

        $vehicule->delete();

        return redirect()->route('admin.vehicules.index')->with('success', 'Le véhicule a été supprimé avec succès.');
    }

    public function destroy($id)
    {
        $vehicule = Produit::findOrFail($id);

        if ($vehicule->image_principale && Storage::disk('public')->exists($vehicule->image_principale)) {
            Storage::disk('public')->delete($vehicule->image_principale);
        }

        if ($vehicule->image_fond && Storage::disk('public')->exists($vehicule->image_fond)) {
            Storage::disk('public')->delete($vehicule->image_fond);
        }

        if (!empty($vehicule->galeries_photos)) {
            foreach ($vehicule->galeries_photos as $photoPath) {
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }
            }
        }

        $vehicule->delete();

        return redirect()->route('admin.vehicules.index')->with('success', 'Le véhicule et ses images ont été supprimés avec succès !');
    }
}