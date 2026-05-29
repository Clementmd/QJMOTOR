<x-app-layout>
    <x-slot name="title">Gestion des Newsletters | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Newsletters</h1>

        <div class="card-box">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Liste des inscrits</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left" style="display: flex; gap: 15px; align-items: center;">
                    <span class="filter-label">Trier par :</span>
                    <select id="filter-nom" class="filter-select">
                        <option value="all">Tous les noms</option>
                        @foreach($newsletters as $nl)
                            <option value="{{ strtolower($nl->nom) }}">{{ $nl->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filters-right">
                    <input type="text" id="search-input" placeholder="Rechercher..." class="filter-search">
                </div>
            </div>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Date d'inscription</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="newsletters-table-body">
                    @forelse($newsletters as $nl)
                        <tr class="js-nl-row" data-nom="{{ strtolower($nl->nom) }}">
                            <td class="td-bold">{{ $nl->nom }}</td>
                            <td class="td-bold">{{ $nl->email }}</td>
                            <td class="td-bold">{{ $nl->created_at->format('d/m/Y') }}</td>
                            <td class="text-right table-actions">
                                <a href="{{ route('admin.newsletters.edit', $nl->id) }}" class="btn-edit" title="Modifier">📝</a>
                                <a href="{{ route('admin.newsletters.delete', $nl->id) }}" class="btn-delete" title="Supprimer">✕</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center empty-row">Aucun inscrit pour le moment.</td>
                        </tr>
                    @endforelse

                    <tr id="no-match-row" style="display: none;">
                        <td colspan="4" class="text-center empty-row">Aucun résultat ne correspond à votre recherche.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const filterNom = document.getElementById('filter-nom');
            const tableRows = document.querySelectorAll('.js-nl-row');
            const noMatchRow = document.getElementById('no-match-row');

            function performFilter() {
                const searchValue = searchInput.value.toLowerCase().trim();
                const selectedNom = filterNom.value;
                let hasResults = false;

                tableRows.forEach(function (row) {
                    const rowNom = row.getAttribute('data-nom');
                    const matchesSearch = rowNom.includes(searchValue);
                    const matchesNomDropdown = (selectedNom === 'all' || rowNom === selectedNom);

                    if (matchesSearch && matchesNomDropdown) {
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