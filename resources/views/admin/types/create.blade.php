<x-app-layout>
    <x-slot name="title">Ajouter un type de véhicule | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Ajouter un type de véhicules</h1>
            </div>

            <form action="{{ route('admin.types.store') }}" method="POST" class="standard-form">
                @csrf

                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required autofocus class="form-input">
                    @error('nom')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-green">Enregistrer</button>
                    <a href="{{ route('admin.types.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>