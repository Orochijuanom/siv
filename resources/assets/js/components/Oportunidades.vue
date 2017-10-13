<template> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-8 col-md-offset-2"> 
                <div class="panel panel-default"> 
                    <div class="panel-heading">Oportunidades  </div> 
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
                                <label class="col-lg-2 control-label">Empresa:</label> 
                                <div class="col-lg-10"> 
                                    <input type="text" class="form-control" placeholder='Empresa'   v-model="user.empresa"/> 
                                </div> 
                            </div> 
                            <div class="form-group"> 
                                <label class="col-lg-2 control-label">Solicitante:</label> 
                                <div class="col-lg-10"> 
                                    <input type="text" class="form-control" placeholder='Solicitante'  v-model="user.solicitante"/> 
                                </div> 
                            </div> 
                            <div class="form-group"> 
                                <label class="col-lg-2 control-label">Cargo:</label> 
                                <div class="col-lg-10"> 
                                    <select  class="form-control"  v-model="user.cargo"> 
                                        <option value = "ADMINISTRADOR">ADMINISTRADOR</option> 
                                        <option value = "OTRO">OTRO</option> 
                                    </select> 
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
                                <label class="col-lg-2 control-label">Fecha - hora Respuesta:</label> 
                                <div class="col-lg-10"> 
                                    <input type="datetime-local" class="form-control" placeholder='Fecha'   v-model="user.fecha"/> 
                                </div> 
                            </div> 
                            <div class="form-group"> 
                                <label class="col-lg-2 control-label">Presupuesto:</label> 
                                <div class="col-lg-10"> 
                                    <input type="number" class="form-control" placeholder='Presupuesto'  v-model="user.presupuesto"/> 
                                </div> 
                            </div> 
                            <div class="form-group"> 
                                <label class="col-lg-2 control-label">Negocio:</label> 
                                <div class="col-lg-10"> 
                                    <input type="number" class="form-control" placeholder='1' value="1"  v-model="user.negocio"/> 
                                </div> 
                            </div> 
                            <div class="form-group"> 
                                <label class="col-lg-2 control-label">Solicita:</label> 
                                <div class="col-lg-10"> 
                                    <textarea class="form-control" placeholder='Solicita'  v-model="user.descripcion"></textarea> 
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
                    dig: '', 
                    cargo: '', 
                    fecha: '', 
                    presupuesto: '', 
                    descripcion: '' 
                }, 
                 
            } 
        }, 
        methods: { 
            enviar(){ 
                this.$http.post('/api/oportunidades', this.user).then(response => {                         
                    console.log(response); 
                   this.user.solicitante = '' 
                   this.user.email = '' 
                   this.user.negocio = ''  
                   this.user.empresa = '' 
                   this.user.telefono = '' 
                   this.user.nit = '' 
                   this.user.dig = ''
                   this.user.fecha = ''
                   this.user.presupuesto = ''
                   this.user.descripcion = ''
                }, response => {                         
                   console.log('error') 
                }); 
            } 
        } 
    } 
</script> 