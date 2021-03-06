import Vue from 'vue';

const state = {

    proveedores: [],
    clientes: [],
    empresas: [],
    productos: [],
    categorias: [],
    usuarios: [],
    tipousers: [],
    monedas: [],
    oportunidadesabiertas: [],
    numeroabiertas: [],
    numerovencidas: [],
    oportunidadesvencidas: [],    
    loadingNegocio: true,
}

const mutations = {
    SET_PROVEEDORES(state, proveedores){
        state.proveedores = proveedores;
    },

    SET_CLIENTES(state, clientes){
        state.clientes = clientes;
    },

    SET_EMPRESAS(state, empresas){
        state.empresas = empresas;
    },
      
    SET_PRODUCTOS(state, productos){
        state.productos = productos;
    },

    SET_CATEGORIAS(state, categorias){
        state.categorias = categorias;
    },
  
    SET_USUARIOS(state, usuarios){
        state.usuarios = usuarios;
    },

    SET_TIPOUSERS(state, tipousers){
        state.tipousers = tipousers;
    },

    SET_MONEDAS(state, monedas){
        state.monedas = monedas;
    },

    SET_PRODUCTOS_SEARCH(state, productos){
        state.productos = productos
    },

    SET_OPORTUNIDADES_ABIERTAS(state, oportunidades){
        state.oportunidadesabiertas = oportunidades
    },

    SET_NUMERO_ABIERTAS(state, numero){
        state.numeroabiertas = numero
    },

    SET_OPORTUNIDADES_VENCIDAS(state, oportunidades){
        state.oportunidadesvencidas = oportunidades
    },

    SET_NUMERO_VENCIDAS(state, numero){
        state.numerovencidas = numero
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
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_PROVEEDORES', response.body.proveedores);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getClientes: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/clientes?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/clientes?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_CLIENTES', response.body.clientes);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getEmpresas: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/empresas?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/empresas?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_EMPRESAS', response.body.empresas);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },
              
    getProductos: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/productos?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/productos?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_PRODUCTOS', response.body.productos);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getCategorias: ({commit}, params) =>{
         return Vue.http.get('/api/categorias').then(response => {
            if (response.status === 200){
                commit('SET_CATEGORIAS', response.body.categorias);
            }      
        });
    },
    getProductosSelect: ({commit}, params) =>{
        return Vue.http.get('/api/prductosselect').then(response => {
           if (response.status === 200){
               commit('SET_PRODUCTOS', response.body.productos);
           }      
       });
   },

    getUsuarios: ({commit}, params) =>{
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/usuarios?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/usuarios?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url, {headers: params.headers}).then(response => {
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

    getMonedas: ({commit}, params) => {
        return Vue.http.get('/api/monedas').then(response => {
            if (response.status === 200){
                commit('SET_MONEDAS', response.body.monedas);
            }      
        });
    },

    getOportunidadesAbiertas:({commit}, params) => {
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/get_oportunidades_abiertas?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/get_oportunidades_abiertas?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_OPORTUNIDADES_ABIERTAS', response.body.oportunidades_abiertas);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getNumeroAbiertas:({commit}, params) => {
        commit('SET_LOADING', true)
        var url = '';  

        url = '/api/get_numero_abiertas'
        
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_NUMERO_ABIERTAS', response.body.numero_abiertas);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getOportunidadesVencidas:({commit}, params) => {
        commit('SET_LOADING', true)
        var url = '';  
        if(params.search_query_1 == ''){
          url = '/api/get_oportunidades_vencidas?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column
        }else{
          url = '/api/get_oportunidades_vencidas?column='+params.column+'&direction='+params.direction+'&per_page='+params.per_page+'&page='+params.page+'&search_operator='+params.search_operator+'&search_column='+params.search_column+'&search_query_1='+params.search_query_1
        } 
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_OPORTUNIDADES_VENCIDAS', response.body.oportunidades_vencidas);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    getNumeroVencidas:({commit}, params) => {
        commit('SET_LOADING', true)
        var url = '';  

        url = '/api/get_numero_vencidas'
        
        return Vue.http.get(url, {headers: params.headers}).then(response => {
            if (response.status === 200) {                
                commit('SET_NUMERO_VENCIDAS', response.body.numero_vencidas);
                commit('SET_LOADING', false)
                              
            }
        },response => {
            console.log('Error');
        });
    },

    searchProductos: ({commit}, params) => {
        commit('SET_LOADING', true);
        var url = '/api/search_producto';
        if (params.query.length > 0)           
            url = url  + '/' + params.query;                
        return Vue.http.get(url).then(response => {
            if (response.status === 200) {                
                commit('SET_PRODUCTOS_SEARCH', response.body.productos);
                commit('SET_LOADING', false)                
            }
        },response => {
            console.log('Error');
            commit('SET_LOADING', false);
        });
    },

}

export default {
    state, mutations, actions
}