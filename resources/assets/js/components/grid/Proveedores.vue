<template>
    <div>
        <template v-if="apiNegocio.loadingSuperusuario">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        <div class="x_panel">
            <div class="x_title">
                <h2>Proveedores</h2>        
                <ul class="nav navbar-right panel_toolbox">
                    <li><a v-on:click="proveedorProp = []" data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Crear proveedor</a></li>        
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="input-group col-sm-12">
                <label>Buscar: </label>
                <input type="text" v-model="search_query_1" v-on:keyup="getProveedores" debounce="500" class="form-control">
            </div> 
            <div class="container">
                <table v-if="apiNegocio.proveedores.data"  class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th><a @click="sort('nit')">Nit</a></th>
                            <th><a @click="sort('nombre')">Nombre</a></th>
                            <th><a @click="sort('empresa')">Empresa</a></th>
                            <th><a @click="sort('email')">Email</a></th>
                            <th><a @click="sort('telefono')">Telefono</a></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <Proveedor v-on:verProveedor="verProveedor($event)" v-for="(proveedor,index) in apiNegocio.proveedores.data" :key="index" v-bind:index="index" v-bind:proveedor="proveedor"
                    v-on:crearusuario="proveedorProp = $event"
                    v-on:editproveedor="editproveedor = $event"
                    >
                    </Proveedor>    
                
                </table>
                <span>Registros por página:</span>

                <select v-model="per_page" v-on:change="getProveedores">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
                |
                <span>Mostrando {{apiNegocio.proveedores.from}} - {{apiNegocio.proveedores.to}} de {{apiNegocio.proveedores.total}}</span>
                |
                <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getProveedores"> de {{apiNegocio.proveedores.last_page}}</span>
                |
                <span><button v-on:click="next">Siguiente</button></span>
                <span><button v-on:click="prev">Anterior</button></span>
                <ProveedorForm v-bind:negocioData="proveedorProp" @negocioCreated="getProveedores()"></ProveedorForm>     
                
            </div>
        </div>
    </div>
   
</template>

<script>
    import Vue from 'vue';
    import {mapState} from 'vuex';
    import Proveedor from './Proveedor.vue';
    import ProveedorForm from '../modals/ProveedorForm.vue'; 
    export default {
        props: ['token'],
        components:{ Proveedor, ProveedorForm },
        data(){
            return {
                proveedorProp : [],
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
            this.getProveedores();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getProveedores(){
                this.$store.dispatch('getProveedores', {
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
                this.getProveedores()
            },
            next(){
            if(this.apiNegocio.proveedores.next_page_url){                
                this.page++
                this.getProveedores()
            }
            },
            prev(){
                if(this.apiNegocio.proveedores.prev_page_url){
                    
                    this.page--
                    this.getProveedores()
                }
            },
        }
    
    }
</script>