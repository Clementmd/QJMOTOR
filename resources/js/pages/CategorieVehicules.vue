<template>
  <div v-if="categorie" class="category-page">
    <h1>{{ categorie.nom.toUpperCase() }}</h1>

    <div class="filters">
      <button @click="filtre = 'tous'" :class="{active: filtre === 'tous'}">Tous</button>
      </div>

    <div class="vehicules-grid">
      <div v-for="vehicule in vehiculesFiltres" :key="vehicule.id" class="vehicule-card">
        <img :src="'/storage/' + vehicule.image_principale" :alt="vehicule.nom">
        <h3>{{ vehicule.nom }}</h3>
        <p>{{ vehicule.prix }} €</p>
        <a :href="'/' + vehicule.type.nom + '/' + vehicule.id">Voir détails</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps(['categorieSlug']);
const categorie = ref(null);
const filtre = ref('tous');

onMounted(async () => {
    const response = await axios.get(`/api/categories/${props.categorieSlug}`);
    categorie.value = response.data;
});

const vehiculesFiltres = computed(() => {
    if (!categorie.value) return [];
    return categorie.value.produits;
});
</script>