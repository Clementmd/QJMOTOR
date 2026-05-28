<x-app-layout>
    <x-slot name="title">Modifier un essai | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Modifier un essaie</h1>
            </div>

            <form action="{{ route('admin.essaies.update', $essai->id) }}" method="POST" class="standard-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="produit_id" class="form-label">Véhicule</label>
                    <select id="produit_id" name="produit_id" class="form-input">
                        <option value="" {{ is_null($essai->produit_id) ? 'selected' : '' }}>Aucun véhicule </option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" {{ old('produit_id', $essai->produit_id) == $produit->id ? 'selected' : '' }}>
                                {{ $produit->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('produit_id') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $essai->nom) }}" required class="form-input">
                    @error('nom') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $essai->prenom) }}" required class="form-input">
                    @error('prenom') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $essai->email) }}" required class="form-input">
                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $essai->telephone) }}" required class="form-input">
                    @error('telephone') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="statut" class="form-label">Statut</label>
                    <select id="statut" name="statut" required class="form-input">
                        <option value="En attente" {{ old('statut', $essai->statut) == 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Traité" {{ old('statut', $essai->statut) == 'Traité' ? 'selected' : '' }}>Traité</option>
                    </select>
                    @error('statut') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons-row justify-center">
                    <button type="submit" class="btn-global-green">Enregister</button>
                    <a href="{{ route('admin.essaies.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>