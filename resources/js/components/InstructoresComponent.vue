<template>
    <div class="">
        <div class="my-2">
            <button type="button" class="btn btn-success btn-md" @click="addFormModal">
                <i class="fas fa-fw fa-plus"></i>
                Agregar
            </button>
        </div>

        <div class="modal fade" ref="exampleModal" data-backdrop="static" data-backd></div>

        <table class="table table-responsive-lg">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Calificación</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="instructor in instructores" :key="instructor.id">
                    <td>{{ instructor.id }}</td>
                    <th>{{ instructor.usuario }}</th>
                    <th>{{ instructor.calificacion }}</th>
                    <th>{{ instructor.especialidad }}</th>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" @click="editFormModal(instructor)">
                            <i class="fas fa-fw fa-edit"></i>
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteFormModal(instructor)">
                            <i class="fas fa-fw fa-trash"></i>
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" ref="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <span v-if="Type == 'add'">Agregar Instructor</span>
                            <span v-else-if="Type == 'edit'">Editar Instructor</span>
                        </h5>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formulario">
                            <div class="mb-3">
                                <input type="hidden" :value="fields.id" />

                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" v-model="fields.usuario" class="form-control" id="usuario"
                                    aria-describedby="usuario" name="usuario" required />

                                <label for="calificacion" class="form-label">Calificación</label>
                                <input type="text" v-model="fields.calificacion" class="form-control" id="calificacion"
                                    aria-describedby="calificacion" name="calificacion" required />

                                <label for="especialidad" class="form-label">Especialidad</label>
                                <input type="text" v-model="fields.especialidad" class="form-control" id="especialidad"
                                    aria-describedby="especialidad" name="especialidad" required />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary" @click="addUpdateElement">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from "axios";
import { Modal } from "bootstrap";

export default {
    props: {
        instructores: {
            type: [Object, Array],
            required: true,
        },
    },
    data() {
        return {
            InstructoresTable: this.instructores,
            Type: "add",
            fields: {
                id: "",
                usuario: "",
                calificacion: "",
                especialidad: "",
            },
        };
    },

    mounted() {
        this.modal = new Modal(this.$refs.exampleModal);
    },
    methods: {
        openModal() {
            this.modal.show();
        },
        closeModal() {
            this.fields.usuario = "";
            this.fields.calificacion = "",
            this.fields.especialidad = "",
            this.modal.hide();
        },
        addFormModal() {
            this.Type = "add";
            this.fields.usuario = "";
            this.fields.calificacion = "",
            this.fields.especialidad = "",
            this.openModal();
        },
        editFormModal(instructor) {
            this.Type = "edit";
            this.fields.id           = instructor.id;
            this.fields.usuario      = instructor.usuario;
            this.fields.calificacion = instructor.calificacion,
            this.fields.especialidad = instructor.especialidad,
            this.openModal();
        },
        deleteFormModal(instructor) {
            this.fields.id = instructor.id;
            axios
                .post("/eliminar-instructor/" + this.fields.id)
                .then((response) => {
                    if (response.status == 200) {
                        Swal.fire({
                            toast: true,
                            icon: "success",
                            iconColor: "white",
                            title:
                                '<h1 style="color:white; font-size:1.4rem !important;">El registro ha sido eliminado con éxito</h1>',
                            animation: false,
                            timerProgressBar: true,
                            position: "top-right",
                            background: "#a5dc86",
                            showConfirmButton: false,
                            timer: 3000,
                            didOpen: (toast) => {
                                toast.addEventListener("mouseenter", Swal.stopTimer);
                                toast.addEventListener("mouseleave", Swal.resumeTimer);
                            },
                        });
                    }
                    console.log(response);
                })
                .catch((error) => {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        iconColor: "white",
                        title:
                            '<h1 style="color:white; font-size:1.4rem !important;">La petición ha fallado</h1>',
                        animation: false,
                        timerProgressBar: true,

                        position: "top-right",
                        background: "#f27474",
                        showConfirmButton: false,
                        timer: 3000,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer);
                            toast.addEventListener("mouseleave", Swal.resumeTimer);
                        },
                    });
                    console.log(error);
                });
        },
        addUpdateElement() {
            var form = document.getElementById("formulario");
            var formdata = new FormData(form);
            if (this.Type == "add") {
                let count = this.InstructoresTable.length + 1;
                formdata.append("usuario",this.fields.usuario);
                formdata.append("calificacion",this.fields.calificacion); 
                formdata.append("especialidad",this.fields.especialidad);   
                axios
                    .post("/agregar-instructor", formdata)
                    .then((response) => {
                        if (response.status == 200) {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                iconColor: "white",
                                title:
                                    '<h1 style="color:white; font-size:1.4rem !important;">El registro ha sido agregado con éxito</h1>',
                                animation: false,
                                timerProgressBar: true,

                                position: "top-right",
                                background: "#a5dc86",
                                showConfirmButton: false,
                                timer: 3000,
                                didOpen: (toast) => {
                                    toast.addEventListener("mouseenter", Swal.stopTimer);
                                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                                },
                            });
                        }
                        console.log(response);
                    })
                    .catch((error) => {
                        Swal.fire({
                            toast: true,
                            icon: "error",
                            iconColor: "white",
                            title:
                                '<h1 style="color:white; font-size:1.4rem !important;">La petición ha fallado</h1>',
                            animation: false,
                            timerProgressBar: true,

                            position: "top-right",
                            background: "#f27474",
                            showConfirmButton: false,
                            timer: 3000,
                            didOpen: (toast) => {
                                toast.addEventListener("mouseenter", Swal.stopTimer);
                                toast.addEventListener("mouseleave", Swal.resumeTimer);
                            },
                        });
                        console.log(error);
                    });
                this.InstructoresTable.push({
                        id: count, 
                        usuario: this.fields.usuario,
                        calificacion: this.fields.calificacion,
                        especialidad: this.fields.especialidad
                    });     
            } else {
                let upd_obj = this.InstructoresTable.findIndex(
                    (obj) => obj.id == this.fields.id
                );
                this.InstructoresTable[upd_obj].id = this.fields.id;
                this.InstructoresTable[upd_obj].usuario = this.fields.usuario;
                this.InstructoresTable[upd_obj].calificacion = this.fields.calificacion;
                this.InstructoresTable[upd_obj].especialidad = this.fields.especialidad;
                axios
                    .post("/actualizar-instructor/" + this.fields.id, formdata)
                    .then((response) => {
                        if (response.status == 200) {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                iconColor: "white",
                                title:
                                    '<h1 style="color:white; font-size:1.4rem !important;">El registro ha sido editado con éxito</h1>',
                                animation: false,
                                timerProgressBar: true,

                                position: "top-right",
                                background: "#a5dc86",
                                showConfirmButton: false,
                                timer: 3000,
                                didOpen: (toast) => {
                                    toast.addEventListener("mouseenter", Swal.stopTimer);
                                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                                },
                            });
                        }
                        console.log(response);
                    })
                    .catch((error) => {
                        Swal.fire({
                            toast: true,
                            icon: "error",
                            iconColor: "white",
                            title:
                                '<h1 style="color:white; font-size:1.4rem !important;">La petición ha fallado</h1>',
                            animation: false,
                            timerProgressBar: true,

                            position: "top-right",
                            background: "#f27474",
                            showConfirmButton: false,
                            timer: 3000,
                            didOpen: (toast) => {
                                toast.addEventListener("mouseenter", Swal.stopTimer);
                                toast.addEventListener("mouseleave", Swal.resumeTimer);
                            },
                        });
                        console.log(error);
                    });
            }
            this.closeModal();
        },
    },
};
</script>