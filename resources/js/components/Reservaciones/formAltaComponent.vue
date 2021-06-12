<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reservaciones</h1>
            <button :disabled="invalid" type="submit" class="btn btn-info btn-sm mt-2">
                <i class="fas fa-arrow-left"></i>
                Volver
            </button>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reservaciones</li>
              <li class="breadcrumb-item active">Alta</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Subir reservacion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <ValidationObserver v-slot="{ invalid, validate }" ref="observer">
                <div class="card-body row">
                    <div class="col-6 row">
                        <div class="form-group col-3">
                            <label>* Hotel:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect  v-model="value" :options="options"></multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-3">
                            <label>* Tours:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect  v-model="value" :options="options"></multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-4">
                            <label for="exampleInputPassword1">Precio Adulto</label>
                            <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group col-4">
                            <label for="exampleInputPassword1">Precio Niño</label>
                            <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <div class="form-group col-12">
                            <label>* Nombre:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-4">
                            <label>* Pax:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-4">
                            <label>* Cuarto:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="w-100"></div>

                        <div class="form-group col-3">
                            <label>* Agencia:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect  v-model="value" :options="options"></multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-3">
                            <label>* Sucursal:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect  v-model="value" :options="options"></multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-9">
                            <label>Vendedor</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect  v-model="value" :options="options"></multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                    </div>
                    <!--Primera mitad -->

                    <div class="col-6">
                        <div class="col-12 row alta-modifico p-3 mb-3">
                            <div class="form-group col-6">
                                <label>Alta:</label>
                                <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                            </div>
                            <div class="form-group col-6">
                                <label>---</label>
                                <datetime class="rounded-0" v-model="form.birth_date" value-zone="local" zone="local"></datetime>
                            </div>

                            <div class="form-group col-6">
                                <label>Modifico:</label>
                                <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                            </div>
                            <div class="form-group col-6">
                                <label>---</label>
                                <datetime v-model="form.birth_date" value-zone="local" zone="local"></datetime>
                            </div>

                            <div class="form-group col-7">
                                <label>Fecha Tour:</label>
                                <datetime v-model="form.birth_date" value-zone="local" zone="local"></datetime>
                            </div>
                            <div class="form-group col-7">
                                <label>Cupon:</label>
                                <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                            </div>

                            <div class="form-group col-12">
                                <label>Observaciones:</label>
                                <textarea class="form-control rounded-0" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="custom-checkbox col-12 row pl-4">
                                <div class="col-3">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                    <label for="customCheckbox1" class="custom-control-label">Cortesia</label>
                                </div>

                                <div class="col-3">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                                    <label for="customCheckbox1" class="custom-control-label">Convertidor</label>
                                </div>
                            </div>
                            <div class="custom-radio col-12 row pl-4 mt-3">
                                <div class="col-3">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked="">
                                    <label for="customRadio2" class="custom-control-label">Nacional</label>
                                </div>

                                 <div class="col-3">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked="">
                                    <label for="customRadio2" class="custom-control-label">Extranjero</label>
                                </div>

                                <div class="col-3">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" checked="">
                                    <label for="customRadio2" class="custom-control-label">Local</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button :disabled="invalid" type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </ValidationObserver>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import User from "../../providers/User";
import { Datetime } from 'vue-datetime';
import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';

const UserResource = new User();

export default {
    components: {
        datetime: Datetime,
        ValidationObserver,
        ValidationProvider
    },
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
      form: {
          name: ''
      },
      options: ['list', 'of', 'options']
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