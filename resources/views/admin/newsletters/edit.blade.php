<x-app-layout>
    <x-slot name="title">Modifier un inscrit | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">

            <div class="card-header-form">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title">Modifier un inscrit</h1>
            </div>

            <form action="{{ route('admin.newsletters.update', $newsletter->id) }}" method="POST" class="standard-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $newsletter->nom) }}" required class="form-input" autofocus>
                    @error('nom') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $newsletter->email) }}" required class="form-input">
                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn-global-green">Enregistrer</button>
                    <a href="{{ route('admin.newsletters.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>