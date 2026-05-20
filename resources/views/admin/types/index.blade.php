<x-app-layout>
    <x-slot name="title">Types de Véhicules | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Types de Véhicules</h1>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des types de véhicules</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    <select id="sort-select" class="filter-select">
                        <option value="all">Tous les noms</option>
                        @foreach($types as $type)
                            <option value="{{ strtolower($type->nom) }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filters-right">
                    <input type="text" id="search-input" placeholder="Rechercher un type" class="filter-search">
                </div>
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th class="text-right">ACTION</th>
                    </tr>
                </thead>
                <tbody id="types-table-body">
                    @forelse($types as $type)
                        <tr class="js-type-row" data-nom="{{ strtolower($type->nom) }}">
                            <td class="td-bold js-type-nom">{{ $type->nom }}</td>
                            <td class="text-right table-actions">
                                <a href="{{ route('admin.types.edit', $type->id) }}" class="btn-edit" title="Modifier">📝</a>
                                <a href="{{ route('admin.types.delete', $type->id) }}" class="btn-delete" title="Supprimer">✕</a>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row-msg">
                            <td colspan="2" class="text-center empty-row">Aucun type de véhicule enregistré pour le moment.</td>
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
                <h2 class="card-title">Ajouter un type de véhicules</h2>
            </div>
            <div class="card-body-actions">
                <a href="{{ route('admin.types.create') }}" class="btn-global-red">Ajouter Type</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const tableRows = document.querySelectorAll('.js-type-row');
            const noMatchRow = document.getElementById('no-match-row');

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const selectedType = sortSelect.value;
                let hasVisibleRow = false;

                tableRows.forEach(function (row) {
                    const rowNom = row.getAttribute('data-nom');
                    
                    const matchesSearch = rowNom.includes(searchValue);
                    
                    const matchesDropdown = (selectedType === 'all' || rowNom === selectedType);

                    if (matchesSearch && matchesDropdown) {
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

            searchInput.addEventListener('input', filterTable);
            sortSelect.addEventListener('change', filterTable);
        });
    </script>
</x-app-layout>