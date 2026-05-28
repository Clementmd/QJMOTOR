<x-app-layout>
    <x-slot name="title">Modifier une catégorie d'actu | QJMOTOR</x-slot>

    <div class="admin-wrapper">
        <div class="card-box card-box-small">
            
            <div class="card-header-form" style="justify-content: center; gap: 15px; margin-bottom: 25px;">
                <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-header-logo">
                <h1 class="form-header-title" style="margin: 0; font-size: 24px;">Modifier une catégorie d'actu</h1>
            </div>

            <form action="{{ route('admin.catactus.update', $cat->id) }}" method="POST" class="standard-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nom" class="form-label" style="font-weight: 600; font-size: 16px; color: #1e293b;">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $cat->nom) }}" required class="form-input" autofocus style="margin-top: 8px;">
                    @error('nom') <span class="error-message" style="color: #dc2626; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-buttons-row" style="justify-content: center; gap: 20px; margin-top: 30px;">
                    <button type="submit" class="btn-global-green">Enregister</button>
                    <a href="{{ route('admin.catactus.index') }}" class="btn-global-gray">Annuler</a>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>