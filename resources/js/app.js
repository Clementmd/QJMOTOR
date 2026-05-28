import { createApp } from 'vue';
import '../css/style.css'; 

import HeaderFront from './components/HeaderFront.vue';
import HomeFront from './pages/HomeFront.vue';
import VehiculesFront from './pages/VehiculesFront.vue'; 
import CategorieVehicules from './pages/CategorieVehicules.vue';

const app = createApp({});

app.component('header-front', HeaderFront);
app.component('home-front', HomeFront);
app.component('vehicule-front', VehiculesFront); 
app.component('categorie-vehicules', CategorieVehicules);

app.mount('#app');