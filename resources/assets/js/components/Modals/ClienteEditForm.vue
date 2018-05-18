<template>
    <div class="modal fade"  id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="editCliente" method="post">


                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nit}">
                                <label for="nit">Nit :</label>
                                <input type="number" v-model="data.nit" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">nombre :</label>
                                <input type="text" v-model="data.nombre" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.telefono}">
                                <label for="telefono">Telefono :</label>
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
        

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="editCliente" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Guardar</button>
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

        props: ['clienteData', 'token'],
       
        data(){
            return {
                errors: [],
                data: {
                    id: '',
                    email: '',
                    cliente: '',
                    telefono: '',
                    nit: '',

                },
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                },
                envi: {
                    id: '',
                    tipo: '',
                },


                productoQuery: '',
                
            }
        },
        watch:{
            clienteData: function() {
                this.errors = []
                if(this.clienteData.id != ''){
                    this.data.id = this.clienteData.id;
                    this.data.email= this.clienteData.email;
                    this.data.nombre= this.clienteData.nombre;
                    this.data.telefono= this.clienteData.telefono;
                    this.data.nit= this.clienteData.nit;

                }else{
                    this.data.id= "";
                    this.data.email= "";
                    this.data.nombre= "";
                    this.data.telefono= "";
                    this.data.nit= "";
                    this.data.productos= []
                    
                }
            },
        },

        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),

        methods: {

            editCliente(){
                var button = $('#editCliente');
                 button.button('loading');
                this.$http.post('/api/updateClientes', this.data, {headers: this.headers}).then(response => {
                    this.$emit('clienteEdited'); 
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha modificado cliente con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>