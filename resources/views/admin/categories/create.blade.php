<x-app-layout>
    <x-slot name="title">Ajouter une catégorie | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Ajouter une catégorie</h1>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="standard-form">
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
                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Image de fond</label>
                    <div class="file-import-wrapper">
                        <input type="file" name="image_fond" id="image_fond" class="file-input-hidden">
                        <div class="file-custom-design">
                            <span id="file-name-display">Importer une image</span>
                            <label for="image_fond" class="file-import-btn">Importer</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="5" class="form-input">{{ old('description') }}</textarea>
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
            const fileName = e.target.files[0] ? e.target.files[0].name : "Importer une image";
            document.getElementById('file-name-display').textContent = fileName;
        });
    </script>
</x-app-layout>