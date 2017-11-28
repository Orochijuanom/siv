<template>
    <div class="modal fade"  id="modal-negocio" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Proveedor</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createProveedor" method="post">


                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nit">Nit :</label>
                                <input type="number" v-model="data.nit" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Nombre :</label>
                                <input type="text" v-model="data.nombre" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Empresa :</label>
                                <input type="text" v-model="data.empresa" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Telefono :</label>
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
                            <span class="tag" v-bind:key="index" v-for="(producto, index) in data.productos">
                            <span>{{producto[1]}}</span>
                            <a title="remover producto" v-on:click="remover(index)">x</a>
                            </span>
                            
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="createProveedor" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Crear Proveedor</button>
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
        
        data(){
            return {
                errors: [],
                data: {
                    nombre: '',
                    email: '',
                    negocio: '1',
                    empresa: '',
                    telefono: '',
                    nit: '',
                    productos: []

                },

                productoQuery: '',
                
            }
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

            createProveedor(){
                var button = $('#createProveedor');
                button.button('loading');
                this.$http.post('/api/proveedores', this.data).then(response => {
                    this.$emit('negocioCreated'); 
                    this.data = {nombre: '',email: '',empresa: '',telefono: '', nit: '', dig: '', productos: []};
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha creado el proveedor con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {  
                                     
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>