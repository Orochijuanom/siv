<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                 <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">Example Component</div>
                                <div class="panel-body">
                                    <label>Nombre:</label>
                                    <input type="text" v-model="user.nombre"/>
                                    <label>Email:</label>
                                    <input type="text" v-model="user.email"/>
                                    <label>Negocio:</label>
                                    <input type="text" v-model="user.negocio"/>

                                    <button v-on:click="enviar"> Guardar</button>
                                </div>
                            </div>
                        </div>
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
                    negocio: '',
                },
                
            }
        },
        methods: {
            enviar(){
                this.$http.post('/api/administrador', this.user).then(response => {                        
                
                   this.user.nombre = ''
                   this.user.email = ''
                   this.user.negocio = '' 
                }, response => {                        
                   console.log('error')
                });
            }
        }
    }
</script>
