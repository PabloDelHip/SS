<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuario{{ this.NameUserEdit == null ? "" : " - " + this.NameUserEdit }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item" v-if="id == null">
                <router-link :to="{ name: 'ListUser' }">
                  Usuarios
                </router-link>
              </li>
              <li class="breadcrumb-item" v-else>
                <router-link
                  :to="{ name: 'perfilUsuario', params: { id: +id } }"
                >
                  Perfil de usuario
                </router-link>
              </li>
              <li class="breadcrumb-item active">Usuario{{ this.NameUserEdit == null ? "" : " - " + this.NameUserEdit }}</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
      <!-- <ValidationObserver v-slot="{validate }" ref="observer"> -->
      <div class="row">
        <div class="col-md-6">
          <profile-component :id="+this.ProfileId"
            :contactId="+this.ContactId"
            ref="profileComponent"
            @get-name="NameUserEdit = $event"
            ></profile-component>
        </div>
        <div class="col-md-6">
          <users-component
            :id="+this.id"
            :contactId="+this.ContactId"
            :profileId="+this.ProfileId"
            :vendorId="+this.VendorId"
            @get-profileId="ProfileId = $event"
            @get-contactId="ContactId = $event"
            @get-vendorId="VendorId = $event"
            ref="userComponent"
          ></users-component>
        </div>
        <div class="col-md-6">
          <contacts-component
            :id="+this.ContactId"
            :addressId="+this.addressId"
            :typeContact="this.typeContact"
            @get-addressId="addressId = $event"
            ref="contactComponent"
          ></contacts-component>
        </div>
        <div class="col-md-6">
          <address-component
            :id="+this.addressId"
            ref="addressComponent"
          ></address-component>
        </div>
        <div class="col-md-12">
          <button type="button" @click="saveContent()" class="btn btn-primary">
            Guardar
          </button>
        </div>
      </div>
      <!-- </ValidationObserver> -->
    </div>
  </div>
</template>

<script>
import ContactsComponent from "../../components/Contacts/contactsComponent.vue";
import ProfileComponent from "../../components/Profile/ProfileComponent.vue";
import AddressComponent from '../../components/Address/addressComponent.vue';
import UsersComponent from '../../components/Users/usersComponent.vue';

import {
  ValidationProvider,
  ValidationObserver,
} from "vee-validate/dist/vee-validate.full";

export default {
  name: "create-user-component",
  props: {
    id: {
      // Revisar como convertirlo en número
      required: false,
    },
  },
  components: {
    ContactsComponent,
    ValidationObserver,
    ValidationProvider,
    ProfileComponent,
    AddressComponent,
    UsersComponent,
  },
  data() {
    return {
      newUser: false,

      addressId: null,
      ContactId: null,
      ProfileId: null,
      VendorId: null,
      
      typeContact: 0,

      NameUserEdit: null,
    };
  },
  mounted(){
    this.newUser = this.id == undefined;
    this.typeContact = 1;
  },
  methods: {
    chechIdUser() {
      if (this.id == undefined || this.user == null) {
        return false;
      }
      return true;
    },
    async saveContent() {
      const addressResponse = this.$refs.addressComponent.isValidAddressForm();
      const contactResponse = this.$refs.contactComponent.isValidContactForm();
      const profileErrors = this.$refs.profileComponent.isValidProfileForm();
      const userErrors = this.$refs.userComponent.isValidUserForm();
      const allErrors = addressResponse
        .concat(contactResponse)
        .concat(profileErrors)
        .concat(userErrors);
      if (allErrors.length > 0) {
        return;
      }

      const saveAddressResponse = await this.$refs.addressComponent.saveAddress();
      if (saveAddressResponse.success) {
        this.addressId = saveAddressResponse.data.id;
      }
      else{
        return;
      }

      const saveContactResponse = await this.$refs.contactComponent.saveContact(this.addressId);
      if (saveContactResponse.success) {
        this.ContactId = saveContactResponse.data.id;
      } else {
        return;
      }

      var saveProfileResponse = await this.$refs.profileComponent.saveProfile(this.ContactId);
      if (saveProfileResponse.success) {
        this.ProfileId = saveProfileResponse.data.id;
      } else {
        return;
      }

      var saveUserResponse = await this.$refs.userComponent.saveUser(this.ContactId, this.ProfileId);
      if (!saveUserResponse.success) {
        return;
      }

      if (this.newUser) {
        await setTimeout(async () => {
          this.$router.push({
            name: "EditUser",
            params: { id: +saveUserResponse.data.id },
          });
        }, 3000);
      }
    },
  },
};
</script>