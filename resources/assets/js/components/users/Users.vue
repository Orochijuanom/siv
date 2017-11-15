<template>
    <div>
        <template v-if="apiNegocio.loadingNegocio">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
            <div class="row">            
                <div class="col-md-6 col-4 align-self-center">                            
                <h2>Usuarios</h2>                  
             </div>   
            <div class="col-md-6 col-4 align-self-center">                
                <a data-toggle="modal" data-target="#modal-usuarios" class="btn pull-right hidden-sm-down btn-success"><i class="fa fa-user-plus"></i> Crear usuario</a>
            </div>
            </div>   
            <hr/>
            <div class="clearfix"></div>            
            <div class="input-group col-sm-12">
                <label>Buscar: </label>
                <input type="text" v-model="search_query_1" v-on:keyup="getUsuarios" debounce="500" class="form-control">
            </div> 
            <div class="container">
                <table v-if="apiNegocio.usuarios.data"  class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th><a @click="sort('name')">Nombre</a></th>
                            <th>Email</th>
                            <th>Tipo de usuario</th>
                            <th>Activo</th>
                            <th>Creado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <User  v-for="(usuario,index) in apiNegocio.usuarios.data" :key="index" v-bind:index="index" v-bind:usuario="usuario"
                    v-on:editusuario="editusuario = $event">
                    </user>    
                
                </table>
                <span>Registros por página:</span>

                <select v-model="per_page" v-on:change="getUsuarios">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
                |
                <span>Mostrando {{apiNegocio.usuarios.from}} - {{apiNegocio.usuarios.to}} de {{apiNegocio.usuarios.total}}</span>
                |
                <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getUsuarios"> de {{apiNegocio.usuarios.last_page}}</span>
                |
                <span><button v-on:click="next">Siguiente</button></span>
                <span><button v-on:click="prev">Anterior</button></span>
                <UsuarioForm v-bind:negocio_id="negocio" @usuarioCreated="getUsuario()"></UsuarioForm>  
                    
                
            </div>
        </div>    
   
</template>

<script>
    import Vue from 'vue';
    import User from './User.vue';
    import UsuarioForm from '../Modals/UsuarioForm.vue';
    import {mapState} from 'vuex';
    export default {
        props: ['negocio', 'token'],
        components: {User, UsuarioForm},
        data(){
            return {
                column: 'id',
                direction: 'desc',
                per_page: '10',
                page: '1',
                search_operator: 'like',
                search_column: 'name',
                search_query_1: '',
                search_query_2: '',
            }
        },
        created(){
            this.getUsuarios();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getUsuarios(){
                this.$store.dispatch('getUsuarios', {
                    negocio: this.negocio,
                    column: this.column,
                    direction: this.direction,
                    per_page: this.per_page,
                    page: this.page,
                    search_operator: this.search_operator,
                    search_column: this.search_column,
                    search_query_1: this.search_query_1,
                    search_query_2: this.search_query_2,
                    headers: this.headers
                });
            },
            sort(column){
                if(column === this.column) {
                    if(this.direction === 'desc') {
                        this.direction = 'asc'
                    } else {
                        this.direction = 'desc'
                    }
                } else {
                        this.column = column
                        this.direction = 'asc'
                }
                this.getUsuarios()
            },
            next(){
            if(this.apiNegocio.usuarios.next_page_url){                
                this.page++
                this.getUsuarios()
            }
            },
            prev(){
                if(this.apiNegocio.usuarios.prev_page_url){
                    
                    this.page--
                    this.getUsuarios()
                }
            },
        }
    
    }
</script>