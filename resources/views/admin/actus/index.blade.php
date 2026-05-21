<x-app-layout>
    <x-slot name="title">Gestion des Actus | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Actus</h1>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des actus</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left" style="display: flex; gap: 15px; align-items: center;">
                    <span class="filter-label">Trier par :</span>
                    
                    <select id="filter-titre" class="filter-select">
                        <option value="all">Toues les titres</option>
                        @foreach($actus as $article)
                            <option value="{{ strtolower($article->titre) }}">{{ $article->titre }}</option>
                        @endforeach
                    </select>

                    <select id="filter-categorie" class="filter-select">
                        <option value="all">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
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
                        <th>Titre</th>
                        <th>Categorie</th>
                        <th>Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="actus-table-body">
                    @forelse($actus as $article)
                        <tr class="js-actu-row" 
                            data-titre="{{ strtolower($article->titre) }}" 
                            data-cat-id="{{ $article->cat_actu_id }}">
                            
                            <td class="td-bold">
                                {{ $article->titre }}
                            </td>
                            <td class="td-bold">
                                {{ $article->categorie->nom }}
                            </td>

                            <td class="td-bold">
                                {{ $article->date_publication->format('d/m/Y') }}
                            </td>

                            <td class="text-right table-actions">
                                <a href="{{ route('admin.actus.edit', $article->id) }}"class="btn-edit" title="Modifier">📝</a>
                                <a href="#" class="btn-delete" title="Supprimer">✕</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center empty-row">Aucune actualité enregistrée.</td>
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
                <h2 class="card-title">Ajouter une actu</h2>
            </div>
            <div class="card-body-actions">
                <a href="{{ route('admin.actus.create') }}"class="btn-global-red">Ajouter Actu</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const filterTitre = document.getElementById('filter-titre');
            const filterCategorie = document.getElementById('filter-categorie');
            const tableRows = document.querySelectorAll('.js-actu-row');
            const noMatchRow = document.getElementById('no-match-row');

            function performFilter() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const selectedTitre = filterTitre.value;
                const selectedCatId = filterCategorie.value;
                let hasResults = false;

                tableRows.forEach(function (row) {
                    const rowTitre = row.getAttribute('data-titre');
                    const rowCatId = row.getAttribute('data-cat-id');

                    const matchesSearch = rowTitre.includes(searchValue);
                    const matchesTitreDropdown = (selectedTitre === 'all' || rowTitre === selectedTitre);
                    const matchesCatDropdown = (selectedCatId === 'all' || rowCatId === selectedCatId);

                    if (matchesSearch && matchesTitreDropdown && matchesCatDropdown) {
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
            filterTitre.addEventListener('change', performFilter);
            filterCategorie.addEventListener('change', performFilter);
        });
    </script>
</x-app-layout>