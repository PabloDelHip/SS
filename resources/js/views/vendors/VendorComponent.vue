<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agencia{{ this.NameVendorEdit == null ? "" : " - " + this.NameVendorEdit }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link v-if="this.id == undefined" :to="{ name: 'ListVendor' }">
                  Agencias
                </router-link>
                <router-link v-else :to="{ name: 'profileVendor', params: { id: +this.id } }">
                  Perfil
                </router-link>
              </li>
              <li class="breadcrumb-item active">Agencia {{ this.NameVendorEdit == null ? "" : " - " + this.NameVendorEdit }}</li>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" v-if="newVendor">Agregar nueva agencia</h3>
              <h3 class="card-title" v-else>Editar agencia</h3>
            </div>
            <div class="card-body">
              <transition name="fade">
                <div class="alert alert-danger" v-if="vendorErrors.length > 0">
                  <ul>
                    <li v-for="(e, index) in vendorErrors" :key="index">
                      {{ e }}
                    </li>
                  </ul>
                </div>
                <div
                  class="alert alert-success text-center"
                  v-if="successVendorMessage.length > 0"
                >
                  {{ successVendorMessage }}
                </div>
              </transition>
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="vendorCode">Código</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="vendorCode"
                    oninput="this.value = this.value.toUpperCase()"
                    maxlength="5"
                  />
                </div>
                <div class="form-group col-md-9">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" v-model="name" />
                </div>
              </div>
              <div class="form-group">
                <label for="businessName">Nombre Comercial</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="businessName"
                />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="web">Sitio web</label>
                  <div class="input-group mb-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                    </div>
                    <input
                      type="text"
                      class="form-control"
                      v-model="web"
                      placeholder="https://www.google.com/"
                    />
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Correo electrónico</label>
                  <div class="input-group mb-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input
                      type="email"
                      name="email"
                      class="form-control"
                      v-model="email"
                      :disabled="!newVendor"
                      placeholder="john.doe@mail.com"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Estatus de la agencia</label>
                    <select class="form-control" v-model.number="statusVendor">
                      <option value="0">Inactivo</option>
                      <option value="1">Activo</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="email">Teléfono</label>
                  <div class="input-group mb-12">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input
                      type="phone"
                      name="phone"
                      class="form-control"
                      v-model="phone"
                    />
                  </div>
                </div>
              </div>
              <label for="description">Descripción</label>
              <textarea class="form-control" name="description" v-model="description" rows="3" placeholder="..."></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <address-component
            :id="+this.addressId"
            ref="addressComponent"
          ></address-component>
        </div>
      </div>
      <div class="col-md-12">
        <button type="button" @click="saveContent()" class="btn btn-primary">
          Guardar
        </button>
      </div>
    </div>
    <!-- </ValidationObserver> -->
  </div>
</template>

<script>
import Vendor from "../../providers/Vendor";
import AddressComponent from "../../components/Address/addressComponent.vue";

const VendorResouce = new Vendor();

export default {
  props: {
    id: {
      // Revisar como convertirlo en número
      required: false,
    },
  },
  components: {
    AddressComponent,
  },
  data() {
    return {
      vendorErrors: [],
      successVendorMessage: [],

      addressId: null,

      vendorCode: null,
      name: null,
      businessName: null,
      description: null,
      web: null,
      email: null,
      phone: null,
      statusVendor: 1,

      newVendor: false,
      vendor: null,
      NameVendorEdit: null,
    };
  },
  async created() {
    if (this.id != undefined) {
      if (!await this.getVendor()) {
        setTimeout(() => {
          this.$router.push("/vendors");
        }, 3000);
      }
    }
    this.newVendor = this.id == undefined || this.vendor == "" || this.vendor == null;
  },
  methods: {
    async getVendor(){
      var response = (await VendorResouce.getVendor(this.id)).data;
      if (!response.success) {
        this.vendorErrors.push("Error al obtener agencia.");
        return false;
      }
      this.vendor = response.data;
      if (this.vendor == "" || this.vendor == null) {
        this.vendorErrors.push("Agencia no existe.");
        return false;
      }

      this.vendorCode = this.vendor.code;
      this.name = this.vendor.name;
      this.NameVendorEdit = this.name;
      this.businessName = this.vendor.business_name;
      this.description = this.vendor.description;
      this.web = this.vendor.web;
      this.email = this.vendor.email;
      this.phone = this.vendor.phone;
      this.statusVendor = this.vendor.status;

      this.addressId = this.vendor.address_id;

      return true;
    },
    getVendorForm() {
      return {
        code: this.vendorCode,
        name: this.name,
        business_name: this.businessName,
        description: this.description,
        web: this.web,
        email: this.email,
        phone: this.phone,
        address_id: +this.addressId,
        status: this.statusVendor,
      };
    },
    async saveContent() {
      const addressResponse = this.$refs.addressComponent.isValidAddressForm();
      const vendorErrors = this.isValidVendorForm();
      const allErrors = addressResponse.concat(vendorErrors);
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
      
      var saveVendorResponse = await this.saveVendor();
      if (!saveVendorResponse.success) {
        return;
      }
      this.successVendorMessage = "Agencia guardada correctamente.";

      if (this.newVendor) {
        setTimeout(() => {
          this.$router.push({
            name: "EditVendor",
            params: { id: +saveVendorResponse.data.id },
          });
        }, 3000);
      }
    },
    isValidVendorForm(){
      const errors = [];
      if (this.vendorCode == null || this.vendorCode == "") {
        errors.push("Código no puede estar vacio.");
      }
      if (this.name == null || this.name == "") {
        errors.push("Nombre no puede estar vacio.");
      }
      if (this.businessName == null || this.businessName == "") {
        errors.push("Nombre comercial no puede estar vacio.");
      }
      if (this.description == null || this.description == "") {
        errors.push("Descripción no puede estar vacio.");
      }
      if (this.web == null || this.web == "") {
        errors.push("Sitio web no puede estar vacio.");
      }
      if (this.email == null || this.email == "") {
        errors.push("Email no puede estar vacio.");
      }
      if (this.phone == null || this.phone == "") {
        errors.push("Teléfono no puede estar vacio.");
      }
      else{
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(this.email)){
          errors.push("Email invalido.");
        }
      }
      this.vendorErrors = errors;
      return errors;
    },
    async saveVendor() {
      this.vendorErrors = [];
      var response = null;

      let formData = this.getVendorForm();
      if (this.newVendor) {
        response = await this.saveNewVendor(formData);
      } else {
        response = await this.saveEditVendor(formData);
      }
      if (!response.success) {
        this.vendorErrors.push("Error al guardar la agencia.");
      }
      return response;
    },
    async saveNewVendor(formData) {
      var response = (await VendorResouce.createVendor(formData)).data;
      return response;
    },
    async saveEditVendor(formData) {
      var response = (await VendorResouce.updateVendor(this.id, formData)).data;
      return response;
    },
  },
};
</script>