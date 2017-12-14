<template> 

    <div>
        <template v-if="spinner">
            <i class="fa fa-spinner fa-spin"></i>
            <span>Cargando ...</span>
        </template>
        
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Solicitar cotización</h3> 
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nit}">
                                <label for="administrador">URL :</label>
                                    <input type="text" v-model="url"  class="form-control" readOnly>
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nit}">
                                <label for="administrador">IFRAME :</label>
                                    <input type="text" v-model="iframe" class="form-control" readOnly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.nit}">
                                <label for="administrador">NIT* :</label>
                                    <input type="text" v-model="data.nit" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.nit" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.empresa}">
                                <label for="administrador">Empresa* :</label>
                                    <input type="text" v-model="data.empresa" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.empresa" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.solicitante}">
                                <label for="administrador">Solicitante* :</label>
                                    <input type="text" v-model="data.solicitante" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.solicitante" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.cargo}">
                                <label for="administrador">Cargo* :</label>
                                    <input type="text" v-model="data.cargo" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.cargo" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.telefono}">
                                <label for="administrador">Telefono* :</label>
                                    <input type="text" v-model="data.telefono" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.telefono" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                                <label for="administrador">Email* :</label>
                                    <input type="text" v-model="data.email" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.email" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.fecha}">
                                <label for="administrador">Fecha de respuesta esperada* :</label>
                                    <input type="datetime-local" v-model="data.fecha" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.fecha" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.presupuesto}">
                                <label for="administrador">Presupuesto* : <i>(Sin puntos ni signos de moneda)</i></label>
                                    <input type="text" v-model="data.presupuesto" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.presupuesto" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.moneda}">
                                <label for="moneda" class="control-label">Moneda : <span class="required">*</span></label>
                                <select class="form-control" id="moneda" v-model="data.moneda">
                                    <option :value="moneda.id" v-for="(moneda, index) in apiNegocio.monedas" :key="index">{{moneda.simbolo}} {{moneda.siglas}}</option>  
                                </select>                                       
                                <span class="help-block" v-for="(error, index) in errors.municipio" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div v-bind:class="{'form-group': true, 'has-error': errors.descripcion}">
                                <label for="administrador">Descripcion* :</label>
                                    <input type="text" v-model="data.descripcion" class="form-control">
                                <span class="help-block" v-for="(error, index) in errors.descripcion" :key="index">{{ error }}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <button v-on:click="enviar" class="btn btn-success" id="createOportunidad" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Enviando">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</template> 
 
<script>
    import {mapState} from 'vuex';
    export default { 
        props: ['urll', 'negocio', 'token'],
        data () { 
            return {
                errors: [],  
                url: this.urll+"/oportunidades/negocio/"+this.negocio,
                iframe: "<iframe src='"+this.urll+"/oportunidades/negocio/"+ this.negocio +"' width=100% height=100%>Texto para cuando el navegador no conoce la etiqueta iframe</iframe>",
                data: { 
                    nombre: '', 
                    email: '', 
                    negocio: this.negocio, 
                    empresa: '', 
                    telefono: '', 
                    nit: '',
                    cargo: '', 
                    fecha: '', 
                    presupuesto: '',
                    moneda: '', 
                    descripcion: '' 
                },
                spinner: false, 
                 
            } 
        },
        created(){
            this.$store.dispatch('getMonedas')
            //this.data.negocio = this.negocio.id
        }, 
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: { 
            enviar(){ 
                var button = $('#createOportunidad');
                button.button('loading');
                this.$http.post('/api/oportunidades', this.data).then(response => {                         
                    button.button('reset');
                    toastr.success('Se ha guardado el requerimiento con exito.', 'Exito', {timeOut: 5000,closeButton:true});
                    this.data.solicitante = '' 
                    this.data.email = '' 
                    this.data.empresa = '' 
                    this.data.telefono = '' 
                    this.data.nit = ''
                    this.data.fecha = ''
                    this.data.presupuesto = ''
                    this.data.moneda = ''
                    this.data.descripcion = ''
                }, response => {                         
                    this.errors = response.data.errors;
                    button.button('reset');
                    toastr.error('Ocurrio un error', 'Error', {timeOut: 5000,closeButton:true}); 
                }); 
            } 
        } 
    } 
</script> 