<template>
  <div class="container">
    <div class="my-2">
      <button type="button" class="btn btn-success btn-md" @click="addFormModal">
        <i class="fas fa-fw fa-plus"></i>
        Agregar
      </button>
    </div>
    <div class="modal fade" ref="exampleModal" data-backdrop="static" data-backd></div>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Fecha de registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="estudiante in estudiantes" :key="estudiante.id">
          <td>{{ estudiante.id }}</td>
          <td>{{ estudiante.nombre }}</td>
          <td>{{ estudiante.created_at }}</td>
          <td>
            <button type="button" class="btn btn-info btn-sm" @click="editFormModal(estudiante)">
              <i class="fas fa-fw fa-edit"></i>
              Editar
            </button>
            <button type="button" class="btn btn-danger btn-sm" @click="deleteFormModal(estudiante)">
              <i class="fas fa-fw fa-trash"></i>
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="modal fade" ref="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              <span v-if="Type == 'add'">Agregar estudiante</span>
              <span v-else-if="Type == 'edit'">Editar estudiante</span>
            </h5>
            <button type="button" class="close" @click="closeModal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" id="formulario">
              <div class="mb-3">
                <input type="hidden" :value="fields.id" />
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" v-model="fields.nombre" class="form-control" id="nombre" aria-describedby="nombre"
                  name="nombre" required />
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
    estudiantes: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      estudiantesTable: this.estudiantes,
      Type: "add",
      fields: {
        id: "",
        nombre: "",
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
      this.fields.nombre = "";
      this.modal.hide();
    },
    addFormModal() {
      this.Type = "add";
      this.fields.nombre = "";
      this.openModal();
    },
    editFormModal(estudiante) {
      this.Type = "edit";
      this.fields.id = estudiante.id;
      this.fields.nombre = estudiante.nombre;
      this.openModal();
    },
    deleteFormModal(estudiante) {
      this.fields.id = estudiante.id;
      axios
        .post("/eliminar-estudiante/" + this.fields.id)
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
        let count = this.estudiantesTable.length + 1;
        formdata.append("nombre", this.fields.nombre);
        axios
          .post("/agregar-estudiante", formdata)
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
        this.estudiantesTable.push({ id: count, nombre: this.fields.nombre });
      } else {
        let upd_obj = this.estudiantesTable.findIndex(
          (obj) => obj.id == this.fields.id
        );
        this.estudiantesTable[upd_obj].id = this.fields.id;
        this.estudiantesTable[upd_obj].nombre = this.fields.nombre;
        axios
          .post("/actualizar-estudiante/" + this.fields.id, formdata)
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
