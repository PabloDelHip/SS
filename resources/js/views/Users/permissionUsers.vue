<template>
  <div>
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permisos Usuarios{{ this.NameUserEdit == null ? "" : " - " + this.NameUserEdit }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'ListUser' }">
                Usuarios
                </router-link>
              </li>
              <li class="breadcrumb-item active">Permisos Usuarios{{ this.NameUserEdit == null ? "" : " - " + this.NameUserEdit }}</li>
            </ol>
          </div>
        </div>
    </section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table
                id="permissionsTable"
                class="table table-bordered table-striped"
                style="width:100%"
              >
                <thead>
                  <tr>
                    <th>Modulo</th>
                    <th class="text-center">Ver</th>
                    <th class="text-center">Agregar</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="permission in permissions" :key="permission.id">
                    <td>{{ permission.name }}</td>
                    <td align="center">
                      <input :disabled="!permissionPermission.update"
                        type="checkbox"
                        name="read"
                        id="CBoxReadT"
                        :value="permission.permission.read"
                        :checked="permission.permission.read"
                        @change="
                          check(
                            permission.id,
                            $event.target.name,
                            $event.target.checked
                          )
                        "
                      />
                    </td>
                    <td align="center">
                      <input :disabled="!permissionPermission.update"
                        type="checkbox"
                        name="create"
                        id="CBoxCreatedT"
                        :value="permission.permission.create"
                        :checked="permission.permission.create"
                        @click="
                          check(
                            permission.id,
                            $event.target.name,
                            $event.target.checked
                          )
                        "
                      />
                    </td>
                    <td align="center">
                      <input :disabled="!permissionPermission.update"
                        type="checkbox"
                        name="update"
                        id="CBoxUpdateT"
                        :value="permission.permission.update"
                        :checked="permission.permission.update"
                        @change="
                          check(
                            permission.id,
                            $event.target.name,
                            $event.target.checked
                          )
                        "
                      />
                    </td>
                    <td align="center">
                      <input  :disabled="!permissionPermission.update"
                        type="checkbox"
                        name="delete"
                        id="CBoxDeleteT"
                        :value="permission.permission.delete"
                        :checked="permission.permission.delete"
                        @change="
                          check(
                            permission.id,
                            $event.target.name,
                            $event.target.checked
                          )
                        "
                      />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserPermissions from "../../providers/UserPermission";
import User from "../../providers/User";

const UserResource = new User();
const userPermissionResource = new UserPermissions();

const NameModule = "Permisos";

export default {
  name: "users-permissions",
  props: {
    id: {
      required: true,
    },
  },
  data() {
    return {
      permissions: "",
      permissionPermission: [],

      NameUserEdit: null,
    };
  },
  computed: {
    user: function () {
      return this.$store.state.user;
    }
  },
  async mounted() {
    if (!await this.getPermission()){
      return;
    }
    this.obtenerPermisos();
    this.getUser();
  },
  methods: {
    async getUser() {
      var response = (await UserResource.getUser(this.id)).data;
      if (!response.success) {
        this.showError("Error al obtener usuario.");
        return false;
      }
      var user = response.data;
      if (this.user == "" || this.user == null) {
        this.showError("Usuario no existe.");
        return false;
      }

      this.NameUserEdit = user.profile.name + " " + user.profile.last_name;

      return true;
    },
    async getPermission() {
      var response = (await userPermissionResource.UserPermissionsByModule(this.user.id, NameModule)).data;
      if (!response.success){
        this.showError("Error al obtener información.");
        setTimeout(() => {
          this.$router.push({
            path: '/',
          });
        }, 3000);
        return false;
      }
      this.permissionPermission = response.data.permission;

      return true;
    },
    async obtenerPermisos() {
      try {
        let response = (await userPermissionResource.UserPermissions(this.id))
          .data;
        if (!response.success) {
          return;
        }
        this.permissions = response.data;
        $("#permissionsTable")
          .DataTable()
          .destroy();
        this.tablePermits();
      } catch (error) {
        console.log(error);
        this.showError("No se pudo obtener permisos de usuarios.");
      }
    },
    check(module_id, name, checked) {
      this.$nextTick(() => {
        if (!this.permissionPermission.update){
          this.showError("No tienes permiso para hacer este cambio.");
          return;
        }

        let formData = {
          module_id: module_id,
          user_id: this.id,
          column: name,
          value: checked ? 1 : 0,
        };
        try {
          this.modules = userPermissionResource.updatePermits(formData);
        } catch (error) {
          console.log(error);
          this.showError("No se pudo actualizar permisos del usuario.");
        }
      });
    },
    showError(error){
      this.$swal.fire({
        icon: 'error',
        title: 'Oops...',
        toast: true,
        position: 'top',
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true,
        text: error,
      })
    },
    tablePermits() {
      this.$nextTick(() => {
        $("#permissionsTable")
          .DataTable({
            lengthChange: false,
            searching: true,
            ordering: false,
            info: false,
            autoWidth: true,
            responsive: true,
            buttons: [],
            oLanguage: {
              sSearch: "Busqueda",
              oPaginate: {
                sNext: "Siguiente",
                sFirst: "Primero",
                sLast: "Ultimo",
                sPrevious: "Anterior",
              },
              sEmptyTable: "No hay Registros",
              sInfo: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
              sInfoEmpty: "No hay entradas que mostrar",
            },
          })
          .buttons()
          .container()
          .appendTo("#permissionsTable_wrapper .col-md-6:eq(0)");
      });
    },
  },
};
</script>
