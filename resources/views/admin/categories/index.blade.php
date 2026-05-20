<x-app-layout>
    <x-slot name="title">Catégories | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Catégories</h1>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des catégories</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    
                    <select id="filter-nom-select" class="filter-select">
                        <option value="all">Tous les noms</option>
                        @foreach($categories as $categorie)
                            <option value="{{ strtolower($categorie->nom) }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>

                    <select id="filter-type-select" class="filter-select">
                        <option value="all">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ strtolower($type->nom) }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filters-right">
                    <input type="text" id="search-input" placeholder="Rechercher..." class="filter-search">
                </div>
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>NOM </th>
                        <th>TYPE</th>
                        <th class="text-right">ACTION</th>
                    </tr>
                </thead>
                <tbody id="categories-table-body">
                    @forelse($categories as $categorie)
                        <tr class="js-categorie-row" 
                            data-nom="{{ strtolower($categorie->nom) }}" 
                            data-type="{{ strtolower($categorie->type->nom ?? '') }}">
                            
                            <td class="td-bold">
                                <span class="js-item-nom">{{ $categorie->nom }}</span> 
                                
                            </td>
                            <td class="td-bold">
                                <span class="js-item-nom">
                                    {{ $categorie->type->nom ?? 'Sans type' }}
                                </span>
                            </td>
                            
                            <td class="text-right table-actions">
                                <a href="{{ route('admin.categories.edit', $categorie->id) }}" class="btn-edit" title="Modifier">📝</a>
                                <a href="{{ route('admin.categories.delete', $categorie->id) }}" class="btn-delete" title="Supprimer">✕</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center empty-row">Aucune catégorie enregistrée pour le moment.</td>
                        </tr>
                    @endforelse
                    
                    <tr id="no-match-row" style="display: none;">
                        <td colspan="2" class="text-center empty-row">Aucun résultat ne correspond à vos critères.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Ajouter une catégorie</h2>
            </div>
            <div class="card-body-actions">
                <a href="{{ route('admin.categories.create') }}" class="btn-global-red">Ajouter Catégorie</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const filterNomSelect = document.getElementById('filter-nom-select');
            const filterTypeSelect = document.getElementById('filter-type-select');
            const tableRows = document.querySelectorAll('.js-categorie-row');
            const noMatchRow = document.getElementById('no-match-row');

            function applyFilters() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const selectedNom = filterNomSelect.value;
                const selectedType = filterTypeSelect.value;
                let hasVisibleRow = false;

                tableRows.forEach(function (row) {
                    const rowNom = row.getAttribute('data-nom');
                    const rowType = row.getAttribute('data-type');

                    const matchesSearch = rowNom.includes(searchValue) || rowType.includes(searchValue);
                    const matchesNomDropdown = (selectedNom === 'all' || rowNom === selectedNom);
                    const matchesTypeDropdown = (selectedType === 'all' || rowType === selectedType);

                    if (matchesSearch && matchesNomDropdown && matchesTypeDropdown) {
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

            searchInput.addEventListener('input', applyFilters);
            filterNomSelect.addEventListener('change', applyFilters);
            filterTypeSelect.addEventListener('change', applyFilters);
        });
    </script>
</x-app-layout>