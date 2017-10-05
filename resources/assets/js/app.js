
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueResource from 'vue-resource';
import store from './vuex/store';

Vue.use(VueResource);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('Administradores', require('./components/Administradores.vue'));
Vue.component('Negocios', require('./components/usuarios/Negocios.vue'));

Vue.component('Proveedores', require('./components/Proveedores.vue'));
Vue.component('Oportunidades', require('./components/Oportunidades.vue'));

const app = new Vue({
    el: '#app',
    store
});

