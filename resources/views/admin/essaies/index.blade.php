<x-app-layout>
    <x-slot name="title">Gestion des Essais | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Essais</h1>
        <div class="card-box">
            
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des essais</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Filtrer par Véhicule :</span>
                    <select id="filter-vehicule" class="filter-select" onchange="applyFilters()">
                        <option value="all">Tous les véhicules</option>
                        <option value="none">Sans véhicule</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                        @endforeach
                    </select>

                    <select id="filter-etat" class="filter-select" onchange="applyFilters()">
                        <option value="all">Tous les états</option>
                        <option value="En attente">En attente</option>
                        <option value="Traité">Traité</option>
                    </select>
                </div>

                <input type="text" id="search-input" placeholder="Rechercher" class="filter-search" onkeyup="applyFilters()">
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nom / Prenom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Véhicule</th>
                        <th>Etat</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="essais-table-body">
                    @forelse($essais as $essai)
                        <tr class="js-essai-row" 
                            data-nom="{{ strtolower($essai->nom . ' ' . $essai->prenom) }}" 
                            data-vehicule="{{ $essai->produit_id ?? 'none' }}"
                            data-etat="{{ $essai->statut }}">
                            <td>
                                <span class="td-bold">{{ strtoupper($essai->nom) }} {{ $essai->prenom }}</span> <br>
                            </td>
                            <td class="td-bold">{{ $essai->email }}</td>
                            <td class="td-bold">{{ $essai->telephone }}</td>
                            <td class="td-bold">{{ $essai->produit->nom ?? 'Aucun' }}</td>
                            <td class="td-bold">{{ $essai->statut }}</td> 
                            <td class="text-right table-actions">
                                <a href="{{ route('admin.essaies.edit', $essai->id) }}" class="btn-edit" title="Modifier">📝</a>
                                <a href="{{ route('admin.essaies.delete', $essai->id) }}" class="btn-delete" title="Supprimer">✕</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center empty-row">Aucune demande d'essai enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Ajouter un essaie</h2>
            </div>
            <div class="card-body-actions">
                <a href="{{ route('admin.essaies.create') }}" class="btn-global-red">Ajouter un essai</a>
            </div>
        </div>
        
    </div>

    <script>
        function applyFilters() {
            const searchQuery = document.getElementById('search-input').value.toLowerCase();
            const vehiculeFilter = document.getElementById('filter-vehicule').value;
            const etatFilter = document.getElementById('filter-etat').value;
            
            const rows = document.querySelectorAll('.js-essai-row');

            rows.forEach(row => {
                const rowText = row.innerText.toLowerCase();
                const rowVehicule = row.getAttribute('data-vehicule');
                const rowEtat = row.getAttribute('data-etat');
                
                const matchesSearch = rowText.includes(searchQuery);
                const matchesVehicule = (vehiculeFilter === "all" || rowVehicule === vehiculeFilter);
                const matchesEtat = (etatFilter === "all" || rowEtat === etatFilter);

                if (matchesSearch && matchesVehicule && matchesEtat) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>