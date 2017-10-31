<template>
    <div class="modal fade modal-fullscreen"  id="modal-negocio" tabindex="-1" role="dialog" aria-hidden="true">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar Negocio</h4>
            </div>
            <div class="modal-body">
                <form v-on:submit.prevent="createProveedor" method="post">

                    <div class="col-md-12" v-show="!show">
                        <br/>
                        <label for="pariente" class="control-label">Negocio:</label>
                        <br/>
                        <span class="tag" v-if="negocio.nombre != ''">
                        <span>{{negocio.nombre}}</span>
                        
                        </span>
                        <br/>
                        <br/>
                    </div>

                    <div class="col-md-12" v-show="show">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                            <label for="nit">Nit :</label>
                            <input type="number" v-model="data.nit" class="form-control" placeholder="Nit">
                            <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                        </div>
                    </div>
                    
                    <div class="col-md-12" v-show="show">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                            <label for="nombre">Digito Verificacion :</label>
                            <input type="text" v-model="data.dig" class="form-control" placeholder="Digito">
                            <span class="help-block" v-for="(error, index) in errors.dig" :key="index">{{ error }}</span>
                        </div>
                    </div>


                    <div class="col-md-12" v-show="show">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                            <label for="nombre">Nombre :</label>
                            <input type="text" v-model="data.nombre" class="form-control" placeholder="Nombre">
                            <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="col-md-12" v-show="show">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                            <label for="nombre">Empresa :</label>
                            <input type="text" v-model="data.empresa" class="form-control" placeholder="Empresa">
                            <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="col-md-12" v-show="show">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                            <label for="nombre">Telefono :</label>
                            <input type="text" v-model="data.telefono" class="form-control" placeholder="Telefono">
                            <span class="help-block" v-for="(error, index) in errors.telefono" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                            <label for="email">Email :</label>
                            <input type="email" v-model="data.email" class="form-control" placeholder="Email">
                            <span class="help-block" v-for="(error, index) in errors.email" :key="index">{{ error }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.productos}">
                            <label for="email">Productos (Para selecionar varios presione CTRL y haga clic sobre los productos deseados) :</label>
                            <select  v-model="data.productos" class="form-control selectpicker" data-live-search="true" multiple>
                                <option value="">Selecione...</option>
                                <option :value="producto.id" v-for="(producto, index) in apiNegocio.productos" :key="index">{{producto.descripcion}}</option>  
                            </select>
                            <span class="help-block" v-for="(error, index) in errors.productos" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success" id="createNegocio" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Crear Negocio</button>
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
                    this.negocio.nombre = this.negocioData.descripcion
                    this.data.negocio_id = this.negocioData.id
                    this.show = false
                
                    
                }else{
                    this.negocio.nombre = ''
                    this.data.negocio = ''
                    this.data.negocio_id = ''
                    this.data.email = ''
                    this.show  = true

                    
                }
            },
        },
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
                    dig: '',
                    productos: []

                },
                
                negocio:{
                    nombre: '',
                },

                show: true
                
            }
        },

        created(){
            this.$store.dispatch('getProductosSelect', {});
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),

        methods: {

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