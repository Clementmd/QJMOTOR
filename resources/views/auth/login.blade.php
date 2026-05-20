<x-guest-layout>
    <x-slot name="title">
        Connexion Admin | QJMOTOR
    </x-slot>

    <div class="login-box">
        <div class="login-header">
            <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="login-logo">
            <h1 class="login-title">Bienvenue sur QJMOTOR</h1>
        </div>

        <h2 class="login-subtitle">Se connecter</h2>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-input">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" class="form-input">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Se connecter</button>
            </div>
        </form>
    </div>
</x-guest-layout>