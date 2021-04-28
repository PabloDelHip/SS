<template>
  <div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title" v-if="newUser">Agregar nuevo usuario</h3>
        <h3 class="card-title" v-if="!newUser">Editar usuario</h3>
      </div>
      <form method="POST" action="/user/saveContent">
        <div class="card-body">
          <transition name="fade">
            <div
              class="alert alert-danger alert-dismissible text-center"
              v-if="userErrors.length > 0"
            >
              <ul>
                <li v-for="(e, index) in userErrors" :key="index">
                  {{ e }}
                </li>
              </ul>
            </div>
            <div
              class="alert alert-success alert-dismissible text-center"
              v-if="successUserMessage.length > 0"
            >
              {{ successUserMessage }}
            </div>
          </transition>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
              </div>
              <input
                type="email"
                name="email"
                class="form-control"
                v-model="email"
                :disabled="!newUser"
                placeholder="ejemplo.fulanito@ejemplo.com"
              />
            </div>
          </div>
          <div class="form-group" v-if="this.user == null">
            <label for="emailConfirm">Confirmar correo electrónico</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
              </div>
              <input
                type="email"
                name="emailConfirm"
                class="form-control"
                v-model="emailConfirm"
                placeholder="ejemplo.fulanito@ejemplo.com"
              />
            </div>
          </div>
          <div class="form-group" v-show="this.user == null">
            <label for="password">Contraseña</label>
            <input
              type="password"
              class="form-control"
              v-model="password"
              placeholder="Contraseña"
            />
          </div>
          <div class="form-group">
            <label>Estatus del usuario</label>
            <select class="form-control" v-model.number="statusUser">
              <option value="0">Inactivo</option>
              <option value="1">Activo</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import User from "../../providers/User";

const UserResource = new User();

export default {
  props: {
    id: {
      type: Number,
      required: false,
    },
    contactId: {
      type: Number,
      required: false,
    },
    profileId: {
      type: Number,
      required: false,
    },
    externalEmail: {
      type: String,
      required: false,
    },
    vendorId: {
      type: Number,
      required: false,
    },
  },
  data(){
    return {
      userErrors: [],
      successUserMessage: "",
      newUser: false,

      // Usuario
      email: null,
      emailConfirm: null,
      password: null,
      statusUser: 1,

      user: null,
    }
  },
  watch: {
    externalEmail(val){
      this.email = val;
      this.emailConfirm = val;
    },
  },
  async created(){
    if (this.id != undefined && (this.id + 0) > 0) {
      if (!await this.getUser()) {
        setTimeout(() => {
          this.$router.push("/users");
        }, 3000);
      }
      return;
    }
    this.status = 1;
    this.newUser = this.id == undefined || this.user == "" || this.user == null;
  },
  methods: {
    getUserForm() {
      return {
        email: this.email,
        password: this.password,
        status: +this.statusUser,
        level: 1,
        profile_id: this.profileId,
        contact_id: this.contactId,
        vendor_id: this.vendorId == 0 ? null : +this.vendorId,
      };
    },
    async getUser() {
      var response = (await UserResource.getUser(this.id)).data;
      if (!response.success) {
        this.userErrors.push("Error al obtener usuario.");
        return false;
      }
      this.user = response.data;
      if (this.user == "" || this.user == null) {
        this.userErrors.push("Usuario no existe.");
        return false;
      }

      this.email = this.user.email;
      this.emailConfirm = this.user.email;
      this.statusUser = this.user.status;

      this.$emit('get-profileId', this.user.profile_id);
      this.$emit('get-contactId', this.user.contact_id);
      this.$emit('get-vendorId', this.user.vendor_id);

      return true;
    },
    async saveUser(contactId, profileId) {
      this.userErrors = [];
      var response = null;

      let formData = this.getUserForm();
      if (formData.contact_id == null || formData.contact_id == 0){
        formData.contact_id = contactId;
      }
      if (formData.profile_id == null || formData.profile_id == 0){
        formData.profile_id = profileId;
      }
      if (this.newUser) {
        response = await this.saveNewUser(formData);
      } else {
        response = await this.saveEditUser(formData);
      }
      if (!response.success) {
        this.userErrors.push("Error al guardar el usuario.");
      }
      else{
        this.successUserMessage = "Usuario guardado correctamente.";
      }
      return response;
    },
    async saveNewUser(formData) {
      var response = (await UserResource.createUser(formData)).data;
      return response;
    },
    async saveEditUser(formData) {
      var response = (await UserResource.updateUser(this.id, formData)).data;
      return response;
    },
    isValidUserForm() {
      const errors = [];
      if (!this.newUser) {
        this.emailConfirm = this.email;
      }
      if (this.email != this.emailConfirm) {
        errors.push("Correos no coinciden.");
      }
      if (this.password == "") {
        errors.push("Contraseña no puede estar vacio.");
      }
      this.userErrors = errors;
      return errors;
    },
  },
}
</script>