import Vue from 'vue';

const state = {
    negocios: [],
}

const mutations = {
    SET_NEGOCIOS(state, negocios){
        state.negocios = negocios;
    }

}

const actions = {
    getNegocios: ({commit}) =>{
        return Vue.http.get('/api/negocios').then(response => {
            if (response.status === 200) {                
                commit('SET_NEGOCIOS', response.body.negocios);
                              
            }
        },response => {
            console.log('Error');
        });
    }
}

export default {
    state, mutations, actions
}