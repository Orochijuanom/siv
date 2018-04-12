<template>
    <li class="treeview">
        <a href="#">
        <i class="fa fa-bar-chart-o"></i> <span>Cotizaciones</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li><a v-bind:href="'/'+ url +'/oportunidades/abiertas'"><i class="fa fa-circle-o text-blue"></i> Pendientes
            <span class="pull-right-container">
              <span class="label pull-right bg-blue">{{apiNegocio.numeroabiertas}}</span>
            </span>
        </a></li>
        <li><a v-bind:href="'/'+ url +'/oportunidades/seguimiento'"><i class="fa fa-circle-o text-yellow"></i> Seguimientos
            <span class="pull-right-container">
              <span class="label pull-right bg-yellow">0</span>
            </span>
        </a></li>
        <li><a v-bind:href="'/'+ url +'/oportunidades/cerradas'"><i class="fa fa-circle-o text-green"></i> Cerradas
            <span class="pull-right-container">
              <span class="label pull-right bg-green">0</span>
            </span>
        </a></li>
        <li><a v-bind:href="'/'+ url +'/oportunidades/vencidas'"><i class="fa fa-circle-o text-red"></i> Vencidas
            <span class="pull-right-container">
              <span class="label pull-right bg-red">{{apiNegocio.numerovencidas}}</span>
            </span>
        </a></li>
        </ul>
    </li>
</template>
<script>
  import {mapState} from 'vuex';
  import Vue from 'vue';
export default {
    data(){
        return { 
            headers:  {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + this.token
                }
        }
    },
    
    props: ['url', 'token'],
    created(){
            this.getNumeroAbiertas();
            this.getNumeroVencidas();
        },
        computed: mapState({
            apiNegocio: state => state.apiNegocio
        }),
        methods: {
            getNumeroAbiertas(){
                this.$store.dispatch('getNumeroAbiertas', {
                    headers: this.headers
                });
            },

            getNumeroVencidas(){
                this.$store.dispatch('getNumeroVencidas', {
                    headers: this.headers
                });
            },
        }
}
</script>
