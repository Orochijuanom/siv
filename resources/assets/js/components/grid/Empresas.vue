<template>
    <div>
        <template v-if="apiNegocio.loadingNegocio">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Empresas</h3> 
                <div class="box-tools pull-right">     
                    <a data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Crear empresa</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Registros por página:</span>

                        <select v-model="per_page" v-on:change="getEmpresas">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group col-xs-12">
                            <label>Buscar: </label>
                            <input type="text" v-model="search_query_1" v-on:keyup="getEmpresas" debounce="500" class="form-control">
                        </div> 
                        <table v-if="apiNegocio.empresas.data"  class="table table-bordered table-striped table-hover">
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
                            <Empresa v-on:verempresa="verempresa($event)" v-for="(empresa,index) in apiNegocio.empresas.data" :key="index" v-bind:index="index" v-bind:empresa="empresa"
                            v-on:crearusuario="empresaProp = $event"
                            v-on:editempresa="empresaedit = $event"
                            >
                            </Empresa>    

                        </table>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-6">
                        <span>Mostrando {{apiNegocio.empresas.from}} - {{apiNegocio.empresas.to}} de {{apiNegocio.empresas.total}}</span>
                        |
                        <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getEmpresas"> de {{apiNegocio.empresas.last_page}}</span>
                        |
                        <span><button v-on:click="prev">Anterior</button></span>
                        <span><button v-on:click="next">Siguiente</button></span>
                        <EmpresaForm v-bind:token="token" @empresaCreated="getEmpresas()"></EmpresaForm>
                        <EmpresaEditForm v-bind:token="token"  v-bind:empresaData="empresaedit" @empresaEdited="getEmpresas()"></EmpresaEditForm> 
                    </div> 
                </div>
            </div>
            <!-- /.box-body -->  
        </div>
    </div>
   
</template>

<script>
    import Vue from 'vue';
    import {mapState} from 'vuex';
    import Empresa from './Empresa.vue';
    import EmpresaForm from '../modals/EmpresaForm.vue'; 
    import EmpresaEditForm from '../modals/EmpresaEditForm.vue'; 
    export default {
        props: ['token'],
        components:{ Empresa, EmpresaForm,EmpresaEditForm },
        data(){
            return {
                column: 'id',
                direction: 'desc',
                per_page: '10',
                page: '1',
                search_operator: 'like',
                search_column: 'descripcion',
                search_query_1: '',
                search_query_2: '',
                empresaedit:[],
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                }
            }
        },
        created(){
            this.getEmpresas();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getEmpresas(){
                this.$store.dispatch('getEmpresas', {
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
                this.getEmpresas()
            },
            next(){
            if(this.apiNegocio.empresas.next_page_url){                
                this.page++
                this.getEmpresas()
            }
            },
            prev(){
                if(this.apiNegocio.empresas.prev_page_url){
                    
                    this.page--
                    this.getEmpresas()
                }
            },
        }
    
    }
</script>
