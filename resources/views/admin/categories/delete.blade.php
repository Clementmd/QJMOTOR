<x-app-layout>
    <x-slot name="title">Supprimer une catégorie | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box modal-delete-box" style="margin: 40px auto; max-width: 600px;">
            
            <div class="card-header">
                <span class="vertical-bar border-red"></span>
                <h2 class="card-title modal-delete-title">Supprimer la catégorie : <span style="color: #e53e3e;">{{ $categorie->nom }}</span></h2>
            </div>

            <p class="modal-delete-desc">
                Des véhicules appartiennent à cette catégorie. Choisissez l'action à mener pour les éléments liés avant de confirmer :
            </p>
            
            <form action="{{ route('admin.categories.delete-execute', $categorie->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-choice-block">
                    <span class="modal-choice-title">Pour les Véhicules liés :</span>
                    
                    <label class="modal-choice-option">
                        <input type="radio" name="delete_vehicules_behavior" value="set_null" checked>
                        <span><strong>Conserver les véhicules</strong> (Désassocier la catégorie)</span>
                    </label>
                    
                    <label class="modal-choice-option danger-option">
                        <input type="radio" name="delete_vehicules_behavior" value="cascade">
                        <span><strong>Supprimer définitivement</strong> tous les véhicules de cette catégorie</span>
                    </label>
                </div>

                <div class="modal-actions-wrapper">
                    <a href="{{ route('admin.categories.index') }}" class="btn-global-gray" style="text-decoration: none; display: inline-block; padding: 10px 20px;">Annuler</a>
                    <button type="submit" class="btn-global-red">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>