<x-app-layout>
    <x-slot name="title">Véhicules | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Véhicules</h1>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des véhicules</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left" style="flex-wrap: wrap; gap: 10px;">
                    <span class="filter-label">Trier par :</span>
                    
                    <select id="filter-nom" class="filter-select">
                        <option value="all">Tous les noms</option>
                        @foreach($vehicules as $vehicule)
                            <option value="{{ strtolower($vehicule->nom) }}">{{ $vehicule->nom }}</option>
                        @endforeach
                    </select>

                    <select id="filter-type" class="filter-select">
                        <option value="all">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ strtolower($type->nom) }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>

                    <select id="filter-categorie" class="filter-select">
                        <option value="all">Toutes les catégories</option>
                        @foreach($categories as $categorie)
                            <option value="{{ strtolower($categorie->nom) }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>

                    <select id="filter-etat" class="filter-select">
                        <option value="all">Tous les états</option>
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
                
                <div class="filters-right">
                    <input type="text" id="search-input" placeholder="Rechercher..." class="filter-search">
                </div>
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>TYPE</th>
                        <th>CATÉGORIE</th>
                        <th>PRIX</th>
                        <th>CYLINDREE</th>
                        <th>PUISSANCE</th>
                        <th>POIDS</th>
                        <th>COUPLE</th>
                        <th>ETAT</th>
                        <th class="text-right">ACTION</th>
                    </tr>
                </thead>
                <tbody id="vehicules-table-body">
                    @forelse($vehicules as $vehicule)
                        <tr class="js-vehicule-row" 
                            data-nom="{{ strtolower($vehicule->nom) }}" 
                            data-type="{{ strtolower($vehicule->type->nom ?? '') }}"
                            data-categorie="{{ strtolower($vehicule->categorie->nom ?? '') }}"
                            data-actif="{{ $vehicule->actif ? '1' : '0' }}">
                            
                            <td class="td-bold">
                                <span>{{ $vehicule->nom }}</span>
                            </td>
                            <td class="td-bold">
                                <span>{{ $vehicule->type->nom ?? 'Sans type' }}</span>
                            </td>
                            <td class="td-bold">
                                <span>{{ $vehicule->categorie->nom ?? 'Sans catégorie' }}</span>

                            </td>
                            <td class="td-bold">
                                <span>{{ number_format($vehicule->prix, 0, ',', ' ') }} €</span>
                            </td>
                            <td class="td-bold">
                                <span>{{ $vehicule->cylindree ?? 'N/A' }} CM³</span>
                            </td>
                            <td class="td-bold">
                                <span>{{ $vehicule->puissance ?? 'N/A' }} CH</span>
                            </td>
                            <td class="td-bold">
                                <span>{{ $vehicule->poids ?? 'N/A' }} kg</span>
                            </td>
                            <td class="td-bold">
                                <span>{{ $vehicule->couple ?? 'N/A' }} Nm</span>
                            </td>
                            <td class="td-bold">
                                @if($vehicule->actif)
                                    <span style="color: #10b981; font-weight: 600;">Actif</span>
                                @else
                                    <span style="color: #ef4444; font-weight: 600;">Inactif</span>
                                @endif
                            </td>  
                            <td class="text-right table-actions">
                                <a href="{{ route('admin.vehicules.edit', $vehicule->id) }}" class="btn-edit" title="Modifier">📝</a>
                                <a href="{{ route('admin.vehicules.delete', $vehicule->id) }}" class="btn-delete" title="Supprimer">✕</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center empty-row">Aucun véhicule enregistré pour le moment.</td>
                        </tr>
                    @endforelse
                    
                    <tr id="no-match-row" style="display: none;">
                        <td colspan="2" class="text-center empty-row">Aucun résultat ne correspond à vos critères de recherche.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Ajouter un véhicule</h2>
            </div>
            <div class="card-body-actions">
                <a href="{{ route('admin.vehicules.create') }}" class="btn-global-red">Ajouter véhicule</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const filterNom = document.getElementById('filter-nom');
            const filterType = document.getElementById('filter-type');
            const filterCategorie = document.getElementById('filter-categorie');
            const filterEtat = document.getElementById('filter-etat');
            const tableRows = document.querySelectorAll('.js-vehicule-row');
            const noMatchRow = document.getElementById('no-match-row');

            function filterVehicules() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const selectedNom = filterNom.value;
                const selectedType = filterType.value;
                const selectedCategorie = filterCategorie.value;
                const selectedEtat = filterEtat.value;
                
                let hasVisibleRow = false;

                tableRows.forEach(function (row) {
                    const rowNom = row.getAttribute('data-nom');
                    const rowType = row.getAttribute('data-type');
                    const rowCategorie = row.getAttribute('data-categorie');
                    const rowActif = row.getAttribute('data-actif');

                    const matchesSearch = rowNom.includes(searchValue) || 
                                          rowType.includes(searchValue) || 
                                          rowCategorie.includes(searchValue);

                    const matchesNom = (selectedNom === 'all' || rowNom === selectedNom);
                    const matchesType = (selectedType === 'all' || rowType === selectedType);
                    const matchesCategorie = (selectedCategorie === 'all' || rowCategorie === selectedCategorie);
                    const matchesEtat = (selectedEtat === 'all' || rowActif === selectedEtat);

                    if (matchesSearch && matchesNom && matchesType && matchesCategorie && matchesEtat) {
                        row.style.display = '';
                        hasVisibleRow = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (tableRows.length > 0) {
                    noMatchRow.style.display = hasVisibleRow ? 'none' : '';
                }
            }

            searchInput.addEventListener('input', filterVehicules);
            filterNom.addEventListener('change', filterVehicules);
            filterType.addEventListener('change', filterVehicules);
            filterCategorie.addEventListener('change', filterVehicules);
            filterEtat.addEventListener('change', filterVehicules);
        });
    </script>
</x-app-layout>