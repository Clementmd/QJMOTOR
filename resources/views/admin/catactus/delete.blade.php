<x-guest-layout>
    <x-slot name="title">Supprimer une catégorie d'actu | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small text-center">
            
            <div class="card-header-form" style="justify-content: center; gap: 15px; margin-bottom: 25px;">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title" style="margin: 0; font-size: 24px;">Supprimer une catégorie</h1>
            </div>

            <p class="delete-confirmation-text" style="font-size: 16px; color: #1e293b; margin: 30px 0;">
                Êtes-vous sûr de vouloir supprimer la catégorie : <strong>{{ $cat->nom }}</strong> ?
            </p>

            <form action="{{ route('admin.catactus.destroy', $cat->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="form-buttons-row" style="justify-content: center; gap: 20px;">
                    <button type="submit" class="btn-global-red">Oui supprimer</button>
                    <a href="{{ route('admin.catactus.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>