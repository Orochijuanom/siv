<template>
    <tbody>
        <tr>
            <td><span>{{ index + 1 }}</span></td>
            <td><span>{{ proveedor.nit }}</span></td>
            <td><span>{{ proveedor.nombre }}</span></td>
            <td><span>{{ proveedor.empresa }}</span></td>
            <td><span>{{ proveedor.email }}</span></td>
            <td><span>{{ proveedor.telefono }}</span></td>
            <td>
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editproveedor', proveedor)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>
            </td>

        </tr>

        
    </tbody>


</template>

<script>
export default {
    props:['index', 'proveedor'],
}
</script>
