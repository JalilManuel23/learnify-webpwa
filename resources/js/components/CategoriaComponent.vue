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
                    <th>Curso</th>
                    <th>Título</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="categoria in categorias" :key="categoria.id">
                    <td>{{ categoria.id }}</td>
                        <th>{{ categoria.curso }}</th>
                        <th>{{ categoria.titulo }}</th>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" @click="editFormModal(categoria)">
                            <i class="fas fa-fw fa-edit"></i>
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteFormModal(categoria)">
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
                            <span v-if="Type == 'add'">Agregar</span>
                            <span v-else-if="Type == 'edit'">Editar</span>
                        </h5>
                        <button type="button" class="close" @click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formulario">
                            <div class="mb-3">
                                <input type="hidden" :value="fields.id" />
                                
                                <label for="instructor" class="form-label">Curso</label>
                                <input type="text" v-model="fields.curso" class="form-control" id="curso"
                                    aria-describedby="curso" name="curso" required />
                             
                                    <label for="titulo" class="form-label">Titulo</label>
                                <input type="text" v-model="fields.titulo" class="form-control" id="titulo"
                                    aria-describedby="titulo" name="titulo" required/>
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
        categorias: {
            type: [Object, Array],
            required: true,
        },
    },
    data() {
        return {
            categoriasTable: this.categorias,
            Type: "add",
            fields: {
                id: "",
                curso: "",
                titulo: ""
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
            this.fields.titulo = "",
            this.fields.curso = "",
            this.modal.hide();
        },
        addFormModal() {
            this.Type = "add";
            this.fields.titulo = "",
            this.fields.curso = "",
            this.openModal();
        },
        editFormModal(categoria) {
            this.Type = "edit";
            this.fields.id          = categoria.id;
            this.fields.curso  = categoria.curso,
            this.fields.titulo   = categoria.titulo
            this.openModal();
        },
        deleteFormModal(categoria) {
            this.fields.id = categoria.id;
            axios
                .post("/eliminar-categoria/" + this.fields.id)
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
                let count = this.categoriasTable.length + 1;
                formdata.append("curso",this.fields.curso);
                formdata.append("titulo",this.fields.titulo);  
                axios
                    .post("/agregar-categoria", formdata)
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
                this.categoriasTable.push({
                        id: count, 
                        curso: this.fields.curso,
                        titulo: this.fields.titulo
                    });     
            } else {
                let upd_obj = this.categoriasTable.findIndex(
                    (obj) => obj.id == this.fields.id
                );
                this.categoriasTable[upd_obj].id = this.fields.id;
                this.categoriasTable[upd_obj].curso = this.fields.curso;
                this.categoriasTable[upd_obj].titulo = this.fields.titulo;
                axios
                    .post("/actualizar-categoria/" + this.fields.id, formdata)
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