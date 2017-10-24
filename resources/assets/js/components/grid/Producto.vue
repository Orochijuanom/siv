<template>
    <tbody>
        <tr>
            <td><span>{{ index + 1 }}</span></td>
            <td><span>{{ producto.descripcion }}</span></td>
            <td><span>{{ producto.categoria_id }} - {{ producto.categoria.descripcion }}</span></td>
            <td><span v-if="producto.estado == 1">Activo</span><span v-else>Inactivo</span></td>
            <td>
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editproducto', producto)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>
            </td>

        </tr>

        
    </tbody>


</template>

<script>
export default {
    props:['index', 'producto'],
}
</script>
