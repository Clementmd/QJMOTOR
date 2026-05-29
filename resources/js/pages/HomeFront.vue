<template>
    <div>
        <section class="hero">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="https://qjmotor.fr/wp-content/uploads/2026/05/Banner-site-1920x750-1min9s-0001-1672.mp4" type="video/mp4">
            </video>
            <div class="hero-overlay">
                <div class="hero-content reveal">
                    <h1 class="hero-title">DOMINEZ <br><span>LA ROUTE</span></h1>
                    <p class="hero-subtitle">VIVEZ L'EXPÉRIENCE QJMOTOR</p>
                </div>
            </div>
        </section>

        <section class="notre-gamme reveal">
            <h2 class="section-title">NOS GAMMES DE MOTOS</h2>
            <div class="gamme-grid">
                <div class="gamme-card">
                    <img src="https://qjmotor.fr/wp-content/uploads/2025/12/Carre-cat2-1-859x733-c-default.webp" alt="Sport Racing">
                    <div class="overlay"><h3>SPORT RACING</h3></div>
                </div>
                <div class="gamme-card">
                    <img src="https://qjmotor.fr/wp-content/uploads/2025/12/Carre-cat-1-859x733-c-default.webp" alt="Sport Naked">
                    <div class="overlay"><h3>SPORT NAKED</h3></div>
                </div>
                <div class="gamme-card">
                    <img src="https://qjmotor.fr/wp-content/uploads/2025/03/Cat-carre3-871x744-c-default.webp" alt="Adventure">
                    <div class="overlay"><h3>ADVENTURE</h3></div>
                </div>
                <div class="gamme-card">
                    <img src="https://qjmotor.fr/wp-content/uploads/2025/12/Carre-cat3-859x733-c-default.webp" alt="Street Cruiser">
                    <div class="overlay"><h3>STREET CRUISER</h3></div>
                </div>
            </div>
        </section>

        <section class="product-carousel-section">
            <div class="section-header-container">
                <h2 class="section-title">NOS PRODUITS</h2>
            </div>
            <div class="bg-logo-watermark">QJ</div>
            
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    
                    <div v-for="produit in produits" :key="produit.id" class="swiper-slide">
                        <div class="product-container">
                            <div class="product-image">
                                <img :src="'/storage/' + produit.image_principale" :alt="produit.nom">
                            </div>
                            <div class="product-info-card">
                                <span v-if="produit.badge" class="badge-nouveaute">{{ produit.badge }}</span>
                                <h2>{{ produit.nom }}</h2>
                                
                                <div class="specs-scroll-container">
                                    <ul v-if="Array.isArray(produit.caracteristiques)" class="specs-list">
                                        <li v-for="(spec, index) in produit.caracteristiques" :key="index">
                                            {{ spec }}
                                        </li>
                                    </ul>

                                    <div v-else class="specs-text" style="white-space: pre-line;">
                                        {{ produit.caracteristiques }}
                                    </div>

                                </div>
                             
                                <div class="product-tags">
                                    <span class="tag" v-if="produit.categorie">{{ produit.categorie.nom }}</span>
                                    <span class="tag" v-if="produit.permis">{{ produit.permis }}</span>
                                    <span class="tag" v-if="produit.cylindree">{{ produit.cylindree }} CM³</span>
                                </div>
                                <div class="price">{{ formatPrix(produit.prix) }} €</div>
                                <a :href="'/moto/' + produit.id" class="btn-line">
                                    VOIR LA FICHE PRODUIT
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <section class="secondary-video-section reveal">
            <div class="video-full-width">
                <video autoplay muted loop playsinline class="bg-video">
                    <source src="https://qjmotor.fr/wp-content/uploads/2026/02/QJMOTOR-New-factory_.mp4" type="video/mp4">
                </video>
                <div class="video-overlay-text">
                    <span>DÉCOUVREZ</span>
                    <h3>L'USINE QJMOTOR</h3>
                </div>
            </div>
        </section>

        <section class="info-carousel-section reveal">
            <div class="swiper infoSwiper">
                <div class="swiper-wrapper">
                    
                    <div class="swiper-slide">
                        <div class="info-slide-content">
                            <div class="slide-text">
                                <h2>Usines QJMOTOR</h2>
                                <p>QJMOTOR possède trois usines locales conformes à la norme IATF 16949, produisant plus de 200 000 véhicules par an.</p>
                                <p>La marque possède également 10 usines CKD à l’étranger pour assembler ses véhicules.</p>
                            </div>
                            <div class="slide-img">
                                <img src="https://qjmotor.fr/wp-content/uploads/2024/06/QJ-Page-Actu-2024-15-1134x842-c-default.webp" alt="Usines QJMOTOR">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="info-slide-content">
                            <div class="slide-text">
                                <h2>QJMOTOR et la SRK 800 RR en World Supersport 2025</h2>
                                <p>Raffaele De Rosa et Niki Tuuli participeront au Championnat d’Europe Supersport 2025 pour QJMOTOR Factory Racing Team.</p>
                            </div>
                            <div class="slide-img">
                                <img src="https://qjmotor.fr/wp-content/uploads/2025/02/000084_T02_Wss_2025-4000x2667-c-default.webp" alt="SRK 800 RR">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="info-slide-content">
                            <div class="slide-text">
                                <h2>QJMOTOR en Moto 2 avec le team MSI</h2>
                                <p>QJMOTOR officialise son partenariat avec l'équipe MSI pour la saison 2025 de Moto 2.</p>
                            </div>
                            <div class="slide-img">
                                <img src="https://qjmotor.fr/wp-content/uploads/2025/02/Foto-18-2-25-15-49-52-1-1-3607x2406-c-default.webp" alt="Moto2 QJMOTOR">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="info-slide-content">
                            <div class="slide-text">
                                <h2>Caractéristiques moteur</h2>
                                <p>QJMOTOR a introduit le premier moteur 4-cylindres en Chine ainsi que de grosses cylindrées grâce au R&D Chine & Italie.</p>
                            </div>
                            <div class="slide-img">
                                <img src="https://qjmotor.fr/wp-content/uploads/2024/06/QJ-Page-Actu-2024-16-1134x842-c-default.webp" alt="Moteur QJMOTOR">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <section class="actualites-section reveal">
            <div class="section-header-container">
                <h2 class="section-title">ACTUALITÉS QJMOTOR</h2>
            </div>

            <div class="actualites-bg">
                <div class="actualites-grid">
                    
                    <div v-for="actu in actualites" :key="actu.id" class="actu-card">
                        <div class="actu-img">
                            <img :src="'/storage/' + actu.image_couverture" :alt="actu.titre">
                        </div>
                        <div class="actu-body">
                            <h3>{{ actu.titre.toUpperCase() }}</h3>
                            <a :href="'/actualites/' + actu.slug" class="btn-actu">EN SAVOIR PLUS</a>
                        </div>
                    </div>

                </div>

                <div class="actualites-footer">
                    <a href="/actualites" class="btn-toutes-actu">TOUTES LES ACTUALITÉS</a>
                </div>
            </div>
        </section>

        <section class="partenaires-section reveal">
            <div class="section-header-container">
                <h2 class="section-title">PARTENAIRES ET COMPOSANTS</h2>
            </div>
            <div class="swiper partenairesSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide partenaire-logo"><img src="https://qjmotor.fr/wp-content/uploads/2024/05/KYB-160-160x70-c-default.webp" alt="KYB"></div>
                    <div class="swiper-slide partenaire-logo"><img src="https://qjmotor.fr/wp-content/uploads/2024/05/Bosch-160-160x70-c-default.webp" alt="Bosch"></div>
                    <div class="swiper-slide partenaire-logo"><img src="https://qjmotor.fr/wp-content/uploads/2025/06/sticker-metzeler-ref-5-tuning-audio-sonorisation-car-auto-moto-camion-competition-deco-rallye-autocollant-min-e1748958004548-210x70-c-default.webp" alt="Metzeler"></div>
                    <div class="swiper-slide partenaire-logo"><img src="https://qjmotor.fr/wp-content/uploads/2024/05/Marzocchi-160-160x70-c-default.webp" alt="Marzocchi"></div>
                    <div class="swiper-slide partenaire-logo"><img src="https://qjmotor.fr/wp-content/uploads/2024/05/Brembo-160-160x70-c-default.webp" alt="Brembo"></div>
                    <div class="swiper-slide partenaire-logo"><img src="https://qjmotor.fr/wp-content/uploads/2024/05/Regina-Chain-160-160x70-c-default.webp" alt="Regina Chain"></div>
                </div>
            </div>
        </section>

        
    </div>
