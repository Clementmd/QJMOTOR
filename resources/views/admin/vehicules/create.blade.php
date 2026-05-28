<x-app-layout>
    <x-slot name="title">Ajouter un véhicule | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Ajouter un véhicule</h1>
            </div>

            @if ($errors->any())
                <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 20px; font-family: sans-serif;">
                    <strong style="display: block; margin-bottom: 5px;">Oups ! Le formulaire contient des erreurs :</strong>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.vehicules.store') }}" method="POST" enctype="multipart/form-data" class="standard-form">
                @csrf

                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="type_id" class="form-label">Type</label>
                    <select id="type_id" name="type_id" class="form-input" required>
                        <option value="">Sélectionner un type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="categorie_id" class="form-label">Catégorie</label>
                    <select id="categorie_id" name="categorie_id" class="form-input" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="prix" class="form-label">Prix (en €)</label>
                    <input type="number" id="prix" name="prix" value="{{ old('prix') }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Image de fond</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="image_fond" id="image_fond" class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="label-image_fond">Importer une image</span>
                            <label for="image_fond" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Image Principale</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="image_principale" id="image_principale" required class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="label-image_principale">Importer une image</span>
                            <label for="image_principale" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="caracteristiques" class="form-label">Caractéristiques</label>
                    <textarea id="caracteristiques" name="caracteristiques" rows="4" class="form-input">{{ old('caracteristiques') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="cylindree" class="form-label">Cylindrée (cm³)</label>
                    <input type="number" id="cylindree" name="cylindree" value="{{ old('cylindree') }}" min="0" class="form-input" placeholder="Ex: 500">
                </div>
                
                <div class="form-group">
                    <label for="permis">Type de Permis requis</label>
                    <input type="text" name="permis" id="permis" class="form-control" placeholder="Ex: A2, A" value="{{ old('permis', $produit->permis ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="garantie">Garantie constructeur</label>
                    <input type="text" name="garantie" id="garantie" class="form-control" placeholder="Ex: 3 ans constructeur" value="{{ old('garantie', $produit->garantie ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="puissance" class="form-label">Puissance (ch / kW)</label>
                    <input type="number" id="puissance" name="puissance" value="{{ old('puissance') }}" min="0" step="0.01" class="form-input" placeholder="Ex: 47.50">
                </div>

                <div class="form-group">
                    <label for="poids" class="form-label">Poids (kg)</label>
                    <input type="number" id="poids" name="poids" value="{{ old('poids') }}" min="0" step="0.01" class="form-input" placeholder="Ex: 195.00">
                </div>

                <div class="form-group">
                    <label for="couple" class="form-label">Couple (Nm)</label>
                    <input type="number" id="couple" name="couple" value="{{ old('couple') }}" min="0" class="form-input" placeholder="Ex: 90">
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label for="couleurs"><strong>Couleurs du véhicule :</strong></label>
                    <input type="text" name="couleurs" class="form-control" placeholder="Ex: #e30613,#000000,#ffffff" value="{{ isset($produit) ? $produit->couleurs : '' }}">
                    <small class="text-muted">Entre les codes hexadécimaux pour afficher les pastilles de couleur.</small>
                </div>

                <div class="carrousel-management-box" style="background: #f8f9fa; padding: 20px; border: 1px solid #ddd; margin-bottom: 25px;">
                    <h4 style="margin-top: 0; margin-bottom: 15px;">Galerie d'images du carrousel</h4>
                    
                    <div id="dynamic-carrousel-container">
                        @if(isset($produit) && is_array($produit->images_carrousel))
                            @foreach($produit->images_carrousel as $index => $image)
                                <div class="carrousel-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #ccc;">
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        <img src="/storage/{{ $image }}" style="width: 60px; height: 60px; object-fit: cover;">
                                        <div style="flex-grow: 1;">
                                            <input type="file" name="images_carrousel[]" class="form-control">
                                            <input type="text" name="descriptions_carrousel[]" class="form-control" style="margin-top: 5px;" value="{{ $produit->descriptions_carrousel[$index] ?? '' }}" placeholder="Description de cette image">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="gallery-carousel-input-group">
                                <label>Photo de détail et légende :</label>
                                <input type="file" @change="handleFileChange">
                                
                                <textarea 
                                    v-model="nouvelleDescription" 
                                    rows="4"
                                    placeholder="Ex: Étriers de frein radiaux. Style sportif et affirmé..."
                                    class="carousel-textarea"
                                ></textarea>
                            </div>
                        @endif
                    </div>

                    <button type="button" id="btn-add-carrousel-item" style="background: #e30613; color: #fff; padding: 8px 16px; border: none; font-weight: bold; cursor: pointer; margin-top: 10px;">
                        + Ajouter une image de détail
                    </button>
                </div>

                <div class="form-group">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" class="form-input">
                </div>

                <div class="form-group">
                    <label for="description_courte" class="form-label">Description courte</label>
                    <textarea id="description_courte" name="description_courte" rows="4" class="form-input">{{ old('description_courte') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Photos (Galerie)</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="galeries_photos[]" id="galeries_photos" multiple class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="label-galeries_photos">Importer une ou plusieurs images</span>
                            <label for="galeries_photos" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="6" class="form-input">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="actif" class="form-label">État</label>
                    <select id="actif" name="actif" class="form-input" required>
                        <option value="1" {{ old('actif', '1') == '1' ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ old('actif') == '0' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-green">Enregistrer</button>
                    <a href="{{ route('admin.vehicules.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setupFileInputDesign(inputId, displayId, isMultiple = false) {
            document.getElementById(inputId).addEventListener('change', function(e) {
                let text = "Importer une image";
                if (isMultiple) {
                    const count = e.target.files.length;
                    text = count > 1 ? `${count} fichiers sélectionnés` : (count === 1 ? e.target.files.name : "Importer une ou plusieurs images");
                } else {
                    text = e.target.files ? e.target.files.name : "Importer une image";
                }
                document.getElementById(displayId).textContent = text;
            });
        }

        document.getElementById('btn-add-carrousel-item').addEventListener('click', function() {
            const container = document.getElementById('dynamic-carrousel-container');
            
            const newRow = document.createElement('div');
            newRow.classList.add('carrousel-row');
            newRow.style.marginBottom = '15px';
            newRow.style.marginTop = '15px';
            newRow.style.borderTop = '1px dashed #ccc';
            newRow.style.paddingTop = '15px';

            newRow.innerHTML = `
                <input type="file" name="images_carrousel[]" class="form-control">
                <input type="text" name="descriptions_carrousel[]" class="form-control" style="margin-top: 5px;" placeholder="Description de cette image">
            `;
            
            container.appendChild(newRow);
        });

        setupFileInputDesign('image_fond', 'label-image_fond');
        setupFileInputDesign('image_principale', 'label-image_principale');
        setupFileInputDesign('galeries_photos', 'label-galeries_photos', true); 
    </script>
</x-app-layout>