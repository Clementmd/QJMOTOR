<header class="main-header">    
    <div class="logo">
        <img src="{{ asset('images/logo-qjmotor.webp') }}" alt="QJMOTOR" class="form-logo" style="height: 50px;">
    </div>
    <nav>
        <ul class="nav-list" id="nav-list">
            @auth
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Accueil</a>
                </li>
                
                <li>
                    <a href="{{ route('admin.types.index') }}" class="nav-link {{ request()->routeIs('admin.types.index') ? 'active' : '' }}">
                        Types de vehicules
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" class="nav-link">
                        Categories
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.vehicules.index') }}" class="nav-link {{ request()->routeIs('admin.vehicules.index') ? 'active' : '' }}" class="nav-link">
                        Vehicules
                    </a>
                </li>
                
                <li class="dropdown">
                    <a href="{{ route('admin.actus.index') }}" class="nav-link {{ request()->routeIs('admin.actus.index') ? 'active' : '' }}" class="nav-link">Actus ▾</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('admin.catactus.index') }}" class="nav-link {{ request()->routeIs('admin.catactus.index') ? 'active' : '' }}" class="nav-link">
                                Categories d'actus
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#" class="nav-link">Essaie</a>
                </li>
                
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout" style="background: none; border: none; cursor: pointer;">Se déconnecter</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
</header>