</template>

<script setup>
import { onMounted, nextTick } from 'vue'

const props = defineProps({
    produits: { type: Array, default: () => [] },
    actualites: { type: Array, default: () => [] }
})

const formatPrix = (prix) => {
    return new Intl.NumberFormat('fr-FR').format(prix)
}

onMounted(async () => {
    await nextTick()

    if (typeof Swiper !== 'undefined') {
        new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: props.produits.length > 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        new Swiper(".infoSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        new Swiper(".partenairesSwiper", {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            speed: 4000, 
            allowTouchMove: false, 
            autoplay: {
                delay: 0, 
                disableOnInteraction: false,
            },
            freeMode: {
                enabled: true,
                momentum: false,
            },
            breakpoints: {
                640: { slidesPerView: 3, spaceBetween: 40 },
                1024: { slidesPerView: 5, spaceBetween: 50 }
            }
        });
    }

    const reveals = document.querySelectorAll('.reveal');
    const revealOnScroll = () => {
        reveals.forEach(reveal => {
            const windowHeight = window.innerHeight;
            const elementTop = reveal.getBoundingClientRect().top;
            const elementVisible = 150;
            if (elementTop < windowHeight - elementVisible) {
                reveal.classList.add('active');
            }
        });
    };
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); 
})
</script>