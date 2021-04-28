<template>
  <div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title" v-if="newProfile">Agregar nuevo perfil</h3>
        <h3 class="card-title" v-else>Editar perfil</h3>
      </div>
      <div class="card-body">
        <transition name="fade">
          <div class="alert alert-danger" v-if="profileErrors.length > 0">
            <ul>
              <li v-for="(e, index) in profileErrors" :key="index">{{ e }}</li>
            </ul>
          </div>
          <div
            class="alert alert-success text-center"
            v-if="successProfileMessage.length > 0"
          >
            {{ successProfileMessage }}
          </div>
        </transition>
        <div class="row">
          <div class="col-7">
            <div class="form-group">
            <label for="name">Nombre</label>
            <input
              type="text"
              class="form-control"
              v-model="name"
              placeholder="John Doe"
            />
          </div>
          <div class="form-group">
            <label for="lastName">Apellidos</label>
            <input
              type="text"
              class="form-control"
              v-model="lastName"
              placeholder="John Doe"
            />
          </div>
          </div>
          <div class="form-group col-5" style="text-align:center">
            <input
              type="file"
              class="custom-file-input"
              @change="onFileChange"
              accept="image/*"
              style="display: none"
              ref="imageFile"
            />
            <img
              v-bind:src="imagePreview"
              class="img-circle elevation-2"
              alt="User Avatar"
              @click="$refs.imageFile.click()"
              :style="'cursor: pointer'"
              style="width= 155px;height= auto;max-height: 155px;max-width: 155px;"
            />
          </div>
        </div>
        <div class="form-group">
          <label for="birthDate">Fecha de nacimiento</label>
          <input
            type="date"
            class="form-control"
            v-model="birthDate"
            placeholder="John Doe"
          />
        </div>
        <div class="form-group">
          <label for="sex">Sexo</label>
          <select class="form-control" v-model.number="sex">
            <option value="1">Masculino</option>
            <option value="2">Femenino</option>
            <option value="3">Otro</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Profile from "../../providers/Profile";
const ProfileResource = new Profile();

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
  },
  data() {
    return {
      profileErrors: [],
      successProfileMessage: "",

      newProfile: true,
      profile: null,

      // Perfil
      picture: null,
      imagePreview: '/img/profile-icon.png',

      name: null,
      lastName: null,
      birthDate: null,
      sex: 0,
    };
  },
  watch: {
    id: function(val) {
      this.newProfile = this.id == null;
      this.getProfile();
    },
  },
  methods: {
    onFileChange(event) {
      this.picture = event.target.files[0];

      if (!(this.picture) || !(/\.(jpe?g|png|gif)$/i.test(this.picture.name)) ||
          ((this.picture.size / 1024 / 1024) > 2)) {
        this.picture = null;
        return;        
      }
      let reader = new FileReader();

      reader.addEventListener("load", function() {
          this.imagePreview = reader.result;
        }.bind(this), false
      );
      
      reader.readAsDataURL(this.picture);
    },
    async getProfile() {
      var response = (await ProfileResource.getProfile(this.id)).data;
      if (!response.success) {
        this.profileErrors.push("Error al obtener perfil.");
        return;
      }
      this.profile = response.data;
      if (this.profile == "") {
        this.profileErrors.push("Perfil no existe.");
        return;
      }
      this.name = this.profile.name;
      this.lastName = this.profile.last_name;
      this.birthDate = this.profile.birth_date;
      this.sex = this.profile.sex;
      if (this.profile.image){
        this.imagePreview = this.profile.image;
      }
      this.$emit("get-name", this.name + " " + this.lastName);
    },
    getProfileForm() {
      return {
        name: this.name,
        last_name: this.lastName,
        birth_date: this.birthDate,
        sex: +this.sex,
        contact_id: +this.contactId,
        picture: this.picture == null && (this.profile == null || this.profile.image == this.imagePreview) ? null : this.imagePreview,
      };
    },
    async saveProfile(contactId) {
      this.profileErrors = [];
      var response = null;

      let formData = this.getProfileForm();
      if (formData.contact_id == null || formData.contact_id == 0) {
        formData.contact_id = contactId;
      }
      if (this.newProfile) {
        response = await this.saveNewProfile(formData);
      } else {
        response = await this.saveEditProfile(formData);
      }
      if (response.success) {
        this.successProfileMessage = "Perfil guardado correctamente.";
      } else {
        this.profileErrors.push("Error al guardar el perfil.");
      }
      return response;
    },
    async saveNewProfile(formData) {
      var response = (await ProfileResource.createProfile(formData)).data;
      return response;
    },
    async saveEditProfile(formData) {
      var response = (await ProfileResource.updateProfile(this.id, formData))
        .data;
      return response;
    },
    isValidProfileForm() {
      const errors = [];
      if (this.name == null || this.name == "") {
        errors.push("Nombre no puede estar vacio.");
      }
      if (this.lastName == null || this.lastName == "") {
        errors.push("Apellido no puede estar vacio.");
      }
      if (this.birthDate == null || this.birthDate == "") {
        errors.push("Fecha de nacimiento no puede estar vacio.");
      }
      if (this.sex == null || this.sex == 0) {
        errors.push("Sexo no puede estar vacio.");
      }
      this.profileErrors = errors;
      return errors;
    },
  },
};
</script>
