<template>
    <div class="container">
        <h1>Estudiantes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de registro</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="estudiante in estudiantes" :key="estudiante.id">
                    <td>{{estudiante.id}}</td>
                    <td>{{estudiante.nombre}}</td>
                    <td>{{estudiante.created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:{
            estudiantes: {
                type: Object,
                required: true
            }
        }
    }
</script>
