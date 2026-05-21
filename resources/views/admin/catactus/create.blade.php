<x-guest-layout>
    <x-slot name="title">Ajouter une catégorie d'actu | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Ajouter une catégorie d'actu</h1>
            </div>

            <form action="{{ route('admin.catactus.store') }}" method="POST" class="standard-form">
                @csrf

                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required class="form-input" autofocus>
                    @error('nom') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-green">Enregistrer</button>
                    <a href="{{ route('admin.catactus.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>