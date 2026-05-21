<x-app-layout>
    <x-slot name="title">Dashboard | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <h1 class="page-main-title">Dashboard</h1>

        <div class="dashboard-stats-grid">
            <div class="stat-card border-red">
                <div class="stat-info">
                    <span class="stat-number">{{ $countActus }}</span>
                    <span class="stat-label">Actualités</span>
                </div>
            </div>
            <div class="stat-card border-orange">
                <div class="stat-info">
                    <span class="stat-number">{{ $countCategories }}</span>
                    <span class="stat-label">Catégories Actus</span>
                </div>
            </div>
            <div class="stat-card border-blue">
                <div class="stat-info">
                    <span class="stat-number">{{ $countProduits }}</span>
                    <span class="stat-label">Véhicules</span>
                </div>
            </div>
            <div class="stat-card border-purple">
                <div class="stat-info">
                    <span class="stat-number">{{ $countTypes }}</span>
                    <span class="stat-label">Types</span>
                </div>
            </div>
            <div class="stat-card border-green">
                <div class="stat-info">
                    <span class="stat-number">{{ $countEssais }}</span>
                    <span class="stat-label">Essais</span>
                </div>
            </div>
        </div>


        <div class="card-box dashboard-section-gap">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Actualités</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    <select id="filter-actu-categorie" class="filter-select" onchange="filterDashboardActus()">
                        <option value="all">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" id="search-actus" placeholder="Rechercher une actualité..." class="filter-search" onkeyup="filterDashboardActus()">
            </div>

            <table class="custom-table table-sm">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="dashboard-actus-body">
                    @forelse($derniersActus as $actu)
                        <tr class="js-dashboard-actu-row" data-categorie="{{ $actu->categorie_id }}">
                            <td class="td-bold">{{ $actu->titre }}</td>
                            <td class="td-bold text-gray">{{ $actu->categorie->nom ?? 'Aucune' }}</td>
                            <td class="text-gray">{{ $actu->created_at->format('d/m/Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.actus.index') }}" class="btn-global-gray" style="padding: 4px 10px; font-size: 12px;">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center empty-row">Aucune actualité enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="card-box dashboard-section-gap">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Catégories d'actualités</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    <select id="filter-cat-nom" class="filter-select" onchange="filterDashboardCategories()">
                        <option value="all">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" id="search-categories" placeholder="Rechercher une catégorie..." class="filter-search" onkeyup="filterDashboardCategories()">
            </div>

            <table class="custom-table table-sm">
                <thead>
                    <tr>
                        <th>Nom de la catégorie</th>
                        <th>Date de création</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="dashboard-categories-body">
                    @forelse($categories as $cat)
                        <tr class="js-dashboard-cat-row" data-id="{{ $cat->id }}">
                            <td class="td-bold">{{ $cat->nom }}</td>
                            <td class="text-gray">{{ $cat->created_at->format('d/m/Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.categories.index') }}" class="btn-global-gray" style="padding: 4px 10px; font-size: 12px;">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center empty-row">Aucune catégorie enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="card-box dashboard-section-gap">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Véhicules </h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    <select id="filter-prod-type" class="filter-select" onchange="filterDashboardProduits()">
                        <option value="all">Tous les types </option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" id="search-produits" placeholder="Rechercher un véhicule..." class="filter-search" onkeyup="filterDashboardProduits()">
            </div>

            <table class="custom-table table-sm">
                <thead>
                    <tr>
                        <th>Modèle</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="dashboard-produits-body">
                    @forelse($tousLesProduits as $prod)
                        <tr class="js-dashboard-prod-row" data-type="{{ $prod->type_id }}">
                            <td class="td-bold">{{ $prod->nom }}</td>
                            <td class="td-bold text-gray">{{ $prod->type->nom ?? 'N/A' }}</td>
                            <td class="td-bold">{{ number_format($prod->prix, 2, ',', ' ') }} €</td>
                            <td class="text-right">
                                <a href="{{ route('admin.vehicules.index') }}" class="btn-global-gray" style="padding: 4px 10px; font-size: 12px;">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center empty-row">Aucun véhicule enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="card-box dashboard-section-gap">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Types de véhicules </h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Trier par :</span>
                    <select id="filter-type-nom" class="filter-select" onchange="filterDashboardTypes()">
                        <option value="all">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="text" id="search-types" placeholder="Rechercher un type..." class="filter-search" onkeyup="filterDashboardTypes()">
            </div>

            <table class="custom-table table-sm">
                <thead>
                    <tr>
                        <th>Nom du type</th>
                        <th>Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="dashboard-types-body">
                    @forelse($types as $type)
                        <tr class="js-dashboard-type-row" data-id="{{ $type->id }}">
                            <td class="td-bold">{{ $type->nom }}</td>
                            <td class="text-gray">{{ $type->created_at->format('d/m/Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.types.index') }}" class="btn-global-gray" style="padding: 4px 10px; font-size: 12px;">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center empty-row">Aucun type enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="card-box dashboard-section-gap">
            <div class="card-header">
                <span class="vertical-bar"></span>
                <h2 class="card-title">Essais</h2>
            </div>

            <div class="card-filters">
                <div class="filters-left">
                    <span class="filter-label">Filtrer par :</span>
                    <select id="filter-essai-nom" class="filter-select" onchange="filterDashboardEssais()">
                        <option value="all">Tous les noms</option>
                        @foreach($essaisDistincts->unique('nom') as $item)
                            <option value="{{ strtoupper($item->nom) }}">{{ strtoupper($item->nom) }}</option>
                        @endforeach
                    </select>

                    <select id="filter-essai-vehicule" class="filter-select" onchange="filterDashboardEssais()">
                        <option value="all">Tous les véhicules</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                        @endforeach
                    </select>

                    <select id="filter-essai-status" class="filter-select" onchange="filterDashboardEssais()">
                        <option value="all">Tous les états</option>
                        <option value="En attente">En attente</option>
                        <option value="Traité">Traité</option>
                    </select>
                </div>
                <input type="text" id="search-essais" placeholder="Rechercher un essai (Nom)..." class="filter-search" onkeyup="filterDashboardEssais()">
            </div>

            <table class="custom-table table-sm">
                <thead>
                    <tr>
                        <th>Nom / Prénom</th>
                        <th>Véhicule</th>
                        <th>Type </th>
                        <th>État</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="dashboard-essais-body">
                    @forelse($derniersEssais as $essai)
                        <tr class="js-dashboard-essai-row" 
                            data-nom="{{ strtoupper($essai->nom) }}" 
                            data-vehicule="{{ $essai->produit_id ?? 'none' }}" 
                            data-status="{{ $essai->statut }}">
                            <td class="td-bold">{{ strtoupper($essai->nom) }} {{ $essai->prenom }}</td>
                            <td class="td-bold text-gray">{{ $essai->produit->nom ?? 'Aucun' }}</td>
                            <td class="td-bold text-gray">{{ $essai->produit->type->nom ?? 'N/A' }}</td>
                            <td>
                                <span class="badge-status">{{ $essai->statut }}</span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.essaies.index') }}" class="btn-global-gray" style="padding: 4px 10px; font-size: 12px;">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center empty-row">Aucun essai enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function filterDashboardActus() {
            const searchQuery = document.getElementById('search-actus').value.toLowerCase();
            const categorieFilter = document.getElementById('filter-actu-categorie').value;

            document.querySelectorAll('.js-dashboard-actu-row').forEach(row => {
                const matchesSearch = row.innerText.toLowerCase().includes(searchQuery);
                const matchesCat = (categorieFilter === 'all' || row.getAttribute('data-categorie') === categorieFilter);
                row.style.display = (matchesSearch && matchesCat) ? '' : 'none';
            });
        }

        function filterDashboardCategories() {
            const searchQuery = document.getElementById('search-categories').value.toLowerCase();
            const catIdFilter = document.getElementById('filter-cat-nom').value;

            document.querySelectorAll('.js-dashboard-cat-row').forEach(row => {
                const matchesSearch = row.innerText.toLowerCase().includes(searchQuery);
                const matchesCatId = (catIdFilter === 'all' || row.getAttribute('data-id') === catIdFilter);
                row.style.display = (matchesSearch && matchesCatId) ? '' : 'none';
            });
        }

        function filterDashboardProduits() {
            const searchQuery = document.getElementById('search-produits').value.toLowerCase();
            const typeFilter = document.getElementById('filter-prod-type').value;

            document.querySelectorAll('.js-dashboard-prod-row').forEach(row => {
                const matchesSearch = row.innerText.toLowerCase().includes(searchQuery);
                const matchesType = (typeFilter === 'all' || row.getAttribute('data-type') === typeFilter);
                row.style.display = (matchesSearch && matchesType) ? '' : 'none';
            });
        }

        function filterDashboardTypes() {
            const searchQuery = document.getElementById('search-types').value.toLowerCase();
            const typeIdFilter = document.getElementById('filter-type-nom').value;

            document.querySelectorAll('.js-dashboard-type-row').forEach(row => {
                const matchesSearch = row.innerText.toLowerCase().includes(searchQuery);
                const matchesTypeId = (typeIdFilter === 'all' || row.getAttribute('data-id') === typeIdFilter);
                row.style.display = (matchesSearch && matchesTypeId) ? '' : 'none';
            });
        }

        function filterDashboardEssais() {
            const searchQuery = document.getElementById('search-essais').value.toLowerCase();
            const nomFilter = document.getElementById('filter-essai-nom').value;
            const vehiculeFilter = document.getElementById('filter-essai-vehicule').value;
            const statusFilter = document.getElementById('filter-essai-status').value;

            document.querySelectorAll('.js-dashboard-essai-row').forEach(row => {
                const matchesSearch = row.innerText.toLowerCase().includes(searchQuery);
                const matchesNom = (nomFilter === 'all' || row.getAttribute('data-nom') === nomFilter);
                const matchesVehicule = (vehiculeFilter === 'all' || row.getAttribute('data-vehicule') === vehiculeFilter);
                const matchesStatus = (statusFilter === 'all' || row.getAttribute('data-status') === statusFilter);

                row.style.display = (matchesSearch && matchesNom && matchesVehicule && matchesStatus) ? '' : 'none';
            });
        }
    </script>
</x-app-layout>