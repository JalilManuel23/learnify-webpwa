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
          <th>Nombre</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usuario in usuarios" :key="usuario.id">
          <td>{{ usuario.id }}</td>
          <td>{{ usuario.name }}</td>
          <td>{{ usuario.email }}</td>
          <td>
            <button type="button" class="btn btn-info btn-sm" @click="editFormModal(usuario)">
              <i class="fas fa-fw fa-edit"></i>
              Editar
            </button>
            <button type="button" class="btn btn-danger btn-sm" @click="deleteFormModal(usuario)">
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
              <span v-if="Type == 'add'">Agregar usuario</span>
              <span v-else-if="Type == 'edit'">Editar usuario</span>
            </h5>
            <button type="button" class="close" @click="closeModal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" id="formulario" >
              <div class="mb-3">
                <input type="hidden" :value="fields.id" />
                <label for="name" class="form-label">Name</label>
                <input type="text" ref="name" v-model="fields.name" class="form-control" id="name" aria-describedby="nombre"
                  name="name" required />
                <label for="email" class="form-label">Email</label>
                <input type="email" v-model="fields.email" class="form-control" id="email" aria-describedby="nombre"
                  name="email" required />
                <label for="password" class="form-label">Password</label>
                <input type="password" v-model="fields.password" class="form-control" id="password"
                  aria-describedby="nombre" name="password" required />
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
    usuarios: {
      type: [Object, Array],
      required: true,
    },
  },
  data() {
    return {
      usuariosTable: this.usuarios,
      Type: "add",
      fields: {
        id: "",
        name: "",
        email: "",
        password: "",
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
      this.fields.email = "";
      this.fields.password = "";
      this.modal.hide();
    },
    addFormModal() {
      this.Type = "add";
      this.fields.name = "";
      this.fields.email = "";
      this.fields.password = "";
      this.openModal();
    },
    editFormModal(usuario) {
      this.Type = "edit";
      this.fields.id = usuario.id;
      this.fields.name = usuario.name;
      this.fields.email = usuario.email;
      this.fields.password = usuario.password;
      this.openModal();
    },
    deleteFormModal(usuario) {
      this.fields.id = usuario.id;
      axios
        .post("/eliminar-usuario/" + this.fields.id)
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
      //this.$refs[errorfield] = ''
      var form = document.getElementById("formulario");
      var formdata = new FormData(form);
      if (this.Type == "add") {
        let count = this.usuariosTable.length + 1;
        formdata.append("name", this.fields.name);
        formdata.append("email", this.fields.email);
        formdata.append("password", this.fields.password);
        axios
          .post("/agregar-usuario", formdata)
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
              this.closeModal();
            }
            console.log(response);
          })
          .catch((error) => {
            Swal.fire({
              toast: true,
              icon: "error",
              iconColor: "white",
              title:
                '<h1 style="color:white; font-size:1.4rem !important;">Contraseña no segura, intente de nuevo</h1>',
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
        this.usuariosTable.push({ id: count, name: this.fields.name, email: this.fields.email, password: this.fields.password });
      } else {
        let upd_obj = this.usuariosTable.findIndex(
          (obj) => obj.id == this.fields.id
        );
        this.usuariosTable[upd_obj].id = this.fields.id;
        this.usuariosTable[upd_obj].name = this.fields.name;
        this.usuariosTable[upd_obj].email = this.fields.email;
        this.usuariosTable[upd_obj].password = this.fields.password;
        axios
          .post("/actualizar-usuario/" + this.fields.id, formdata)
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
              this.closeModal();
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
    },
  },
};
</script>
<!-- <template>
    <div class="container">
        <h1>usuarios</h1>
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
</script> -->
