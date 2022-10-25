<template>
    <div class="container">
        <h1>Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="usuario in usuarios" :key="usuario.id">
                    <td>{{usuario.id}}</td>
                    <td>{{usuario.name}}</td>
                    <td>{{usuario.email}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:{
            usuarios: {
                type: Object,
                required: true
            }
        }
    }
</script>
