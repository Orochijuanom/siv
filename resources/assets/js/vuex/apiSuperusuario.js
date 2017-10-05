import Vue from 'vue';

const state = {
    negocios: [],
    loadingSuperusuario: true,
}

const mutations = {
    SET_NEGOCIOS(state, negocios){
        state.negocios = negocios;
    },

    SET_LOADING(state, status){
        state.loadingSuperusuario = status;
    }   

}

const actions = {
    getNegocios: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/negocios?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/negocios?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url).then(response => {
            if (response.status === 200) {                
                commit('SET_NEGOCIOS', response.body.negocios);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    }
}

export default {
    state, mutations, actions
}