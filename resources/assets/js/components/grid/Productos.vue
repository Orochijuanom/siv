<template>
    <div>
        <template v-if="apiNegocio.loadingNegocio">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Productos</h3> 
                <div class="box-tools pull-right">     
                    <a data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Crear producto</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Registros por página:</span>

                        <select v-model="per_page" v-on:change="getProductos">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group col-md-3">                
                            <label for="hasta" class="control-label">Buscar por: </label>
                            <select v-model="search_column" class="form-control">
                                <option v-bind:key="filtro.id" v-for="filtro in filtros" v-bind:value="filtro.fvalue">{{filtro.text}}</option>
                            </select>
                        
                    
                        </div>
                        <div class="input-group col-sm-12">
                            <label>Buscar: </label>
                            <input type="text" v-model="search_query_1" v-on:keyup="getProductos" debounce="500" class="form-control">
                        </div>
                        <table v-if="apiNegocio.productos.data"  class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Descripcion</th>
                                    <th>Número de parte</th>
                                    <th>Fabricante</th>
                                    <th>Categoria</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <Producto v-on:verProducto="verProducto($event)" v-for="(producto,index) in apiNegocio.productos.data" :key="index" v-bind:index="index" v-bind:producto="producto"
                            v-on:crearusuario="productoProp = $event"
                            v-on:editproducto="productoEdit = $event"
                            >
                            </Producto>    
                        
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <span>Mostrando {{apiNegocio.productos.from}} - {{apiNegocio.productos.to}} de {{apiNegocio.productos.total}}</span>
                    |
                    <span>Página actual <input size="2" type="text" v-model="page" v-on:keyup.enter="getProductos"> de {{apiNegocio.productos.last_page}}</span>
                    |
                    <span><button v-on:click="next">Siguiente</button></span>
                    <span><button v-on:click="prev">Anterior</button></span>
                    <ProductosForm v-bind:token="token" @productoCreated="getProductos()"></ProductosForm>     
                    <ProductosEditForm v-bind:token="token" v-bind:producto="productoEdit" @productoEdit="getProductos()"></ProductosEditForm>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</template>

<script>
    import Vue from 'vue';
    import {mapState} from 'vuex';
    import Producto from './Producto.vue';
    import ProductosForm from '../modals/ProductosForm.vue'; 
    import ProductosEditForm from '../modals/ProductosEditForm.vue'; 
    export default {
        props: ['token'],
        components:{ Producto, ProductosForm, ProductosEditForm },
        data(){
            return {
                filtros:[
                    {
                    fvalue: 'descripcion',
                    text: 'Descripcion'
                    },
                    {
                    fvalue: 'nparte',
                    text: 'Nº de Parte'
                    },
                ], 
                productoEdit:[],
                column: 'id',
                direction: 'desc',
                per_page: '10',
                page: '1',
                search_operator: 'like',
                search_column: 'descripcion',
                search_query_1: '',
                search_query_2: '',
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                }
            }
        },
        created(){
            this.getProductos();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getProductos(){
                this.$store.dispatch('getProductos', {
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
                this.getProductos()
            },
            next(){
            if(this.apiNegocio.productos.next_page_url){                
                this.page++
                this.getProductos()
            }
            },
            prev(){
                if(this.apiNegocio.productos.prev_page_url){
                    
                    this.page--
                    this.getProductos()
                }
            },
        }
    
    }
</script>