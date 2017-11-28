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

                        <div class="col-md-12" v-show="!show">
                            <br/>
                            <label for="pariente" class="control-label">Negocio:</label>
                            <br/>
                            <span class="tag" v-if="negocio.descripcion != ''">
                            <span>{{negocio.descripcion}}</span>
                            
                            </span>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-md-12" v-show="show">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.descripcion}">
                                <label for="descripcion">Descripcion :</label>
                                <input type="text" v-model="data.descripcion" class="form-control" placeholder="Descripcion">
                                <span class="help-block" v-for="(error, index) in errors.descripcion" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12" v-show="show">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.categoria}">
                                <label for="categoria">Categoria :</label>
                                <select  v-model="data.categoria_id" class="form-control selectpicker" data-live-search="true" >
                                    <option value="">Selecione...</option>
                                    <option :value="categoria.id" v-for="(categoria, index) in apiNegocio.categorias" :key="index">{{categoria.descripcion}}</option>  

                                </select>
                                <span class="help-block" v-for="(error, index) in errors.categoria" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12" v-show="show">
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
        props: ['producto'],
        watch: {
            producto: function() {
                this.errors = []
                if(this.producto != ""){
                    this.data.id = this.producto.id
                    this.data.descripcion = this.producto.descripcion
                    this.data.categoria_id = this.producto.categoria_id
                    this.data.estado = this.producto.estado
                    this.data.negocio = this.producto.negocio
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
                    negocio: '',
                    estado: ''

                },
                
                negocio:{
                    descripcion: '',
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
                console.log(this.apiNegocio.categorias);
            },
            
            
            createProducto(){
                var button = $('#editProducto');
                button.button('loading');
                this.$http.post('/api/updateProductos', this.data).then(response => {
                    this.$emit('productoEdit'); 
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha modificado el producto con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>
