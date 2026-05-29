<x-app-layout>
    <x-slot name="title">Supprimer un inscrit | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">

            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Supprimer un inscrit</h1>
            </div>

            <p class="modal-message" style="text-align: center; margin-bottom: 25px;">
                Êtes-vous sûr de vouloir supprimer l'inscrit : <strong>{{ $newsletter->nom }}</strong> ({{ $newsletter->email }}) ?
            </p>

            <form action="{{ route('admin.newsletters.delete-execute', $newsletter->id) }}" method="POST" class="standard-form">
                @csrf
                @method('DELETE')

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-red">Oui, supprimer</button>
                    <a href="{{ route('admin.newsletters.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>