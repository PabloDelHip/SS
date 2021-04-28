<template>
  <div>
    <modal
      name="user-modal-form"
      :style="{ padding: '100px 0px 30px' }"
      :width="'60%'"
      :height="'auto'"
      :scrollable="true"
    >
      <div class="modal-body">
        <h3>Convertir <em>{{ this.nameUser }}</em> a usuario</h3>
        <users-component
          :contactId="+this.ContactId"
          :profileId="+this.ProfileId"
          :vendorId="+this.vendorId"
          :externalEmail="this.externalEmail"
          ref="userComponent"
        ></users-component>
        <button type="button" @click="saveContent()" class="btn btn-primary">
          Convertir a usuario
        </button>
      </div>
    </modal>
  </div>
</template>

<script>
import Profile from "../../providers/Profile";
import Contact from "../../providers/Contact";

import usersComponent from "./usersComponent.vue";

const ProfileResource = new Profile();
const ContactResource = new Contact();

export default {
  props: {
    openModal: {
      type: Boolean,
      required: true,
    },
    vendorId: {
      type: Number,
      required: true,
    },
  },
  components: { usersComponent },
  data() {
    return {
      ContactId: null,
      ProfileId: null,

      nameUser: null,
      externalEmail: null,
      profile: null,
    };
  },
  watch: {
    openModal() {
      this.openModalForm();
    },
    async ProfileId(){
      await this.getProfile();
    },
    async ContactId(){
      await this.getContact();
    },
  },
  methods:{
    openModalForm(contactId, profileId) {
      this.$modal.show('user-modal-form')

      this.ContactId = contactId;
      this.ProfileId = profileId;
    },
    async getContact() {
      var response = (await ContactResource.getContact(this.ContactId)).data;
      if (!response.success) {
        // this.errors.push("Error al obtener contacto.");
        return;
      }
      this.contact = response.data;
      if (this.contact == "") {
        // this.errors.push("Contacto no existe.");
        return;
      }

      this.externalEmail = this.contact.emails.split("|")[0];
    },
    async getProfile() {
      var response = (await ProfileResource.getProfile(this.ProfileId)).data;
      if (!response.success) {
        // this.profileErrors.push("Error al obtener perfil.");
        return;
      }
      this.profile = response.data;
      if (this.profile == null || this.profile == "") {
        // this.profileErrors.push("Perfil no existe.");
        return;
      }
      this.nameUser = this.profile.name + " " + this.profile.last_name;
    },
    async saveContent() {
      const userErrors = this.$refs.userComponent.isValidUserForm();
      if (userErrors.length > 0) {
        return;
      }

      var saveUserResponse = await this.$refs.userComponent.saveUser(this.ContactId, this.ProfileId);
      if (!saveUserResponse.success) {
        return;
      }
      
      setTimeout(() => {
        this.$router.push({
          name: "permisosUser",
          params: { id: +saveUserResponse.data.id },
        });
      }, 3000);
    },
  },
};
</script>
