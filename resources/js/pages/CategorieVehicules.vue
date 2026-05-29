<template>
    <div v-if="loading" class="loading">Chargement...</div>

    <div v-else-if="categorie">
        <section
            class="gamme-hero"
            :style="categorie.image_fond
                ? 'background-image: url(/storage/' + categorie.image_fond + ')'
                : 'background-image: url(https://qjmotor.fr/wp-content/uploads/2025/12/QJ-Bandeau-Gamme-2.webp)'"
        >
            <div class="hero-overlay"></div>
            <div class="hero-container">
                <div class="hero-content">
                    <h1>{{ categorie.titre ? categorie.titre.toUpperCase() : categorie.nom.toUpperCase() }}</h1>
                </div>

                <div class="hero-filters">

                    <div class="filter-box">
                        <span class="filter-label">CYLINDRÉE</span>
                        <div class="custom-select-wrapper">
                            <div class="custom-select">
                                <span>{{ filtrecylindree === 'toutes' ? 'Toutes' : filtrecylindree + ' CM3' }}</span>
                                <i class="arrow-down"></i>
                            </div>
                            <ul class="select-options">
                                <li @click="filtrecylindree = 'toutes'">TOUTES</li>
                                <li
                                    v-for="cyl in cylindreesDisponibles"
                                    :key="cyl"
                                    @click="filtrecylindree = cyl"
                                >
                                    {{ cyl }} CM3
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="filter-box">
                        <span class="filter-label">PERMIS</span>
                            <div class="custom-select-wrapper">
                                <div class="custom-select">
                                    <span>{{ filtrePermis === 'tous' ? 'Tous les permis' : filtrePermis }}</span>
                                    <i class="arrow-down"></i>
                                </div>
                                <ul class="select-options">
                                <li @click="filtrePermis = 'tous'">TOUS</li>
                                <li
                                    v-for="p in permisDisponibles"
                                    :key="p"
                                    @click="filtrePermis = p"
                                >
                                    {{ p }}
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="models-display">
            <div class="models-container">
                <div v-for="vehicule in vehiculesFiltres" :key="vehicule.id" class="model-card">
                    <div class="model-img-wrapper">
                        <img
                            :src="vehicule.image_principale
                                ? '/storage/' + vehicule.image_principale
                                : 'https://qjmotor.fr/wp-content/uploads/2025/02/Images-produits-QJmotor2.png'"
                            :alt="vehicule.nom"
                        >
                    </div>
                    <div class="model-info">
                        <h3 class="model-name">{{ vehicule.nom }}</h3>
                        <p class="model-range">{{ categorie.nom.toUpperCase() }}</p>
                        <div class="model-specs">
                            <div v-if="vehicule.permis" class="spec-line">
                                <span class="label">PERMIS</span>
                                <span class="value">{{ vehicule.permis }}</span>
                            </div>
                            <div v-if="vehicule.cylindree" class="spec-line">
                                <span class="label">CYLINDRÉE</span>
                                <span class="value">{{ vehicule.cylindree }} CM3</span>
                            </div>
                            <div v-if="vehicule.couleurs" class="spec-line">
                                <span class="label">COULEURS</span>
                                <div class="color-options">
                                    <span
                                        v-for="(couleur, idx) in vehicule.couleurs.split(',')"
                                        :key="idx"
                                        class="circle-color"
                                        :style="{backgroundColor: couleur.trim().toLowerCase(),}"
                                        :title="couleur.trim()"
                                    ></span>
                                </div>
                            </div>
                        </div>
                        <a
                            :href="'/' + typeSlug + '/' + vehicule.id"
                            class="btn-square"
                        >VOIR LE MODÈLE</a>
                    </div>
                </div>

                <div v-if="vehiculesFiltres.length === 0" class="no-results">
                    <p>Aucun véhicule ne correspond à vos filtres.</p>
                    <button @click="resetFiltres" class="btn-square">Réinitialiser les filtres</button>
                </div>

            </div>
        </section>
        
    </div>

    <div v-else class="loading">Catégorie introuvable.</div>
    
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import axios from 'axios';

const props = defineProps({
    categorieSlug: { type: String, required: true }
})

const categorie   = ref(null)
const loading     = ref(true)
const openDropdown = ref(null)

const filtrecylindree = ref('toutes')
const filtrePermis   = ref('tous')

onMounted(async () => {
    try {
        const res = await axios.get(`/api/categories/${props.categorieSlug}`)
        categorie.value = res.data
    } catch (e) {
        console.error('Erreur chargement catégorie', e)
    } finally {
        loading.value = false
    }
    document.addEventListener('click', fermerDropdowns)
})

onBeforeUnmount(() => {
    document.removeEventListener('click', fermerDropdowns)
})


const typeSlug = computed(() => {
    const produits = categorie.value?.produits ?? []
    if (produits.length && produits[0].type) {
        return produits[0].type.nom.toLowerCase()
    }
    return 'vehicule'
})


const cylindreesDisponibles = computed(() => {
    if (!categorie.value?.produits) return []
    const vals = categorie.value.produits
        .map(v => v.cylindree)
        .filter(Boolean)
    return [...new Set(vals)].sort((a, b) => a - b)
})

const permisDisponibles = computed(() => {
    if (!categorie.value?.produits) return []
    const vals = categorie.value.produits
        .flatMap(v => v.permis ? v.permis.split('/').map(p => p.trim()) : [])
        .filter(Boolean)
    return [...new Set(vals)].sort()
})

const vehiculesFiltres = computed(() => {
    if (!categorie.value?.produits) return []

    return categorie.value.produits.filter(v => {
        if (filtrecylindree.value !== 'toutes' && v.cylindree != filtrecylindree.value) return false

        if (filtrePermis.value !== 'tous') {
            const permisVehicule = v.permis
                ? v.permis.split('/').map(p => p.trim())
                : []
            if (!permisVehicule.includes(filtrePermis.value)) return false
        }

        return true
    })
})

const toggleDropdown = (nom) => {
    openDropdown.value = openDropdown.value === nom ? null : nom
}

const fermerDropdowns = () => {
    openDropdown.value = null
}

const resetFiltres = () => {
    filtrecylindree.value = 'toutes'
    filtrePermis.value    = 'tous'
}
</script>