<template>
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="/"><img src="https://qjmotor.fr/wp-content/uploads/2024/10/QJ-Motors-Logo-107x72-c-default.webp" alt="QJMOTOR"></a>
            </div>
            <nav class="nav-menu">
                <ul class="nav-links" @mouseleave="resetTab()">
                    <li>
                        <a href="/" :class="{ active: hoveredTab === 'accueil' }" @mouseenter="hoveredTab = 'accueil'">
                            ACCUEIL
                        </a>
                    </li>
                    
                    <li v-for="type in menu" :key="type.id" class="has-mega">
                        <a 
                            href="#" 
                            :class="{ active: hoveredTab === type.id || (hoveredTab !== 'accueil' && currentTypeId === type.id) }" 
                            @mouseenter="hoveredTab = type.id"
                        >
                            {{ type.nom.toUpperCase() }} ▾
                        </a>
                        
                        <div class="mega-menu">
                            <div class="mega-wrapper">
                                
                                <div class="mega-categories-nav">
                                    <div 
                                        v-for="cat in type.categories" 
                                        :key="cat.id"
                                        class="sub-link"
                                        :href="'/categorie/' + cat.nom"
                                        :class="{ active: getActiveCatId(type.id, type.categories) === cat.id }"
                                        @mouseenter="setActiveCatId(type.id, cat.id)"
                                    >
                                        <a href="#">{{ cat.nom }}</a>
                                    </div>
                                </div>

                                <div class="mega-content">
                                    <div class="model-grid active">
                                        <template v-for="cat in type.categories" :key="'grid-'+cat.id">
                                            <template v-if="getActiveCatId(type.id, type.categories) === cat.id">
                                                
                                                <a 
                                                    v-for="produit in cat.produits" 
                                                    :key="produit.id" 
                                                    :href="'/' + type.nom.toLowerCase() + '/' + produit.id"
                                                    class="model-card"
                                                >
                                                    <img :src="produit.image_principale ? '/storage/' + produit.image_principale : 'https://qjmotor.fr/wp-content/uploads/2025/02/Images-produits-QJmotor2.png'" :alt="produit.nom">
                                                    <span>{{ produit.nom }}</span>
                                                </a>

                                                <div v-if="!cat.produits || cat.produits.length === 0" class="no-products">
                                                    Aucun modèle disponible dans la catégorie "{{ cat.nom }}".
                                                </div>

                                            </template>
                                        </template>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>

                    <li><a href="#" @mouseenter="hoveredTab = 'actualites'" :class="{ active: hoveredTab === 'actualites' }">ACTUALITÉS</a></li>
                    <li><a href="#" @mouseenter="hoveredTab = 'propos'" :class="{ active: hoveredTab === 'propos' }">À PROPOS</a></li>
                    <li><a href="#" @mouseenter="hoveredTab = 'roadshows'" :class="{ active: hoveredTab === 'roadshows' }">ROADSHOWS</a></li>
                    <li><a href="#" class="btn-essais">ESSAIS</a></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { ref, computed, watchEffect } from 'vue'

const props = defineProps({
    menu: { type: Array, default: () => [] },
    activeTypeSlug: { type: String, default: '' }  
})

const currentTypeId = computed(() => {
    if (!props.activeTypeSlug || !props.menu) return null
    const found = props.menu.find(
        t => t.nom.toLowerCase() === props.activeTypeSlug.toLowerCase()
    )
    return found ? found.id : null
})


const hoveredTab = ref('accueil')
watchEffect(() => {
    if (currentTypeId.value !== null) {
        hoveredTab.value = currentTypeId.value
    }
})
const resetTab = () => {
    hoveredTab.value = currentTypeId.value ?? 'accueil'
}

const selectedTabs = ref({})
const setActiveCatId = (typeId, catId) => {
    selectedTabs.value[typeId] = catId
}
const getActiveCatId = (typeId, categories) => {
    if (selectedTabs.value[typeId]) return selectedTabs.value[typeId]
    if (categories && categories.length > 0) return categories[0].id  
    return null
}
</script>
