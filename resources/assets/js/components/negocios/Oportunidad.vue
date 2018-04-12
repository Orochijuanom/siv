<template>
    <tbody>
        <tr>
            <td><span>{{ index + 1 }}</span></td>
            <td><span>{{ oportunidad.descripcion }}</span></td>
            <td><span>{{ oportunidad.solicitante }}</span></td>
            <td><span>{{ oportunidad.empresa }}</span></td>
            <td><span>{{ oportunidad.email }}</span></td>
            <td><span>{{ oportunidad.telefono }}</span></td>
            <td><span>{{ oportunidad.created_at }}</span></td>
            <td><span>{{ oportunidad.fecha_requerida }}</span></td>
            <td><span>{{ oportunidad.moneda.siglas }}</span></td>
            <td><span>{{ oportunidad.presupuesto }}</span></td>
            <!-- <td>
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-cotizacion" 
                    v-on:click="$emit('editempresa', oportunidad)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>
            </td> -->

        </tr>

        
    </tbody>


</template>

<script>
export default {
    props:['index', 'oportunidad'],
}
</script>
