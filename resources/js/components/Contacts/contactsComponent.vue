<template>
  <div>
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title" v-if="newContact">Agregar nuevo contacto</h3>
        <h3 class="card-title" v-if="!newContact">Editar contacto</h3>
      </div>
      <div class="card-body">
        <transition name="fade">
          <div
            class="alert alert-danger"
            v-if="errors.length > 0"
          >
            <ul>
              <li v-for="(e, index) in errors" :key="index">{{ e }}</li>
            </ul>
          </div>
          <div
            class="alert alert-success"
            v-if="successMessage.length > 0"
          >
            {{ successMessage }}
          </div>
        </transition>
        <div class="form-group" v-show="false">
          <label for="typeContact">Tipo de contacto</label>
          <select
            name="typeContact"
            class="form-control"
            v-model.number="typeContact"
          >
            <option value="1">Usuario</option>
            <option value="2">Proveedor</option>
            <option value="3">Cliente</option>
          </select>
        </div>
        <div class="form-group">
          <label for="rfcContact">RFC</label>
          <input
            type="text"
            name="rfcContact"
            class="form-control"
            v-model="rfcContact"
            placeholder="CUPU800825569"
          />
        </div>
        <div class="form-group">
          <label for="typePerson">Tipo persona</label>
          <select
            name="typePerson"
            class="form-control"
            v-model.number="typePerson"
          >
            <option value="1">Física</option>
            <option value="2">Moral</option>
          </select>
        </div>
        <div>
          <label for="emailsContact">Correos electrónicos</label>
          <div class="input-group mb-3" v-for="(email, index) in emailsContact" :key="index + 'email'">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            <input
              type="email"
              name="emailsContact"
              class="form-control"
              v-model="emailsContact[index]"
              placeholder="john.doe@mail.com"
            />
            <div class="input-group-append" v-if="emailsContact.length > 1">
              <input type="button" class="btn btn-danger" @click="emailsContact.splice(index, 1)" value="-">
            </div>
            <div class="input-group-append" v-if="emailsContact.length < 3">
              <input type="button" class="btn btn-success" @click="emailsContact.push('')" value="+">
            </div>
          </div>
        </div>
        <div>
          <label for="emailsContact">Teléfonos móviles</label>
          <div class="input-group mb-3" v-for="(mobile, index) in mobilesContact" :key="index + 'mobile'">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input
              type="number"
              name="mobilesContact"
              class="form-control no-arrow"
              min="0"
              max="999999999"
              v-model="mobilesContact[index]"
              placeholder="111 111 11 11"
            />
            <div class="input-group-append" v-if="mobilesContact.length > 1">
              <input type="button" class="btn btn-danger" @click="mobilesContact.splice(index, 1)" value="-">
            </div>
            <div class="input-group-append" v-if="mobilesContact.length < 3">
              <input type="button" class="btn btn-success" @click="mobilesContact.push('')" value="+">
            </div>
          </div>
        </div>
        <div>
          <label for="emailsContact">Teléfonos</label>
          <div class="input-group mb-3" v-for="(phone, index) in phonesContact" :key="index + 'phone'">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input
              type="number"
              name="phonesContact"
              class="form-control no-arrow"
              min="0"
              max="999999999"
              v-model="phonesContact[index]"
              placeholder="222 222 22 22"
            />
            <div class="input-group-append" v-if="phonesContact.length > 1">
              <input type="button" class="btn btn-danger" @click="phonesContact.splice(index, 1)" value="-">
            </div>
            <div class="input-group-append" v-if="phonesContact.length < 3">
              <input type="button" class="btn btn-success" @click="phonesContact.push('')" value="+">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Contact from "../../providers/Contact";

const ContactResource = new Contact();

export default {
  props: {
    id: {
      type: Number,
      required: false,
    },
    typeContact: {
      type: Number,
      required: true,
    },
    addressId: {
      type: Number,
      required: false,
    },
  },
  data() {
    return {
      newContact: true,
      refTypeContact: null,

      contact: null,
      errors: [],
      successMessage: "",

      // Contacto
      rfcContact: null,
      typePerson: 0,
      emailsContact: [ "", ],
      mobilesContact: [ "", ],
      phonesContact: [ "", ],
    };
  },
  watch: {
    id: async function(val) {
      this.newContact = this.id == null;
      await this.getContact();
    },
    typeContact: function(val) {
      this.refTypeContact = val;
    },
  },
  methods: {
    async getContact() {
      var response = (await ContactResource.getContact(this.id)).data;
      if (!response.success) {
        this.errors.push("Error al obtener contacto.");
        return;
      }
      this.contact = response.data;
      if (this.contact == "") {
        this.errors.push("Contacto no existe.");
        return;
      }

      this.$emit('get-addressId', this.contact.address_id)
      this.refTypeContact = this.contact.type;
      this.rfcContact = this.contact.rfc;
      this.typePerson = this.contact.type_person;
      this.emailsContact = this.contact.emails.split("|");
      this.mobilesContact = this.contact.moviles.split("|");
      this.phonesContact = this.contact.phones.split("|");
    },
    getContactForm() {
      return {
        type: this.refTypeContact,
        rfc: this.rfcContact,
        type_person: this.typePerson,
        emails: this.emailsContact.join("|"),
        moviles: this.mobilesContact.join("|"),
        phones: this.phonesContact.join("|"),
        address_id: this.addressId,
      };
    },
    async saveContact(addressId) {
      this.errors = [];
      let formData = this.getContactForm();

      if (formData.address_id == null || formData.address_id == 0){
        formData.address_id = addressId;
      }
      var response = null;
      if (this.newContact) {
        response = await this.saveNewContact(formData);
      } else {
        response = await this.saveEditContact(formData);
      }
      if (response.success){
        this.successMessage = "Dirección guardada correctamente.";
      }
      else{
        this.errors.push("Error al guardar contacto.");
      }

      return response;
    },
    async saveNewContact(formData) {
      var response = (await ContactResource.createContact(formData)).data;
      return response;
    },
    async saveEditContact(formData) {
      var response = (await ContactResource.updateContact(this.id, formData)).data;
      return response;
    },
    isValidContactForm() {
      const errors = [];
      if (this.refTypeContact == null || this.refTypeContact == "") {
        errors.push("Tipo de contacto no puede estar vacio.");
      }
      if (this.rfcContact == null || this.rfcContact == "") {
        errors.push("RFC no puede estar vacio.");
      }
      if (this.typePerson == null || this.typePerson == "") {
        errors.push("Tipo de persona no puede estar vacio.");
      }
      this.emailsContact.forEach((email, index) => {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)){
          errors.push("Correo electrónico " + (index + 1) + " invalido.");
        }
      });
      this.mobilesContact.forEach((mobile, index) => {
        if (mobile.length < 10){
          errors.push("Teléfonos móvil " + (index + 1) + " invalido.");
        }
      });
      this.phonesContact.forEach((phone, index) => {
        if (phone.length < 10){
          errors.push("Teléfonos " + (index + 1) + " invalido.");
        }
      });
      this.errors = errors;
      return errors;
    },
  },
};
</script>

<style>
.no-arrow {
  -moz-appearance: textfield;
}
.no-arrow::-webkit-inner-spin-button {
  display: none;
}
.no-arrow::-webkit-outer-spin-button,
.no-arrow::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>