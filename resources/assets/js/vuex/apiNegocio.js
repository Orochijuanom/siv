import Vue from 'vue';

const state = {

    proveedores: [],
    usuarios: [],
    tipousers: [],
    loadingNegocio: true,
}

const mutations = {
    SET_PROVEEDORES(state, proveedores){
        state.proveedores = proveedores;
    },
  
    SET_USUARIOS(state, usuarios){
        state.usuarios = usuarios;
    },

    SET_TIPOUSERS(state, tipousers){
        state.tipousers = tipousers;
    },

    SET_LOADING(state, status){
        state.loadingNegocio = status;
    }   

}

const actions = {
    getProveedores: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/proveedores?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/proveedores?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url).then(response => {
            if (response.status === 200) {                
                commit('SET_PROVEEDORES', response.body.proveedores);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getUsuarios: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/usuarios/negocio/'+params.negocio+'?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/usuarios/negocio/'+params.negocio+'?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url).then(response => {
            if (response.status === 200) {                
                commit('SET_USUARIOS', response.body.usuarios);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },
    getTipousers: ({commit}, params) => {
        return Vue.http.get('/api/tipousers').then(response => {
            if (response.status === 200){
                commit('SET_TIPOUSERS', response.body.tipousers);
            }      
        });
    },
    getOportunidadesAbiertas:({commit}) => {
        return Vue.http.get('/api/get_oportunidades_abiertas').then(response => {
            if(response.status === 200){
                commit('SET_OPORTUNIDADES_ABIERTAS', response.body.oportunidades_abiertas);
            }
        });
    }

}

export default {
    state, mutations, actions
}