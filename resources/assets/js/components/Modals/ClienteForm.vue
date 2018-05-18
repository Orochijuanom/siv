<template>
    <div class="modal fade"  id="modal-negocio" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createCliente" method="post">


                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nit}">
                                <label for="nit">Nit :</label>
                                <input type="number" v-model="data.nit" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Nombre :</label>
                                <input type="text" v-model="data.nombre" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.telefono}">
                                <label for="nombre">Telefono :</label>
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
                            <button type="submit" class="btn btn-success" id="createCliente" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Crear Cliente</button>
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
        props: ['token'],
        data(){
            return {
                errors: [],
                data: {
                    email: '',
                    nombre: '',
                    telefono: '',
                    nit: '',

                },
                headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                },
               
                
            }
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),

        methods: {


            createCliente(){
                var button = $('#createCliente');
                button.button('loading');
                this.$http.post('/api/clientes', this.data, {headers: this.headers}).then(response => {
                    this.$emit('clienteCreated'); 
                    this.data = {email: '',nombre: '',telefono: '', nit: ''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha creado el cliente con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {  
                                     
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },
        }
    }
</script>