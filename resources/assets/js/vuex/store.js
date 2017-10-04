import Vue from 'vue';
import Vuex from 'vuex';
import apiSuperusuario from './apiSuperusuario';

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';
export default new Vuex.Store({
    modules: {
        apiSuperusuario
    },
    strict:debug
});
