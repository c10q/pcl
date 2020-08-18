import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store"
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import $ from 'jquery'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Toasted from 'vue-toasted'
import '@mdi/font/css/materialdesignicons.min.css'


Vue.use(Toasted, {
    iconPack : 'mdi'
});

Vue.use(Vuetify)
Vue.use(VueMaterial)

new Vue({
    el: '#app',
    router,
    store,
    $,
    render: h => h(App)
});

