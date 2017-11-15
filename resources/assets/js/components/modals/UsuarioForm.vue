<template>
    <div class="modal fade" id="modal-usuarios">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                            <label for="negocio">Nombre :</label>
                            <input type="text" v-model="data.nombre" class="form-control">
                            <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="input-group col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                            <label for="administrador">Email :</label>
                                <input type="text" v-model="data.email" class="form-control">
                            <span class="help-block" v-for="(error, index) in errors.email" :key="index">{{ error }}</span>
                        </div>
                    </div>

                    <div class="input-group col-md-12">
                        <div v-bind:class="{'form-group': true, 'has-error': errors.tipousuario}">
                            <label for="municipio" class="control-label">Tipo de usuario : <span class="required">*</span></label>
                            <select class="form-control" id="municipio" v-model="data.tipousuario">
                                <option :value="tipousuario.id" v-for="(tipousuario, index) in apiNegocio.tipousers" :key="index">{{tipousuario.descripcion}}</option>  
                            </select>                                       
                            <span class="help-block" v-for="(error, index) in errors.municipio" :key="index">{{ error }}</span>
                        </div>
                    </div>
                    <div class="input-group col-md-12">
                        <button v-on:click="createUser" class="btn btn-success" id="createUser" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Crear Usuario</button>
                    </div>                                    
                </div>           
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';
    import Vue from 'vue';

    export default {
        props: ['negocio_id'],
        data(){
            return {
                errors: [],
                data: {
                    nombre: '',
                    email : '',
                    negocio: '',
                    tipousuario: '',

                },
                
                
            }
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        created(){
     
            this.$store.dispatch('getTipousers')
            this.data.negocio = this.negocio_id
            
        },
        methods: {
            
            
            createUser(){
                var button = $('#createUser');
                button.button('loading');
                this.$http.post('/api/users', this.data).then(response => {
                    this.$emit('usuarioCreated'); 
                    this.data = {nombre: '',email: '',tipousuario: ''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha creado el usuario con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {  
                                     
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>