<template>
    <div class="modal fade"  id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Editar Producto</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createProducto" method="post">

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.descripcion}">
                                <label for="descripcion">Descripcion :</label>
                                <input type="text" v-model="data.descripcion" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.descripcion" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.parte}">
                                <label for="parte">Número de parte :</label>
                                <input type="text" v-model="data.parte" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.parte" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.fabricante}">
                                <label for="fabricante">Fabricante :</label>
                                <input type="text" v-model="data.fabricante" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.fabricante" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.categoria_id}">
                                <label for="categoria">Categoria :</label>
                                <select  v-model="data.categoria_id" class="form-control selectpicker" data-live-search="true" >
                                    <option value="">Selecione...</option>
                                    <option :value="categoria.id" v-for="(categoria, index) in apiNegocio.categorias" :key="index">{{categoria.descripcion}}</option>  

                                </select>
                                <span class="help-block" v-for="(error, index) in errors.categoria_id" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.estado}">
                                <label for="estado">Estado :</label>
                                <select  v-model="data.estado" class="form-control selectpicker" data-live-search="true">
                                    <option value = ''>Seleccione...</option>
                                    <option value = '1'>Activo</option>
                                    <option value = '0'>Inactivo</option>
                                </select>
                                <span class="help-block" v-for="(error, index) in errors.estado" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="editProducto" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Guardar</button>
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
        props: ['producto', 'token'],
        watch: {
            producto: function() {
                this.errors = []
                if(this.producto != ""){
                    this.data.id = this.producto.id
                    this.data.descripcion = this.producto.descripcion
                    this.data.parte = this.producto.nparte
                    this.data.fabricante = this.producto.fabricante
                    this.data.categoria_id = this.producto.categoria_id
                    this.data.estado = this.producto.estado
                    this.show = true
                
                    
                }else{
                    this.data.id =""
                    this.data.descripcion = ""
                    this.data.categoria = ""
                    this.data.estado = ""
                    this.show  = true

                    
                }
            },
        },
        data(){
            return {
                errors: [],
                data: {
                    id: '',
                    descripcion: '',
                    categoria_id: '',
                    estado: ''

                },
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                },
                categoria:{
                    descripcion: '',
                },

                show: true
                
            }
        },
         created(){
            this.getCategorias();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {

            getCategorias(){
                this.$store.dispatch('getCategorias', {
                   
                });
            },
            
            
            createProducto(){
                var button = $('#editProducto');
                button.button('loading');
                this.$http.post('/api/updateProductos', this.data, {headers: this.headers}).then(response => {
                    this.$emit('productoEdit'); 
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha modificado el producto con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>
