<template>
    <div>

      <modal name="add-cases"
          :width="'60%'"
          :height="'auto'"
          :scrollable="true">
        <ValidationObserver v-slot="{ invalid, validate }" ref="observer">
          <div class="modal-body row">
            
            <div class="form-group col-12">
              <label>* Titulo</label>
              <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                <input type="text" v-model="form.title" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
              </ValidationProvider>
            </div> 
              
            <div class="form-group col-6">
                <label>Agencia</label>
                <ValidationProvider rules="required" name="agencia" v-slot="{ errors }">
                  <multiselect
                      @input="getContacts()"
                      v-model="form.vendor"
                      label="name"
                      track-by="id"
                      :options="vendors"
                      :searchable="true"
                      :show-labels="false"
                      placeholder="Seleccionar una agencia">
                  </multiselect>
                  <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                </ValidationProvider>
            </div>
              <div class="form-group col-6">
                <label>Contacto(s)</label>
                <ValidationProvider rules="required" name="Contacto" v-slot="{ errors }">
                  <multiselect
                    v-model="form.user"
                    track-by="id"
                    :custom-label="completeName"
                    :options="contacts"
                    :searchable="true"
                    :show-labels="false"
                    placeholder="Seleccionar un contacto">
                  </multiselect>
                  <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                </ValidationProvider>
              </div>
              <div class="col-sm-12">
                <!-- textarea -->
                <div class="form-group">
                  <label>¿Cual es el caso?</label>
                    <textarea id="editorCase" v-model="form.case"></textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button  @click="validate().then(saveCase)" type="button" class="btn btn-primary">Guardar Caso</button>
            <!--:disabled="invalid"-->
          </div>
        </ValidationObserver>
          
      </modal>
    </div>
</template>

<script>
  import Case from '../../providers/Case';
  import Vendor from '../../providers/Vendor';
  import User from '../../providers/User';
  import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';

  const caseResource = new Case();
  const userResource = new User();
  const vendorResource = new Vendor();
  export default {
    components: {
      ValidationObserver,
      ValidationProvider
    },
    data () {
      return {
        vendors: [],
        contacts: [],
        note: '',
        date: null,
        active_status: false,
        form: {
          title: '',
          case: '',
          vendor: '',
          user: ''
        },
      }
    },
    watch: { 
      OpenModalEdit() {
        this.openModal()
      }
    },
    methods: {
      completeName({profile}) {
        return `${profile.name} ${profile.last_name}`
      },
      async getVendors() {
        try {
          this.vendors = await vendorResource.getVendorList();
          this.vendors = this.vendors.data.data
        } catch (error) {
          
        }
      },
      async getContacts() {
        try {
          this.contacts = await userResource.getUserVendor(this.form.vendor.id);
          this.contacts = this.contacts.data.users;
          this.form.user = '';
        } catch (error) {
          
        }
      },
      async saveCase() {
        this.form.case = $('#editorCase').summernote('code')
        try {
          const isValid = await this.$refs.observer.validate();
          if(!isValid) {
            this.$swal.fire({
                icon: 'error',
                title: 'Oops...',
                toast: true,
                position: 'top',
                timer: 5000,
                showConfirmButton: false,
                timerProgressBar: true,
                text: 'Verifique que el formulario fue llenado de forma correcta',
            })
          }
          else if(this.form.case == '') {
            this.$swal.fire({
                icon: 'error',
                title: 'Oops...',
                toast: true,
                position: 'top',
                timer: 5000,
                showConfirmButton: false,
                timerProgressBar: true,
                text: 'Favor de agregar el caso',
            })
          }
          else {
            this.form.vendor_id = this.form.vendor.id;
            this.form.user_id = this.form.user.id;
            await caseResource.createCase(this.form)
            this.$swal.fire({
                icon: 'success',
                title: 'Bien',
                toast: true,
                position: 'top',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                text: 'Caso guardado de forma correcta',
            })
            this.clearData()
            this.$modal.hide('add-cases');
          }
        } catch (error) {
          this.$swal.fire({
              icon: 'error',
              title: 'Oops...',
              toast: true,
              position: 'top',
              timer: 3000,
              showConfirmButton: false,
              timerProgressBar: true,
              text: 'Disculpe tuvimos un error',
          })
        }
      },
      async openModal(id_contacto = null) {
        this.$modal.show('add-cases')
        await this.getVendors();
        $(function () {
            //SUMMERNOTE
            $('#editorCase').summernote()
            $('#editorCase').summernote('code', '')
        })
      },
      clearData() {
        this.form.title = '';
        this.form.case = '';
        this.form.user = '';
        this.form.vendor = '';
        this.form.user_id = '';
        this.form.vendor_id = '';
        $('#editorCase').summernote('code', '')
      }
    },
  }
</script>
