<x-guest-layout>
    <x-slot name="title">Supprimer un type de véhicule | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small text-center">
            
            <div class="card-header-form justify-center">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Supprimer un type de véhicules</h1>
            </div>

            <p class="confirm-delete-text">
                Êtes-vous sûr de vouloir supprimer le type : <strong>{{ $type->nom }}</strong> ?
            </p>

            <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="form-buttons-row justify-center">
                    <button type="submit" class="btn-global-red-delete">Oui supprimer</button>
                    <a href="{{ route('admin.types.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>