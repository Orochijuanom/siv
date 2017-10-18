<template>
    <tbody>
        <tr>
            <td>
                
                <span>{{ index + 1 }}</span>
            </td>
            
            <td>
                <span>{{ usuario.name }}</span>
            </td>

            <td>
                <span>{{ usuario.email }}</span>
            </td>

            <td>
                <span>{{ usuario.tipouser.descripcion }}</span>
            </td>

            <td>
                <span>{{ usuario.estado }}</span>
            </td>

            <td>
                <span>{{ usuario.created_at }}</span>
            </td>
            
            <td>

                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editUsuario', usuario)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>

            </td>
        </tr>

        
    </tbody>


</template>

<script>
export default {
    props:['index', 'usuario'],
}
</script>
