<template>
    <div class="modal fade modal-fullscreen"  id="modal-negocio" tabindex="-1" role="dialog" aria-hidden="true">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar Negocio</h4>
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
                            <input type="text" v-model="data.categoria_id" class="form-control" placeholder="Categoria">
                            <select  v-model="data.categoria_id" class="form-control selectpicker" data-live-search="true" >
                                <option v-for="(categoria,index) in apiNegocio.categorias" :key="index" v-bind:value="categoria[0]" >{{ categoria[1] }}</option>
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
                        <button type="submit" class="btn btn-success" id="createNegocio" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Crear Producto</button>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                
            </div>
        </div>
        <!-- /.modal-content -->    
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';
    import Vue from 'vue';

    export default {
        props: ['negocioData'],
        watch: {
            negocioData: function() {
                this.errors = []
                if(this.negocioData.length != 0){
                    this.negocio.descripcion = this.negocioData.descripcion
                    this.data.negocio_id = this.negocioData.id
                    this.show = false
                
                    
                }else{
                    this.negocio.descripcion = ''
                    this.data.negocio = ''
                    this.data.negocio_id = ''
                    this.data.categoria_id = ''
                    this.show  = true

                    
                }
            },
        },
        data(){
            return {
                errors: [],
                data: {
                    descripcion: '',
                    categoria_id: '',
                    negocio: '1',
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
                var button = $('#createProducto');
                button.button('loading');
                this.$http.post('/api/productos', this.data).then(response => {
                    this.$emit('negocioCreated'); 
                    this.data = {descripcion: '',categoria_id: '',estado: ''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha creado el negocio con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {  
                                     
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>

<style>
.modal{
    width: 80%; /* respsonsive width */
    margin-left:18.9%; /* width/2) */ 
}
</style>
