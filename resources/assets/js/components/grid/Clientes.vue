<template>
    <div>
        <template v-if="apiNegocio.loadingNegocio">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Clientes</h3> 
                <div class="box-tools pull-right">     
                    <a data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Crear cliente</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Registros por página:</span>

                        <select v-model="per_page" v-on:change="getClientes">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group col-sm-12">
                            <label>Buscar: </label>
                            <input type="text" v-model="search_query_1" v-on:keyup="getClientes" debounce="500" class="form-control">
                        </div>
                        <table v-if="apiNegocio.clientes.data"  class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th><a @click="sort('nit')">Nit</a></th>
                                    <th><a @click="sort('nombre')">Nombre</a></th>
                                    <th><a @click="sort('email')">Email</a></th>
                                    <th><a @click="sort('telefono')">Telefono</a></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <Cliente v-on:verCliente="verCliente($event)" v-for="(cliente,index) in apiNegocio.clientes.data" :key="index" v-bind:index="index" v-bind:cliente="cliente"
                            v-on:editcliente="clienteEdit = $event"
                            >
                            </Cliente>    
                        
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <span>Mostrando {{apiNegocio.clientes.from}} - {{apiNegocio.clientes.to}} de {{apiNegocio.clientes.total}}</span>
                        |
                        <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getClientes"> de {{apiNegocio.clientes.last_page}}</span>
                        |
                        <span><button v-on:click="next">Siguiente</button></span>
                        <span><button v-on:click="prev">Anterior</button></span>
                        <ClienteForm v-bind:token="token" @clienteCreated="getClientes()"></ClienteForm>     
                        <ClienteEditForm v-bind:token="token" v-bind:clienteData="clienteEdit" @clienteEdited="getClientes()"></ClienteEditForm>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</template>

<script>
    import Vue from 'vue';
    import {mapState} from 'vuex';
    import Cliente from './Cliente.vue';
    import ClienteForm from '../modals/ClienteForm.vue'; 
    import ClienteEditForm from '../modals/ClienteEditForm.vue'; 
    export default {
        props: ['token'],
        components:{ Cliente, ClienteForm,ClienteEditForm },
        data(){
            return {
                clienteEdit: [],
                column: 'id',
                direction: 'desc',
                per_page: '10',
                page: '1',
                search_operator: 'like',
                search_column: 'nombre',
                search_query_1: '',
                search_query_2: '',
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                }
            }
        },
        created(){
            this.getClientes();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getClientes(){
                this.$store.dispatch('getClientes', {
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
                this.getClientes()
            },
            next(){
            if(this.apiNegocio.clientes.next_page_url){                
                this.page++
                this.getClientes()
            }
            },
            prev(){
                if(this.apiNegocio.clientes.prev_page_url){
                    
                    this.page--
                    this.getClientes()
                }
            },
        }
    
    }
</script>