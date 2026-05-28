<x-app-layout>
    <x-slot name="title">Supprimer un véhicule | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box modal-delete-box" style="margin: 40px auto; max-width: 600px;">
            
            <div class="card-header">
                <span class="vertical-bar border-red"></span>
                <h2 class="card-title modal-delete-title">Supprimer le véhicule : <span style="color: #e53e3e;">{{ $vehicule->nom }}</span></h2>
            </div>

            <p class="modal-delete-desc">
                Des demandes d'essais clients sont associées à ce véhicule. Choisissez l'action à mener pour l'historique client avant de confirmer :
            </p>
            
            <form action="{{ route('admin.vehicules.delete-execute', $vehicule->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-choice-block">
                    <span class="modal-choice-title">Pour les demandes d'essais liées :</span>
                    
                    <label class="modal-choice-option">
                        <input type="radio" name="delete_essais_behavior" value="set_null" checked>
                        <span><strong>Conserver les essais</strong> (Désassocier le véhicule pour garder l'historique client)</span>
                    </label>
                    
                    <label class="modal-choice-option danger-option">
                        <input type="radio" name="delete_essais_behavior" value="cascade">
                        <span><strong>Supprimer définitivement</strong> tous les essais liés à ce véhicule</span>
                    </label>
                </div>

                <div class="modal-actions-wrapper">
                    <a href="{{ route('admin.vehicules.index') }}" class="btn-global-gray" style="text-decoration: none; display: inline-block; padding: 10px 20px;">Annuler</a>
                    <button type="submit" class="btn-global-red">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>