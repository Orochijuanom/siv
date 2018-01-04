<template>
    <div class="modal fade" id="modal-usuarios" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar usuario</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="input-group col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Nombre :</label>
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
                <div class="modal-footer">
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
        props: ['token'],
        data(){
            return {
                errors: [],
                data: {
                    nombre: '',
                    email : '',
                    tipousuario: '',

                },
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                }
                
            }
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        created(){
     
            this.$store.dispatch('getTipousers')
            
        },
        methods: {
            
            
            createUser(){
                var button = $('#createUser');
                button.button('loading');
                this.$http.post('/api/users', this.data, {headers: this.headers}).then(response => {
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