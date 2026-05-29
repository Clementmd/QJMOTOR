<template>
  <div v-if="vehicule" class="bike-page-wrapper">

    <section class="bike-hero-section" :style="{ backgroundImage: vehicule.image_fond ? `url('/storage/${vehicule.image_fond}')` : 'none', backgroundSize: 'cover', backgroundPosition: 'center' }">
        <div class="bike-hero-container">
            <div class="bike-hero-image">
                <img :src="'/storage/' + vehicule.image_principale" :alt="'QJMOTOR ' + vehicule.nom">
            </div>
            
            <div class="bike-hero-card">
                <div class="card-header">
                    <span class="bike-category">{{ vehicule.categorie?.nom || 'GAMME' }}</span>
                    <h1 class="bike-main-title">{{ vehicule.nom }}</h1>
                </div>
                
                <div class="bike-scrollable-desc specs-scroll-container" style="white-space: pre-line;">
                    {{ vehicule.caracteristiques }}
                </div>
                
                <div class="bike-quick-list">
                    <div class="quick-list-line">
                        <span class="label">COULEURS DISPONIBLES</span>
                        <div class="color-options">
                            <template v-if="vehicule.couleurs">
                                <span 
                                    v-for="(couleur, idx) in vehicule.couleurs.split(',')" 
                                    :key="idx" 
                                    class="circle-color" 
                                    :style="{ backgroundColor: couleur.trim().toLowerCase() }"
                                ></span>
                            </template>
                            <span v-else class="value-highlight">Standard</span>
                        </div>
                    </div>
                    <div class="quick-list-line">
                        <span class="label">PERMIS REQUIS</span>
                        <span class="value-highlight">{{ vehicule.permis || 'N/A' }}</span>
                    </div>
                    <div class="quick-list-line">
                        <span class="label">GARANTIE</span>
                        <span class="value-highlight">{{ vehicule.garantie}}</span>
                    </div>
                </div>
                
                <div class="bike-price-box">
                    <span class="price-label">PRIX PUBLIC TTC</span>
                    <span class="price-value">{{ formatPrix(vehicule.prix) }} €</span>
                </div>
            </div>
        </div>

        <div class="bike-bar-specs">
            <div class="bar-specs-grid">
                <div v-if="vehicule.cylindree" class="bar-spec-item">
                    <span class="spec-number">{{ vehicule.cylindree }} CM³</span>
                    <span class="spec-title">CYLINDRÉE</span>
                </div>
                <div v-if="vehicule.puissance" class="bar-spec-item">
                    <span class="spec-number">{{ vehicule.puissance }} CH</span>
                    <span class="spec-title">PUISSANCE</span>
                </div>
                <div v-if="vehicule.couple" class="bar-spec-item">
                    <span class="spec-number">{{ vehicule.couple }} NM</span>
                    <span class="spec-title">COUPLE MOTEUR</span>
                </div>
                <div v-if="vehicule.poids" class="bar-spec-item">
                    <span class="spec-number">{{ vehicule.poids }} KG</span>
                    <span class="spec-title">POIDS EN ORDRE DE MARCHE</span>
                </div>
            </div>
            <a href="#section-specs-table" class="btn-square btn-specs-trigger">VOIR LES CARACTÉRISTIQUES</a>
        </div>
    </section>

    <section class="short-desc-section" v-if="vehicule.description_courte">
        <div class="short-desc-container">
            <p class="short-desc-text">
                {{ vehicule.description_courte }}
            </p>
        </div>
    </section>

    <section class="bike-highlights-section" v-if="vehicule.images_carrousel && vehicule.images_carrousel.length > 0">
        <div class="swiper infoSwiper bike-highlights-slider">
            <div class="swiper-wrapper">
                
                <div 
                    v-for="(imagePath, index) in vehicule.images_carrousel" 
                    :key="index" 
                    class="swiper-slide highlight-slide"
                >
                    <div class="slide-content-layout">
                        <div class="slide-text">                            
                            <p class="editorial-p">
                                {{ vehicule.descriptions_carrousel[index] }}
                            </p>
                        </div>
                        <div class="slide-image">
                            <img :src="'/storage/' + imagePath" :alt="'Détail carrousel ' + index">
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <section class="bike-editorial-section">
        <div class="editorial-bg-watermark">RACING</div>
        <div class="editorial-container">
            <div class="editorial-grid">
                <div class="editorial-text-side">
                    <h2 class="editorial-title">
                        {{ vehicule.nom }} <br>
                        <span class="accent-red">{{ vehicule.titre || 'LA PERFORMANCE PURE' }}</span>
                    </h2>
                    <div class="editorial-divider"></div>
                    
                    <div class="editorial-content">
                        <div v-if="vehicule.description" style="white-space: pre-line;">
                            {{ vehicule.description }}
                        </div>
                    </div>
                </div>

                <div class="editorial-image-side">
                    <div class="editorial-img-wrapper">
                        <img :src="'/storage/' + vehicule.image_principale" :alt="'Détail ' + vehicule.nom">
                        <div class="editorial-image-frame"></div>
                        
                        <div v-if="vehicule.cylindree" class="editorial-floating-badge">
                            <span class="badge-number">{{ vehicule.cylindree }}</span>
                            <span class="badge-unit">CM³ DE PURE PUISSANCE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bike-gallery-section" v-if="vehicule.galeries_photos && vehicule.galeries_photos.length > 0">
        <div class="gallery-grid">
            <div v-for="(galerieImg, idx) in vehicule.galeries_photos" :key="idx" class="gallery-item">
                <img :src="'/storage/' + galerieImg" :alt="'Galerie ' + vehicule.nom">
            </div>
        </div>
    </section>

    <section id="section-specs-table" class="bike-table-section">
        <div class="table-container">
            <div class="section-title-container">
                <h2 class="section-main-title">CARACTÉRISTIQUES</h2>
            </div>
            
            <table class="specs-full-table">
                <thead><tr><th colspan="2">SPÉCIFICATIONS TECHNIQUES</th></tr></thead>
                <tbody>
                    <tr v-if="vehicule.cylindree"><td>Cylindrée</td><td>{{ vehicule.cylindree }} cm³</td></tr>
                    <tr v-if="vehicule.puissance"><td>Puissance max</td><td>{{ vehicule.puissance }} ch</td></tr>
                    <tr v-if="vehicule.couple"><td>Couple max</td><td>{{ vehicule.couple }} Nm</td></tr>
                    <tr v-if="vehicule.poids"><td>Poids en ordre de marche</td><td>{{ vehicule.poids }} kg</td></tr>
                    <tr><td>Statut</td><td>{{ vehicule.actif ? 'Disponible en concession' : 'Bientôt disponible' }}</td></tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="bike-related-section">
        <div class="section-title-container">
            <h2 class="section-main-title">GAMME {{ vehicule.categorie?.nom || 'MOTOS' }}</h2>
        </div>

        <div class="related-grid" v-if="relatedVehicules.length > 0">
            <div v-for="moto in relatedVehicules" :key="moto.id" class="model-card">
                
                <div class="model-img-wrapper">
                    <img :src="'/storage/' + moto.image_principale" :alt="moto.nom">
                </div>

                <div class="model-info">
                    <h3 class="model-name">{{ moto.nom }}</h3>
                    <p class="model-range">{{ moto.categorie?.nom }}</p>

                    <div class="model-specs">
                        <div class="spec-line">
                            <span class="label">PERMIS</span>
                            <span class="value">{{ moto.permis }}</span>
                        </div>
                        <div class="spec-line">
                            <span class="label">CYLINDRÉE</span>
                            <span class="value">{{ moto.cylindree }} CM³</span>
                        </div>
                        <div class="spec-line">
                            <span class="label">COULEURS</span>
                            <div class="color-options">
                                <span 
                                    v-for="(c, idx) in (moto.couleurs ? moto.couleurs.split(',') : [])" 
                                    :key="idx" 
                                    class="circle-color" 
                                    :style="{ backgroundColor: c.trim().toLowerCase() }">
                                </span>
                            </div>
                        </div>
                    </div>

                    <a :href="'/' + (moto.type?.nom?.toLowerCase() || 'moto') + '/' + moto.id" class="btn-square">VOIR LE MODÈLE</a>
                </div>
            </div>
        </div>

        <div v-else class="no-related">
            <p>Pas encore d'autres modèles disponibles dans cette catégorie.</p>
        </div>
    </section>
  </div>
  
</template>

<script>
import axios from 'axios';
import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

export default {
    name: 'VehiculesFront',
    props: ['id'],
    data() {
        return {
            vehicule: null,
            isLoading: true,
            tousLesVehicules: []
        };
    },
    computed: {
        relatedVehicules() {
            if (!this.vehicule || !this.tousLesVehicules) return [];
            return this.tousLesVehicules.filter(v => 
                v.categorie_id === this.vehicule.categorie_id && v.id !== this.vehicule.id
            );
        }
    },
    mounted() {
        this.fetchVehicule();
    },
    methods: {
        async fetchVehicule() {
            try {
                this.isLoading = true;
                const response = await axios.get(`/api/front/vehicules/${this.id}`);
                this.vehicule = response.data;

                this.$nextTick(() => {
                    new Swiper(".infoSwiper", {
                        modules: [Navigation],
                        loop: true,
                        slidesPerView: 1, 
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                });
            } catch (error) {
                console.error("Erreur de chargement :", error);
            } finally {
                this.isLoading = false;
            }
        },
        formatPrix(prix) {
            return prix ? Number(prix).toLocaleString('fr-FR') : '0';
        }
    }
}
</script>