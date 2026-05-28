<x-app-layout>
    <x-slot name="title">Supprimer un essai | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Supprimer un essaie</h1>
            </div>
            
            <p class="confirm-delete-text text-center">
                Êtes-vous sûr de vouloir supprimer l'essaie : <strong>{{ $essai->nom }}</strong> ?
            </p>

            <form action="{{ route('admin.essaies.destroy', $essai->id) }}" method="POST" class="standard-form">
                @csrf
                @method('DELETE')
                
                <div class="form-buttons-row justify-center">
                    <button type="submit" class="btn-global-red-delete">Oui supprimer</button>
                    <a href="{{ route('admin.essaies.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>