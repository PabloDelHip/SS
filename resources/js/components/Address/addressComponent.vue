<template>
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title" v-if="newAddress">Agregar nueva dirección</h3>
      <h3 class="card-title" v-if="!newAddress">Editar dirección</h3>
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
      <div class="row">
      <div class="form-group col-12">
        <label for="street">Calle</label>
        <input
          type="text"
          name="street"
          class="form-control"
          v-model="street"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-6">
        <label for="street1">Calle 1</label>
        <input
          type="text"
          name="street1"
          class="form-control"
          v-model="street1"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-6">
        <label for="street2">Calle 2</label>
        <input
          type="text"
          name="street2"
          class="form-control"
          v-model="street2"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-4">
        <label for="references">Referencias</label>
        <input
          type="text"
          name="references"
          class="form-control"
          v-model="references"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-4">
        <label for="suburb">Suburbio/Fraccionamiento/Region</label>
        <input
          type="text"
          name="suburb"
          class="form-control"
          v-model="suburb"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-4">
        <label for="postalCode">Código postal</label>
        <input
          type="number"
          name="postalCode"
          class="form-control no-arrow"
          min="0"
          v-model.number="postalCode"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-6">
        <label for="interiorNumber">Número Interior</label>
        <input
          type="number"
          name="interiorNumber"
          class="form-control no-arrow"
          min="0"
          v-model.number="interiorNumber"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-6">
        <label for="exteriorNumber">Número Exterior</label>
        <input
          type="number"
          name="exteriorNumber"
          class="form-control no-arrow"
          min="0"
          v-model.number="exteriorNumber"
          :disabled="this.readOnly"
        />
      </div>
      <div class="form-group col-4">
        <label for="country">País</label>
        <multiselect
          @input="getStates()"
          v-model="form.country"
          label="country"
          track-by="id"
          :options="countries"
          :searchable="true"
          :show-labels="false"
          placeholder="Seleccionar un pais"
          :disabled="this.readOnly"
        >
        </multiselect>
      </div>
      <div class="form-group col-4">
        <label for="state">Estado</label>
        <multiselect
          @input="getCitys()"
          v-model="form.state"
          label="name"
          track-by="id"
          :options="states"
          :searchable="true"
          :show-labels="false"
          placeholder="Seleccionar un estado"
          :disabled="this.readOnly"
        >
        </multiselect>
      </div>
      <div class="form-group col-4">
        <label for="city">Ciudad</label>
        <multiselect
          v-model="form.city"
          label="city"
          track-by="id"
          :options="cities"
          :searchable="true"
          :show-labels="false"
          placeholder="Seleccionar una ciudad"
          :disabled="this.readOnly"
        >
        </multiselect>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nation from "../../providers/Nation";
import Address from "../../providers/Address";

const nationResource = new Nation();
const AddressResource = new Address();

export default {
  props: {
    id: {
      type: Number,
      required: false,
    },
    readOnly: {
      type: Boolean,
      required: false,
    },
  },
  data() {
    return {
      newAddress: true,

      address: null,
      errors: [],
      successMessage: "",

      countries: [],
      states: [],
      cities: [],

      postalCode: null,
      street: null,
      street1: null,
      street2: null,
      references: null,
      suburb: null,
      interiorNumber: null,
      exteriorNumber: null,
      form: {
        country: null,
        state: null,
        city: null,
      },
    };
  },
  created() {},
  watch: {
    id: function(val) {
      this.newAddress = this.id == null;
      this.getAddress();
    },
  },
  methods: {
    async getAddress() {
      var response = (await AddressResource.getAddress(this.id)).data;
      if (!response.success) {
        this.errors.push("Error al obtener dirección.");
        return;
      }
      this.address = response.data;
      if (this.address == "" || this.address == null) {
        this.errors.push("Dirección no existe.");
        return;
      }

      this.street = this.address.street;
      this.street1 = this.address.street_one;
      this.street2 = this.address.street_two;
      this.references = this.address.references;
      this.suburb = this.address.suburb;
      this.postalCode = this.address.postal_code;
      this.interiorNumber = this.address.interior_num;
      this.exteriorNumber = this.address.exterior_num;

      this.form.country = this.countries.filter(
        (c) => c.id == this.address.country_id
      )[0];
      await this.getStates();
      this.form.state = this.states.filter(
        (s) => s.id == this.address.state_id
      )[0];
      await this.getCitys();
      this.form.city = this.cities.filter(
        (c) => c.id == this.address.city_id
      )[0];
    },
    async getCountries() {
      try {
        this.countries = await nationResource.getCountries();
        this.countries = this.countries.data.data;
      } catch (error) {
        console.log("error paises", error);
      }
    },
    async getStates() {
      try {
        this.form.state = null;
        this.form.city = null;
        this.states = await nationResource.getState(this.form.country.id);
        this.states = this.states.data.data;
      } catch (error) {
        console.log("error estados", error);
      }
    },
    async getCitys() {
      try {
        this.form.city = null;
        this.cities = await nationResource.getCity(this.form.state.id);
        this.cities = this.cities.data.data;
      } catch (error) {
        console.log("error ciudades", error);
      }
    },
    getAddressForm() {
      return {
        street: this.street,
        street_one: this.street1,
        street_two: this.street2,
        references: this.references,
        suburb: this.suburb,
        postal_code: +this.postalCode,
        interior_num: +this.interiorNumber,
        exterior_num: +this.exteriorNumber,
        country_id: this.form.country.id,
        state_id: this.form.state.id,
        city_id: this.form.city.id,
      };
    },
    async saveAddress (){
      this.errors = [];
      var response = null;
      
      let formData = this.getAddressForm();
      if (this.newAddress) {
        response = await this.saveNewAddress(formData);
      } else {
        response = await this.saveEditAddress(formData);
      }
      if (response.success){
        this.successMessage = "Contacto guardado correctamente.";
      }
      else{
        this.errors.push("Error al guardar la dirección.");
      }
      
      return response;
    },
    async saveNewAddress(formData) {
      var response = (await AddressResource.createAddress(formData)).data;
      return response;
    },
    async saveEditAddress(formData) {
      var response = (await AddressResource.updateAddress(this.id, formData)).data;
      return response;
    },
    isValidAddressForm() {
      const errors = [];
      if (this.street == null || this.street == "") {
        errors.push("Calle no puede estar vacio.");
      }
      if (this.street1 == null || this.street1 == "") {
        errors.push("Calle 1 no puede estar vacio.");
      }
      if (this.street2 == null || this.street2 == "") {
        errors.push("Calle 2 no puede estar vacio.");
      }
      if (this.references == null || this.references == "") {
        errors.push("Referencias no puede estar vacio.");
      }
      if (this.suburb == null || this.suburb == "") {
        errors.push("Suburbio no puede estar vacio.");
      }
      if (this.postalCode == null || this.postalCode == "") {
        errors.push("Código Postal no puede estar vacio.");
      }
      if (this.interiorNumber == null || this.interiorNumber == "") {
        errors.push("Número interior no puede estar vacio.");
      }
      if (this.exteriorNumber == null || this.exteriorNumber == "") {
        errors.push("Número exterior no puede estar vacio.");
      }
      this.errors = errors;
      return errors;
    },
  },
  mounted() {
    this.getCountries();
  },
};
</script>