<template>
    <div>
        <template v-if="apiSuperusuario.loadingSuperusuario">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        <div class="x_panel">
            <div class="x_title">
                <h2>Negocios</h2>        
                <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Crear negocio</a></li>        
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="input-group col-sm-12">
                <label>Buscar: </label>
                <input type="text" v-model="search_query_1" v-on:keyup="getNegocios" debounce="500" class="form-control">
            </div> 
            <div class="container">
                <table v-if="apiSuperusuario.negocios.data"  class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th><a @click="sort('descripcion')">Nombre</a></th>
                            <th>Acciones</th>
                            <th>Usuarios</th>
                        </tr>
                    </thead>
                    <Negocio v-on:vernegocio="verNegocio($event)" v-for="(negocio,index) in apiSuperusuario.negocios.data" :key="index" v-bind:index="index" v-bind:negocio="negocio"
                    v-on:editnegocio="editnegocio = $event"
                    >
                    </Negocio>    
                
                </table>
                <span>Registros por página:</span>

                <select v-model="per_page" v-on:change="getNegocios">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
                |
                <span>Mostrando {{apiSuperusuario.negocios.from}} - {{apiSuperusuario.negocios.to}} de {{apiSuperusuario.negocios.total}}</span>
                |
                <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getNegocios"> de {{apiSuperusuario.negocios.last_page}}</span>
                |
                <span><button v-on:click="next">Siguiente</button></span>
                <span><button v-on:click="prev">Anterior</button></span>
                <NegocioForm v-bind:negocioData="negocioProp" @negocioCreated="getNegocios()"></NegocioForm>     
                
            </div>
        </div>
    </div>
   
</template>

<script>
    import Vue from 'vue';
    import {mapState} from 'vuex';
    import Negocio from './Negocio.vue';
    import NegocioForm from '../modals/NegocioForm.vue'; 
    export default {
        props: ['token'],
        components:{ Negocio, NegocioForm },
        data(){
            return {
                negocioProp : [],
                column: 'id',
                direction: 'desc',
                per_page: '10',
                page: '1',
                search_operator: 'like',
                search_column: 'descripcion',
                search_query_1: '',
                search_query_2: '',
            }
        },
        created(){
            this.getNegocios();
        },
        computed: mapState({
            apiSuperusuario: state => state.apiSuperusuario
        }),
        methods: {
            getNegocios(){
                this.$store.dispatch('getNegocios', {
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
                this.getNegocios()
            },
            next(){
            if(this.apiSuperusuario.negocios.next_page_url){                
                this.page++
                this.getNegocios()
            }
            },
            prev(){
                if(this.apiSuperusuario.negocios.prev_page_url){
                    
                    this.page--
                    this.getNegocios()
                }
            },
        }
    
    }
</script>