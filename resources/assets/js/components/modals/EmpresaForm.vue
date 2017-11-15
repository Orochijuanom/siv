<template>
<div class="modal fade" id="modal-negocio">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form v-on:submit.prevent="createEmpresas" method="post">
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
                    <label for="nombre">Descripcion :</label>
                    <input type="text" v-model="data.descripcion" class="form-control" placeholder="Nombre">
                    <span class="help-block" v-for="(error, index) in errors.nombre" :key="index">{{ error }}</span>
                </div>
            </div>
            <div class="col-md-12" v-show="show">
                <div v-bind:class="{'form-group': true, 'has-error': errors.logo}">
                    <label for="nombre">Logo :</label>
                    <input type="text" v-model="data.logo" class="form-control" placeholder="Logo">
                    <div v-if="!image">
                        <h2>Select an image</h2>
                        <input type="file" @change="onFileChange">
                    </div>
                    <div v-else>
                        <img :src="image" />
                        <button @click="removeImage">Remove image</button>
                    </div>
                    <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                </div>
            </div>

            <div class="col-md-12" v-show="show">
                <div v-bind:class="{'form-group': true, 'has-error': errors.direccion}">
                    <label for="nombre">Direccion :</label>
                    <input type="text" v-model="data.direccion" class="form-control" placeholder="Direccion">
                    <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                </div>
            </div>

            <div class="col-md-12" v-show="show">
                <div v-bind:class="{'form-group': true, 'has-error': errors.nombre}">
                    <label for="nombre">Telefono :</label>
                    <input type="number" v-model="data.telefono" class="form-control" placeholder="Telefono">
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
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success" id="createEmpresa" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Crear Empresa</button>
            </div>            
        </form>
      </div>      
    </div>
  </div>
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
                    descripcion: '',
                    email: '',
                    direccion: '',
                    negocio: '1',
                    logo: '',
                    telefono: '',
                    nit: '',
                    dig: '',
                    image: '',

                },
                
                negocio:{
                    nombre: '',
                },

                show: true
                
            }
        },
        methods: {
            
            
            createEmpresas(){
                var button = $('#createEmpresas');
                button.button('loading');
                this.$http.post('/api/empresas', this.data).then(response => {
                    this.$emit('negocioCreated'); 
                    this.data = {descripcion: '',email: '',logo: '',telefono: '', nit: '', dig: ''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    button.button('reset');
                    toastr.success('Se ha creado la empresa con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                }, response => {  
                                     
                    this.errors = response.data.errors;
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
