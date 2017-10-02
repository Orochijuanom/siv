<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedores  </div>
                    <div class="panel-body">
                        <!--form class="form-horizontal" role="form"-->
                        <div class="form-horizontal">   
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nit:</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder='Nit'   v-model="user.nit"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Digito Verificacion:</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" maxlength=2   placeholder='Digito'  v-model="user.dig"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder='Nombre'  v-model="user.nombre"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Empresa:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder='Empresa'   v-model="user.empresa"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Telefono:</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder='Telefono'  v-model="user.telefono"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Correo Electronico:</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" placeholder='Email'   v-model="user.email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Negocio:</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder='1' value="1"  v-model="user.negocio"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button v-on:click="enviar" class="btn btn-success"> Guardar</button>
                                </div>
                            </div>
                        </div>
                        <!--/form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                user: {
                    nombre: '',
                    email: '',
                    negocio: '1',
                    empresa: '',
                    telefono: '',
                    nit: '',
                    dig: ''
                },
                
            }
        },
        methods: {
            enviar(){
                this.$http.post('/api/proveedores', this.user).then(response => {                        
                    console.log(response);
                   this.user.nombre = ''
                   this.user.email = ''
                   this.user.negocio = '' 
                   this.user.empresa = ''
                   this.user.telefono = ''
                   this.user.nit = ''
                   this.user.nit = ''   
                }, response => {                        
                   console.log('error')
                });
            }
        }
    }
</script>
