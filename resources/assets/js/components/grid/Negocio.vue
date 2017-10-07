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

                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editnegocio', negocio)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>

            </td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" data-toggle="collapse" v-bind:data-target="'#'+negocio.id">
                    <span class="fa fa-eye" aria-hidden="true"></span> Ver  <span class="label label-info">{{negocio.users.length}}</span>
                </button>

                <button type="button" data-toggle="modal" data-target="#modal-negocio" class="btn btn-info btn-xs" v-on:click="$emit('crearusuario', negocio)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Agregar
                </button>
            </td>
        </tr>

        <!-- usuarios -->
        <tr v-if="negocio.users.length > 0" v-bind:id="negocio.id" class="collapse">
            <td colspan="4">
                <table class="table">
                    <thead>
                        <tr class="info">

                            <th>Rol</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="info" v-bind:key="user.id" v-for="user in negocio.users">
                            <td>
                                <span>{{ user.tipouser.descripcion }}</span>
                            </td>

                            <td>
                                <span>{{ user.name }}</span>
                            </td>

                            <td>
                                <span>{{ user.email }}</span>
                            </td>
                            
                            <td>

                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                                    v-on:click="$emit('edituser', user)">
                                    <span class="fa fa-pencil" aria-hidden="true"></span> Editar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>


</template>

<script>
export default {
    props:['index', 'negocio'],
}
</script>
