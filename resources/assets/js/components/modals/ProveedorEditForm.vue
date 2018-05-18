<template>
    <div class="modal fade"  id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Editar Proveedor</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="editProveedor" method="post">


                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nit}">
                                <label for="nit">Nit :</label>
                                <input type="number" v-model="data.nit" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.empresa}">
                                <label for="empresa">Empresa :</label>
                                <input type="text" v-model="data.empresa" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.telefono}">
                                <label for="telefono">Telefono :</label>
                                <input type="text" v-model="data.telefono" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.telefono" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                                <label for="email">Email :</label>
                                <input type="email" v-model="data.email" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.email" :key="index">{{ error }}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">                                            
                                    <div class="form-group">
                                        <label for="user_id">Buscar y asignar producto</label>
                                        <input class="form-control" id="user_id" v-model="productoQuery" v-on:keyup="searchProductos" debounce="1000">
                                    </div>
                                    <div style="border: 1px solid #e3e3e3; position: relative; z-index: 2; text-align: left; width: 100%;">
                                        <div v-bind:key="index" onMouseOver="this.style.backgroundColor='rgba(225, 225, 225, 0.5)'" onMouseOut="this.style.backgroundColor='white'" style="padding: 20px 10px; background: white; border-bottom: 1px solid #e3e3e3" v-for="(producto, index) in apiNegocio.productos" v-on:click="setProducto(producto)">
                                            <h3><strong>Producto:</strong> {{producto.descripcion}}</h3>
                                            <h2><strong>Categoria:</strong> {{producto.categoria.descripcion}}</h2>                                                        
                                        </div>
                                    </div>                                                                                                                                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <label for="producto" class="control-label">Productos(s): </label>
                            <br/>
                            
                            
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <span v-bind:key="index" class="label label-success" v-for="(producto, index) in data.productos">
                                <span>{{producto[1]}}</span>
                                <a title="remover producto" v-on:click="remover(index)">x</a>
                                </span>
                            </div>

                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="editProveedor" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Guardar</button>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
                </div>
            </div>
            <!-- /.modal-content -->  
        </div>
          
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';
    import Vue from 'vue';

    export default {

        props: ['proveedorData', 'token'],
       
        data(){
            return {
                errors: [],
                data: {
                    id: '',
                    email: '',
                    empresa: '',
                    telefono: '',
                    nit: '',
                    productos: []

                },
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                },
                envi: {
                    id: '',
                    tipo: '',
                },


                productoQuery: '',
                
            }
        },
        watch:{
            proveedorData: function() {
                this.errors = []
                if(this.proveedorData.id != ''){
                    this.data.id = this.proveedorData.id;
                    this.data.email= this.proveedorData.email;
                    this.data.empresa= this.proveedorData.empresa;
                    this.data.telefono= this.proveedorData.telefono;
                    this.data.nit= this.proveedorData.nit;
                    this.envi.tipo ="Proveedor";
                    this.envi.id = this.proveedorData.id;
                    this.$http.post('/api/getStockRela', this.envi).then(response => {
                    var productos = response.body.stock
                    for(var i in productos){
                        console.log(productos[i].id)
                        this.setProducto(productos[i])
                    }
                }, response => {  
                                     
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
                    this.data.productos= [];
                    
                }else{
                    this.data.id= "";
                    this.data.email= "";
                    this.data.empresa= "";
                    this.data.telefono= "";
                    this.data.nit= "";
                    this.data.productos= []
                    
                }
            },
        },

        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),

        methods: {
            searchProductos(){
                this.$store.dispatch('searchProductos', {
                    query: this.productoQuery});
            },

            setProducto(producto){
                this.productoQuery = ''
                this.data.productos.push([producto.id, producto.descripcion])
                this.searchProductos()
            },

            remover(index){
                this.data.productos.splice(index, 1)
            },

            editProveedor(){
                var button = $('#editProveedor');
                 button.button('loading');
                this.$http.post('/api/updateProveedores', this.data, {headers: this.headers}).then(response => {
                    this.$emit('proveedorEdited'); 
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha modificado proveedor con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>