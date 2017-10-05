<template>
    <tbody>
        <tr>
            <td>
                
                <span>{{ index + 1 }}</span>
            </td>
            
            <td>

                <span>{{ negocio.descripcion }}</span>
            </td>
            
            <td>
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-history"
                    v-on:click="$emit('vernegocio', negocio)">
                    <span class="fa fa-folder" aria-hidden="true"></span> Ver Datos
                </button>

                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editnegocio', negocio)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>

            </td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" data-toggle="collapse" v-bind:data-target="'#'+negocio.id">
                    <span class="fa fa-eye" aria-hidden="true"></span> Ver  <span class="label label-info">{{negocio.users.length}}</span>
                </button>

                <button type="button" data-toggle="modal" data-target="#modal-fullscreen" class="btn btn-info btn-xs" v-on:click="$emit('crearusuario', negocio)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Agregar
                </button>
            </td>
        </tr>

        <!-- Parientes -->
        <!-- <tr v-if="user.parientes.length > 0" v-bind:id="user.id" class="collapse">
            <td colspan="9">
                <table class="table">
                    <thead>
                        <tr class="info">

                            <th>Rol</th>
                            <th>Tipo</th>
                            <th>Tipo de documento</th>
                            <th>Número de documento</th>
                            <th>Nombre</th>
                            <th>Télefono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="info" v-bind:key=pariente.id v-for="pariente in user.parientes">
                            <td>
                                <span>{{ user.tipouser.descripcion }}</span>
                            </td>
                            <td>
                                <span>{{pariente.parentesco.descripcion}}</span>
                            </td>
                            <td>
                                <span>{{ pariente.tipodocumento.descripcion }}</span>
                            </td>
                            <td>
                                <span>{{ pariente.numero_documento }}</span>
                            </td>
                            <td>
                                <span>{{ pariente.nombres }} {{ pariente.apellidos }}</span>
                            </td>
                            <td>
                                <span v-if="pariente.datoscomplementarios">{{pariente.datoscomplementarios.telefono}}</span>
                                <span v-else>No presenta información</span>
                            </td>
                            <td>
                                <span>{{ pariente.email }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-history"
                                    v-on:click="$emit('veruser', pariente)">
                                    <span class="fa fa-folder" aria-hidden="true"></span> Ver Historial
                                </button>

                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                                    v-on:click="$emit('edituser', pariente)">
                                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                                </button>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr> -->
    </tbody>


</template>

<script>
export default {
    props:['index', 'negocio'],
}
</script>
