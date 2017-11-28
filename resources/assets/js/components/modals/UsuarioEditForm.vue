<template>
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">    
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Editar usuario</h4>
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
                            <button v-on:click="createUser" class="btn btn-success" id="editUser" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Guardar</button>
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
        props: ['negocio_id','userData'],
        data(){
            return {
                errors: [],
                data: {
                    id:'',
                    nombre: '',
                    email : '',
                    negocio: '',
                    tipousuario: '',
                    negocio:'',

                },
                
                
            }
        },
        watch:{
            userData: function() {
                this.errors = []
                if(this.userData.id != ''){
                    this.data.id = this.userData.id
                    this.data.nombre = this.userData.name
                    this.data.email = this.userData.email
                    this.data.tipousuario= this.userData.tipouser_id
                    this.data.negocio= this.userData.negocio_id
                }else{
                    this.data.id = ''
                    this.data.nombre = ""
                    this.data.email = ""
                    this.data.email= ""
                    this.data.negocio= ""
                    this.data.tipousuario= ""
                    this.data.negocio=""
                    this.show  = true   
                }
            },
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
                var button = $('#editUser');
                button.button('loading');
                this.$http.post('/api/updateUsers', this.data).then(response => {
                    this.$emit('userEdited'); 
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha modificado el usuario con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>