<x-guest-layout> <x-slot name="title">Supprimer un type de véhicule | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box modal-delete-box" style="margin: 40px auto; max-width: 600px;">
            
            <div class="card-header">
                <span class="vertical-bar border-red"></span>
                <h2 class="card-title modal-delete-title">Supprimer le type : <span style="color: #e53e3e;">{{ $type->nom }}</span></h2>
            </div>

            <p class="modal-delete-desc">
                Des éléments sont liés à ce type de véhicule. Choisissez l'action à mener pour chaque catégorie d'éléments avant de confirmer la suppression définitive :
            </p>
            
            <form action="{{ route('admin.types.delete-execute', $type->id) }}" method="POST">
                @csrf
                @method('DELETE') <div class="modal-choice-block">
                    <span class="modal-choice-title"> Pour les Véhicules liés :</span>
                    <label class="modal-choice-option">
                        <input type="radio" name="delete_vehicules_behavior" value="set_null" checked>
                        <span><strong>Conserver</strong> (laisser le type vide)</span>
                    </label>
                    <label class="modal-choice-option danger-option">
                        <input type="radio" name="delete_vehicules_behavior" value="cascade">
                        <span><strong>Supprimer définitivement</strong> tous les véhicules liés</span>
                    </label>
                </div>

                <div class="modal-choice-block">
                    <span class="modal-choice-title"> Pour les Catégories liées :</span>
                    <label class="modal-choice-option">
                        <input type="radio" name="delete_categories_behavior" value="set_null" checked>
                        <span><strong>Conserver</strong> (laisser le type vide)</span>
                    </label>
                    <label class="modal-choice-option danger-option">
                        <input type="radio" name="delete_categories_behavior" value="cascade">
                        <span><strong>Supprimer définitivement</strong> toutes les catégories liées</span>
                    </label>
                </div>

                <div class="modal-actions-wrapper">
                    <a href="{{ route('admin.types.index') }}" class="btn-global-gray" style="text-decoration: none; display: inline-block; padding: 10px 20px;">Annuler</a>
                    <button type="submit" class="btn-global-red">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>