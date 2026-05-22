<x-app-layout>
    <x-slot name="title">Catégories d'Actus | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Catégories d'actus</h1>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des catégories d'actus</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    <select id="filter-nom" class="filter-select">
                        <option value="all">Tous les noms</option>
                        @foreach($cat_actus as $cat)
                            <option value="{{ strtolower($cat->nom) }}">{{ $cat->nom }}</option>
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
                        <th>Nom</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="actus-table-body">
                    @forelse($cat_actus as $cat)
                        <tr class="js-cat-row" data-nom="{{ strtolower($cat->nom) }}">
                            <td class="td-bold">
                                {{ $cat->nom }}
                            </td>
                            <td class="text-right table-actions">
                                <a href="{{ route('admin.catactus.edit', $cat->id) }}" class="btn-edit" title="Modifier">📝</a>
                                <a href="{{ route('admin.catactus.delete', $cat->id) }}" class="btn-delete" title="Supprimer">
                                    ✕
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center empty-row">Aucune catégorie d'actu enregistrée.</td>
                        </tr>
                    @endforelse
                    
                    <tr id="no-match-row" style="display: none;">
                        <td colspan="2" class="text-center empty-row">Aucun résultat ne correspond à votre recherche.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Ajouter une catégorie d'actu</h2>
            </div>
            <div class="card-body-actions">
                <a href="{{ route('admin.catactus.create') }}" class="btn-global-red">Ajouter catégorie d'actus</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const filterNom = document.getElementById('filter-nom');
            const tableRows = document.querySelectorAll('.js-cat-row');
            const noMatchRow = document.getElementById('no-match-row');

            function performFilter() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const selectedNom = filterNom.value;
                let hasResults = false;

                tableRows.forEach(function (row) {
                    const rowNom = row.getAttribute('data-nom');

                    const matchesSearch = rowNom.includes(searchValue);
                    const matchesDropdown = (selectedNom === 'all' || rowNom === selectedNom);

                    if (matchesSearch && matchesDropdown) {
                        row.style.display = '';
                        hasResults = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (tableRows.length > 0) {
                    noMatchRow.style.display = hasResults ? 'none' : '';
                }
            }

            searchInput.addEventListener('input', performFilter);
            filterNom.addEventListener('change', performFilter);
        });
    </script>
</x-app-layout>