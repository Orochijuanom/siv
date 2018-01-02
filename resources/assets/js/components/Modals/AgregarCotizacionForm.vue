<template>
    <div class="modal fade"  id="modal-cotizacion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Cotización</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createCotizacion" method="post">
                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.versionc}">
                                <label for="nit">Versión :</label>
                                <input type="number" v-model="data.versionc" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.versionc" :key="index">{{ error }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.descuento}">
                                <label for="nit">Descuento :</label>
                                <input type="number" v-model="data.descuento" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.descuento" :key="index">{{ error }}</span>
                            </div>
                        </div>                                                
                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.oportunidade_id}">
                                <label for="nombre">Oportunidad :</label>
                                <input type="text" v-model="data.oportunidade_id" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.oportunidade_id" :key="index">{{ error }}</span>
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
                            <table v-if="data.productos"  class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>ID</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Valor/U</th>
                                        <th>Fecha Entrega</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-bind:key="index" v-for="(producto, index) in data.productos">
                                        <td>{{index+1}}</td>
                                        <td>{{producto.producto_id}}</td>
                                        <td>{{producto.descripcion}}</td>
                                        <td><input type="numeric" v-model="data.productos[index].valor" /></td>
                                        <td>
                                            <input type="numeric" v-model="data.productos[index].cantidad" />                                            
                                        </td>
                                        <td>
                                            <input type="date" v-model="data.productos[index].fecha_entrega" />                                            
                                        </td>                                        
                                        <td>{{data.productos[index].cantidad*data.productos[index].valor}}
                                            <a title="remover producto" v-on:click="remover(index)">x</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>                            
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="createCotizacion" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Guardar</button>
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
                    versionc: '',
                    oportunidade_id:'',
                    descuento:'',
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
                this.data.productos.push({'producto_id':producto.id, 'descripcion':producto.descripcion,'valor':0,'cantidad':0,'fecha_entrega':''})
                this.searchProductos()
            },

            remover(index){
                this.data.productos.splice(index, 1)
            },

            createCotizacion(){
                var button = $('#createProveedor');
                button.button('loading');
                this.$http.post('/api/crearCotizacion', this.data).then(response => {
                    this.$emit('negocioCreated'); 
                    this.data = {versionc: '',oportunidade_id:'', productos: []};
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