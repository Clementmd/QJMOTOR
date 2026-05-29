<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Concession QJMOTOR</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>

    <div id="app">
        <header-front 
            :menu="{{ json_encode($menuNavigation ?? []) }}"
            active-type-slug="{{ $activeTypeSlug ?? '' }}"
        ></header-front>

        <main>
            @if(isset($vehicule))
                <vehicule-front :id="{{ $vehicule->id }}"></vehicule-front>

            @elseif(isset($slug))
                <categorie-vehicules categorie-slug="{{ $slug }}"></categorie-vehicules>
            @else
                <home-front 
                    :produits="{{ json_encode($produits ?? []) }}" 
                    :actualites="{{ json_encode($actualites ?? []) }}">
                </home-front>
            @endif
        </main>

        <footer class="footer">
            <div class="logo">
                <img src="https://qjmotor.fr/wp-content/uploads/2024/10/QJ-Motors-Logo-107x72-c-default.webp" alt="QJMOTOR">
            </div>
            <div class="footer-top">
                <div class="footer-logo-col">
                    <img src="https://qjmotor.fr/wp-content/uploads/2024/10/QJ-Motors-Logo-white-113x66-c-default.webp" alt="QJMOTOR" class="footer-logo">
                </div>
                <div class="footer-nav-col">
                    <h4 class="footer-heading">PLAN DU SITE</h4>
                    <ul class="footer-links">
                        <li><a href="/">Accueil</a></li>
                        <li><a href="#">Gamme</a></li>
                        <li><a href="#">À propos de QJMOTOR</a></li>
                        <li><a href="#">Actualités</a></li>
                        <li><a href="#">Roadshows</a></li>
                        <li><a href="#">Revendeurs</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-sima-col">
                    <h4 class="footer-heading" style="margin-top:30px;">RÉSEAUX SOCIAUX</h4>
                    <div class="footer-socials">
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" width="28" height="28"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                        <a href="#" class="social-icon" aria-label="YouTube">
                            <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.4a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#D80C24"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Copyright © 2025 QJMOTOR Toulon – Tous droits réservés. Les photographies des véhicules présentés peuvent différer de la réalité. Les modèles présentés peuvent avoir des accessoires en option.</p>
                <p style="margin-top:10px;">Pour les trajets courts, privilégiez la marche ou le vélo<br><strong>#SeDeplacerMoinsPolluer</strong></p>
            </div>
            <div class="footer-legal">
                <a href="#">Mentions légales – Confidentialité</a>
            </div>
        </footer>

        <div class="floating-side">
            <div class="float-item test-drive">
                <div class="float-content">
                    <img src="../../images/casque.png" alt="Casque">
                    <span class="float-text">Demander un essai</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>