<template>
    <div>
        <template v-if="apiNegocio.loadingNegocio">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Oportunidades pendientes</h3> 
                <div class="box-tools pull-right">     
                    <a data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Crear empresa</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Registros por página:</span>

                        <select v-model="per_page" v-on:change="getOportunidadesAbiertas">
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
                            <input type="text" v-model="search_query_1" v-on:keyup="getOportunidadesAbiertas" debounce="500" class="form-control">
                        </div> 
                        <table v-if="apiNegocio.oportunidadesabiertas.data"  class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th><a @click="sort('descripcion')">Descripcion</a></th>
                                    <th><a @click="sort('solicitante')">Solicitante</a></th>
                                    <th><a @click="sort('empresa')">Empresa</a></th>
                                    <th><a @click="sort('email')">Email</a></th>
                                    <th><a @click="sort('telefono')">Telefono</a></th>
                                    <th><a @click="sort('fecha_requerida')">Fecha requerida</a></th>
                                    <th><a @click="sort('presupuesto')">Presupuesto</a></th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <!-- <Empresa v-on:verempresa="verempresa($event)" v-for="(empresa,index) in apiNegocio.empresas.data" :key="index" v-bind:index="index" v-bind:empresa="empresa"
                            v-on:crearusuario="empresaProp = $event"
                            v-on:editempresa="empresaedit = $event"
                            >
                            </Empresa> -->    

                        </table>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-6">
                        <span>Mostrando {{apiNegocio.oportunidadesabiertas.from}} - {{apiNegocio.oportunidadesabiertas.to}} de {{apiNegocio.oportunidadesabiertas.total}}</span>
                        |
                        <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getOportunidadesAbiertas"> de {{apiNegocio.oportunidadesabiertas.last_page}}</span>
                        |
                        <span><button v-on:click="prev">Anterior</button></span>
                        <span><button v-on:click="next">Siguiente</button></span>
                        
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
<<<<<<< HEAD
    import AgregarCotizacionForm from '../Modals/AgregarCotizacionForm.vue';
    export default {
        props: ['token'],    
        components: {AgregarCotizacionForm},
=======
    //import Oportunidad from './Oportunidad.vue';
    export default {
        props: ['negocio', 'token'],
        //components:{ Oportunidad},
>>>>>>> 38f9c01b3a203db6158384225ed1535d6ff67e43
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
            }
        },
        created(){
            this.getOportunidadesAbiertas();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getOportunidadesAbiertas(){
                this.$store.dispatch('getOportunidadesAbiertas', {
                    column: this.column,
                    direction: this.direction,
                    per_page: this.per_page,
                    page: this.page,
                    search_operator: this.search_operator,
                    search_column: this.search_column,
                    search_query_1: this.search_query_1,
                    search_query_2: this.search_query_2,
                    negocio: this.negocio,
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
                this.getOportunidadesAbiertas()
            },
            next(){
            if(this.apiNegocio.oportunidadesabiertas.next_page_url){                
                this.page++
                this.getOportunidadesAbiertas()
            }
            },
            prev(){
<<<<<<< HEAD
                if(this.apiNegocio.proveedores.prev_page_url){                    
=======
                if(this.apiNegocio.oportunidadesabiertas.prev_page_url){
                    
>>>>>>> 38f9c01b3a203db6158384225ed1535d6ff67e43
                    this.page--
                    this.getOportunidadesAbiertas()
                }
            },
        }
    
    }
</script>