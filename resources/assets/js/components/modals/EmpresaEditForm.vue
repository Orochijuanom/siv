<template>
    <div class="modal fade"  id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Editar Empresa</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createEmpresas" method="post">

                        <div class="col-md-12" >
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nit">Nit :</label>
                                <input type="text" v-model="data.nit" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                            </div>
                        </div>
                        
                    
                        <div class="col-md-12" >
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Descripcion :</label>
                                <input type="text" v-model="data.descripcion" class="form-control" >
                                <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12" >
                            <div v-bind:class="{'form-group': true, 'has-error': errors.logo}">
                                <label for="nombre">Logo :</label>
                                <input type="text" v-model="data.logo" class="form-control" >
                                <div v-if="!image">
                                    <h2>Select an image</h2>
                                    <input type="file" @change="onFileChange">
                                </div>
                                <div v-else>
                                    <img :src="image" style="width: 400px; height: 200px; padding: 20px;" />
                                    <button @click="removeImage">Remove image</button>
                                </div>
                                <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12" >
                            <div v-bind:class="{'form-group': true, 'has-error': errors.direccion}">
                                <label for="nombre">Direccion :</label>
                                <input type="text" v-model="data.direccion" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12" >
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                                <label for="nombre">Telefono :</label>
                                <input type="number" v-model="data.telefono" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.telefono" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                                <label for="email">Email :</label>
                                <input type="email" v-model="data.email" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.email" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="editEmpresa" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Guardar</button>
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
        props: ['empresaData'],
        watch: {
            empresaData: function() {
                this.errors = []

                if(this.empresaData.id != ''){
                    this.data.id = this.empresaData.id
                    this.data.descripcion = this.empresaData.descripcion
                    this.data.email = this.empresaData.email
                    this.data.direccion= this.empresaData.direccion
                    this.data.negocio= this.empresaData.negocio
                    this.data.logo= this.empresaData.logo
                    this.data.telefono= this.empresaData.telefono
                    this.data.nit= this.empresaData.nit
                    
                    //this.show = false
                }else{
                    this.data.id = ''
                    this.data.descripcion = ""
                    this.data.email = ""
                    this.data.direccion= ""
                    this.data.negocio= ""
                    this.data.logo= ""
                    this.data.telefono= ""
                    this.data.nit= ""  
                }
            },
        },
        data(){
            return {
                errors: [],
                data: {
                    id:'',
                    descripcion: '',
                    email: '',
                    direccion: '',
                    negocio: '',
                    logo: '',
                    telefono: '',
                    nit: '',
                    image: '',
                },
                image: '',
                

                show: true
                
            }
        },
        methods: {
            
            
            createEmpresas(){
                var button = $('#editEmpresa');
                button.button('loading');
                this.$http.post('/api/updateEmpresas', this.data).then(response => {
                    this.$emit('empresaEdited'); 
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha modificado la empresa con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {                                
                    this.errors = response.data;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true});
                });
            },

            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            }
        }
    }
</script>

<<style>
    img {
        width: 30%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
        border: 1px bold black;
    }
</style>
