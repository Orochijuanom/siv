<template>
    <tbody>
        <tr>
            <td><span>{{ index + 1 }}</span></td>
            <td><span>{{ cliente.nit }}</span></td>
            <td><span>{{ cliente.nombre }}</span></td>
            <td><span>{{ cliente.email }}</span></td>
            <td><span>{{ cliente.telefono }}</span></td>
            <td>
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editcliente', cliente)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>
            </td>

        </tr>

        
    </tbody>


</template>

<script>
export default {
    props:['index', 'cliente'],
}
</script>
