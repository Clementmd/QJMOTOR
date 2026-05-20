<x-guest-layout>
    <x-slot name="title">Modifier une catégorie | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Modifier une catégorie</h1>
            </div>

            <form action="{{ route('admin.categories.update', $categorie->id) }}" method="POST" enctype="multipart/form-data" class="standard-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $categorie->nom) }}" required class="form-input">
                    @error('nom') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="type_id" class="form-label">Type</label>
                    <select id="type_id" name="type_id" class="form-input" required>
                        <option value="">Sélectionner un type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $categorie->type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre', $categorie->titre) }}" required class="form-input">
                    @error('titre') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Image de fond</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="image_fond" id="image_fond" class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="file-name-display">
                                {{ $categorie->image_fond ? basename($categorie->image_fond) : 'Modifier l\'image (Optionnel)' }}
                            </span>
                            <label for="image_fond" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                    @error('image_fond') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="5" class="form-input">{{ old('description', $categorie->description) }}</textarea>
                    @error('description') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-green">Enregistrer</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image_fond').addEventListener('change', function(e) {
            const fileName = e.target.files ? e.target.files.name : "Modifier l'image (Optionnel)";
            document.getElementById('file-name-display').textContent = fileName;
        });
    </script>
</x-guest-layout>