<template>
    <div class="modal fade modal-fullscreen" id="modal-negocio" tabindex="-1" role="dialog" aria-hidden="true">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar Negocio</h4>
            </div>
            <div class="modal-body">
                <form v-on:submit.prevent="createNegocio" method="post">

                    <div class="col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.negocio}">
                            <label for="negocio">Negocio :</label>
                            <input type="text" v-model="data.negocio" class="form-control">
                            <span class="help-block" v-for="(error, index) in errors.negocio" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.administrador}">
                            <label for="administrador">Usuario Administrador :</label>
                             <input type="text" v-model="data.adminstrador" class="form-control">
                            <span class="help-block" v-for="(error, index) in errors.administrador" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                            <label for="email">Documento :</label>
                            <input type="email" v-model="data.email" class="form-control">
                            <span class="help-block" v-for="(error, index) in errors.email" :key="index">{{ error }}</span>
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
                    negocio: '',
                    administrador : '',
                    email: '',

                },
                
                negocio:{
                    nombre: '',
                },

                show: true
                
            }
        },
        methods: {
            
            
            createNegocio(){
                var button = $('#createNegocio');
                button.button('loading');
                this.$http.post('/api/negocio', this.data).then(response => {
                    this.$emit('negocioCreated'); 
                    this.data = {negocio: '',administrador: '',email: ''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha creado el usuario con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>