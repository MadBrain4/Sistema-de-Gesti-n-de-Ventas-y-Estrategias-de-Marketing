import './bootstrap';

import { createApp } from 'vue';
import VueApexCharts from "vue3-apexcharts";
import vuetify from './plugins/vuetify'


import App from './prueba.vue';
import App_Proyeccion from './marketing/proyeccion.vue';
import App_Presupuesto from './marketing/presupuesto.vue';
import App_Estrategias from './marketing/estrategias.vue';
import app_estrategias_nuevo from './marketing/estrategias/nuevo.vue';
import app_estrategias_edit from './marketing/estrategias/edit.vue';
import app_presupuesto_edit from './marketing/presupuesto/edit.vue';
import App_Index from './marketing/index.vue';


createApp(App_Index)
    .use(vuetify)
    .mount('#app_index')

createApp(App)
    .use(VueApexCharts)
    .mount('#app')

createApp(App_Proyeccion)
    .use(vuetify)
    .use(VueApexCharts)
    .mount('#app_proyeccion')

createApp(App_Presupuesto)
    .use(vuetify)       
    .use(VueApexCharts)
    .mount('#app_presupuesto')
    
createApp(App_Estrategias)
    .use(vuetify)
    .use(VueApexCharts)
    .mount('#app_estrategias')

createApp(app_estrategias_nuevo)
    .use(vuetify)
    .use(VueApexCharts)
    .mount('#app_estrategias_nuevo')

createApp(app_estrategias_edit)
    .use(vuetify)
    .use(VueApexCharts)
    .mount('#app_estrategias_edit')

createApp(app_presupuesto_edit)
    .use(vuetify)
    .mount('#app_editar_presupuesto')


