<x-guest-layout>
    <x-slot name="title">Supprimer une catégorie d'actu | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box modal-delete-box" style="margin: 40px auto; max-width: 600px;">
            
            <div class="card-header">
                <span class="vertical-bar border-red"></span>
                <h2 class="card-title modal-delete-title">Supprimer la catégorie : <span style="color: #e53e3e;">{{ $cat->nom }}</span></h2>
            </div>

            <p class="modal-delete-desc">
                Des articles d'actualités sont associés à cette catégorie. Choisissez l'action à mener pour les éléments liés avant de confirmer :
            </p>
            
            <form action="{{ route('admin.catactus.delete-execute', $cat->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-choice-block">
                    <span class="modal-choice-title">Pour les Actualités liées :</span>
                    
                    <label class="modal-choice-option">
                        <input type="radio" name="delete_actus_behavior" value="set_null" checked>
                        <span><strong>Conserver les articles</strong> (Désassocier la catégorie)</span>
                    </label>
                    
                    <label class="modal-choice-option danger-option">
                        <input type="radio" name="delete_actus_behavior" value="cascade">
                        <span><strong>Supprimer définitivement</strong> tous les articles de cette catégorie</span>
                    </label>
                </div>

                <div class="modal-actions-wrapper">
                    <a href="{{ route('admin.catactus.index') }}" class="btn-global-gray" style="text-decoration: none; display: inline-block; padding: 10px 20px;">Annuler</a>
                    <button type="submit" class="btn-global-red">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>