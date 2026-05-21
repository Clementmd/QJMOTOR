<x-guest-layout>
    <x-slot name="title">Ajouter une Actu | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Ajouter une Actu</h1>
            </div>

            <form action="{{ route('admin.actus.store') }}" method="POST" enctype="multipart/form-data" class="standard-form">
                @csrf

                <div class="form-group">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required class="form-input" autofocus>
                    @error('titre') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="cat_actu_id" class="form-label">Categorie actu</label>
                    <select id="cat_actu_id" name="cat_actu_id" required class="form-input filter-select">
                        <option value="" disabled selected>Sélectionner une catégorie</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('cat_actu_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                    @error('cat_actu_id') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="date_publication" class="form-label">Date</label>
                    <input type="date" id="date_publication" name="date_publication" value="{{ old('date_publication', date('Y-m-d')) }}" required class="form-input">
                    @error('date_publication') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" required class="form-input" style="height: 120px; resize: vertical;">{{ old('description') }}</textarea>
                    @error('description') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Image de couverture</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="image_couverture" id="image_couverture" required accept="image/*" class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="label-image_couverture">Importer une image</span>
                            <label for="image_couverture" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                    @error('image_couverture') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Images</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="images[]" id="images" multiple accept="image/*" class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="label-images">Importer une ou plusieurs images</span>
                            <label for="images" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                    @error('images') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-green">Enregistrer</button>
                    <a href="{{ route('admin.actus.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
            
        </div>
    </div>

    <script>
        function setupFileInputDesign(inputId, displayId, isMultiple = false) {
            const inputElement = document.getElementById(inputId);
            if (inputElement) {
                inputElement.addEventListener('change', function(e) {
                    let text = "Importer une image";
                    if (isMultiple) {
                        const count = e.target.files.length;
                        text = count > 1 ? `${count} fichiers sélectionnés` : (count === 1 ? e.target.files.name : "Importer une ou plusieurs images");
                    } else {
                        text = e.target.files && e.target.files.length > 0 ? e.target.files.name : "Importer une image";
                    }
                    document.getElementById(displayId).textContent = text;
                });
            }
        }

        setupFileInputDesign('image_couverture', 'label-image_couverture');
        setupFileInputDesign('images', 'label-images', true);
    </script>
</x-guest-layout>