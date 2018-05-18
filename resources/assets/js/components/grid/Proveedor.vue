<template>
    <tbody>
        <tr>
            <td><span>{{ index + 1 }}</span></td>
            <td><span>{{ proveedor.nit }}</span></td>
            <td><span>{{ proveedor.empresa }}</span></td>
            <td><span>{{ proveedor.email }}</span></td>
            <td><span>{{ proveedor.telefono }}</span></td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" data-toggle="collapse" v-bind:data-target="'#'+proveedor.id">
                    <span class="fa fa-eye" aria-hidden="true"></span> Productos  <span class="label label-info">{{proveedor.productos.length}}</span>
                </button>

                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit" 
                    v-on:click="$emit('editproveedor', proveedor)">
                    <span class="fa fa-pencil" aria-hidden="true"></span> Modificar
                </button>
            </td>

        </tr>

        <tr v-if="proveedor.productos.length > 0" v-bind:id="proveedor.id" class="collapse">
            <td colspan="6">
                <table class="table">
                    <thead>
                        <tr class="info">

                            <th>Nº</th>
                            <th>Descripcion</th>
                            <th>Número de parte</th>
                            <th>Fabricante</th>
                            <th>Categoria</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="info" v-bind:key="producto.id" v-for="(producto, ind) in proveedor.productos">
                            <td>
                                <span>{{ ind + 1 }}</span>
                            </td>

                            <td>
                                <span>{{ producto.descripcion }}</span>
                            </td>

                            <td>
                                <span>{{ producto.nparte }}</span>
                            </td>
                            
                            <td>
                                <span>{{ producto.fabricante }}</span>
                            </td>

                            <td>
                                <span>{{ producto.categoria_id }} - {{ producto.categoria.descripcion }}</span>
                            </td>

                            <td>
                                <span v-if="producto.estado == 1">Activo</span><span v-else>Inactivo</span>
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
    props:['index', 'proveedor'],
}
</script>
