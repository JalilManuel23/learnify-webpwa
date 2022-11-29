<template>
  <div class="">
    <div class="my-2">
      <button
        type="button"
        class="btn btn-success btn-md"
        @click="addFormModal"
      >
        <i class="fas fa-fw fa-plus"></i>
        Agregar
      </button>
    </div>

    <div
      class="modal fade"
      ref="exampleModal"
      data-backdrop="static"
      data-backd
    ></div>

    <table class="table table-responsive-lg">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="role in roles" :key="role.id">
          <td>{{ role.id }}</td>
          <td>{{ role.name }}</td>
          <td>
            <button
              type="button"
              class="btn btn-info btn-sm"
              @click="editFormModal(role)"
            >
              <i class="fas fa-fw fa-edit"></i>
              Editar
            </button>
            <button
              type="button"
              class="btn btn-danger btn-sm"
              @click="deleteFormModal(role)"
            >
              <i class="fas fa-fw fa-trash"></i>
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div
      class="modal fade"
      ref="exampleModal"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              <span v-if="Type == 'add'">Agregar rol</span>
              <span v-else-if="Type == 'edit'">Editar rol</span>
            </h5>
            <button
              type="button"
              class="close"
              @click="closeModal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" id="formulario">
              <div class="mb-3">
                <input type="hidden" :value="fields.id" />
                <label for="name" class="form-label">Name</label>
                <input
                  type="text"
                  v-model="fields.name"
                  class="form-control"
                  id="name"
                  aria-describedby="nombre"
                  name="name"
                  required 
                  minlenght="2"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">
              Close
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              @click="addUpdateElement"
            >
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
    roles: {
      type: [Object, Array],
      required: true,
    },
  },
  data() {
    return {
      rolesTable: this.roles,
      Type: "add",
      fields: {
        id: "",
        name: "",
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
      this.fields.name = "";
      this.modal.hide();
    },
    addFormModal() {
      this.Type = "add";
      this.fields.name = "";
      this.openModal();
    },
    editFormModal(role) {
      this.Type = "edit";
      this.fields.id = role.id;
      this.fields.name = role.name;
      this.openModal();
    },
    deleteFormModal(role) {
      this.fields.id = role.id;
      axios
        .post("/eliminar-rol/" + this.fields.id)
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
        let count = this.rolesTable.length + 1;
        formdata.append("name", this.fields.name);
        formdata.append("key_name", this.fields.key_name);
        axios
          .post("/agregar-rol", formdata)
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
        this.rolesTable.push({ id: count, name: this.fields.name });
      } else {
        let upd_obj = this.rolesTable.findIndex(
          (obj) => obj.id == this.fields.id
        );
        this.rolesTable[upd_obj].id = this.fields.id;
        this.rolesTable[upd_obj].name = this.fields.name;
        axios
          .post("/actualizar-rol/" + this.fields.id, formdata)
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
