<template>
  <div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reservacion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <ValidationObserver v-slot="{ invalid }" ref="observer">
                <div class="card-body row">
                    <div class="col-6 row">
                        <div class="form-group col-3">
                            <label>* Hotel:</label>
                            <ValidationProvider rules="required" name="hotel" v-slot="{ errors }">
                                <input type="text" readonly v-model="form.hotel" @change="selectHotel" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect
                  v-model="hotel"
                  label="nombre"
                  track-by="clave"
                  :options="hotelList"
                  :searchable="true"
                  :show-labels="false"
                  placeholder="Seleccionar una ciudad">
                </multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-3">
                            <label>* Tours:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" readonly v-model="form.tour" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <multiselect
                  v-model="tour"
                  label="nombretour"
                  track-by="clave"
                  :options="tourList"
                  :searchable="true"
                  :show-labels="false"
                  placeholder="Seleccionar una ciudad">
                </multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-4">
                            <label for="exampleInputPassword1">Precio Adulto</label>
                            <input type="text" readonly v-model="form.precio_adulto" class="form-control rounded-0" id="exampleInputPassword1" placeholder="00.00">
                        </div>
                        <div class="form-group col-4">
                            <label for="exampleInputPassword1">Precio Niño</label>
                            <input type="text" readonly v-model="form.precio_nino" class="form-control rounded-0" id="exampleInputPassword1" placeholder="00.00">
                        </div>

                        <div class="form-group col-12">
                            <label>* Nombre:</label>
                            <ValidationProvider rules="required" name="nombre" v-slot="{ errors }">
                                <input type="text" v-model="form.nombre" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-4">
                            <label>* Pax:</label>
                            <ValidationProvider rules="required" name="pax" v-slot="{ errors }">
                                <input type="text" v-model="form.pax" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-4">
                            <label>* Cuarto:</label>
                            <ValidationProvider rules="required" name="cuarto" v-slot="{ errors }">
                                <input type="text" v-model="form.cuarto" class="form-control rounded-0" placeholder="Cuarto">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="w-100"></div>

                        <div class="form-group col-3">
                            <label>* Agencia:</label>
                            <ValidationProvider rules="required" name="agencia" v-slot="{ errors }">
                                <input type="text" readonly v-model="form.agencia" class="form-control rounded-0" placeholder="000">
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            <ValidationProvider rules="required" name="agencia" v-slot="{ errors }">
                               <multiselect
                  v-model="agencia"
                  label="nombre"
                  track-by="clave"
                  :options="agenciasList"
                  :searchable="true"
                  :show-labels="false"
                  placeholder="Seleccionar una ciudad">
                </multiselect>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </ValidationProvider>
                        </div>

                        <div class="form-group col-3">
                            <label>* Sucursal:</label>
                                <input type="text" v-model="form.name" class="form-control rounded-0" placeholder="000">
                                
                            
                        </div>
                        <div class="form-group col-9">
                            <label>---</label>
                            
                                <multiselect  :options="options"></multiselect>
                               
                            
                        </div>

                        <div class="form-group col-9">
                            <label>Vendedor</label>
                                 <input type="text" readonly v-model="form.vendedor" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                        </div>
                    </div>
                    <!--Primera mitad -->

                    <div class="col-6">
                        <div class="col-12 row alta-modifico p-3 mb-3">
                            <div class="form-group col-6">
                                <label>Alta:</label>
                                <input type="text" readonly :value="usuario" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                            </div>
                            <div class="form-group col-6">
                                <label>---</label>
                                <input type="text" v-model="form.fecha_alta" class="form-control rounded-0" readonly>
                            </div>

                            <div class="form-group col-6">
                                <label>Modifico:</label>
                                <input type="text" readonly :value="usuario" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                            </div>
                            <div class="form-group col-6">
                                <label>---</label>
                                <input type="text" class="form-control rounded-0" :value="new Date().toLocaleString()" readonly>
                            </div>

                            <div class="form-group col-7">
                                <label>Fecha Tour:</label>
                                <datetime v-model="form.fecha_tour" value-zone="local" zone="local"></datetime>
                            </div>
                            <div class="form-group col-7">
                                <label>Cupon:</label>
                                <input type="text" v-model="form.cupon" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Jhon Dave">
                            </div>

                            <div class="form-group col-12">
                                <label>Observaciones:</label>
                                <textarea class="form-control rounded-0" v-model="form.observacion" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="custom-checkbox col-12 row pl-4">
                                <div class="col-3">
                                    <input type="checkbox" id="checkbox" v-model="form.cortesia">
                                    <label>Cortesia</label>
                                </div>

                                <div class="col-4">
                                    <input type="checkbox" id="checkbox" v-model="form.convertidor">
                                    <label>Convertidor</label>
                                </div>
                            </div>
                            <div class="custom-radio col-12 row pl-4 mt-3">
                                <div class="col-3">
                                    <input type="radio" value="nacional" v-model="form.nacionalidad_reserva">
                                    <label >Nacional</label>
                                </div>

                                 <div class="col-3">
                                    <input type="radio" value="extranjero" v-model="form.nacionalidad_reserva">
                                    <label >Extranjero</label>
                                </div>

                                <div class="col-3">
                                   <input type="radio" value="local" v-model="form.nacionalidad_reserva">
                                    <label >Local</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div v-if="id" class="card-footer">
                  <button  @click="editar()" type="submit" class="btn btn-primary">Editar</button>
                </div>
                <div v-else class="card-footer">
                  <button :disabled="invalid" @click="createReserva" type="submit" class="btn btn-primary">Guardar</button>
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
import Hoteles from "../../providers/Hoteles";
import Clientes from "../../providers/Clientes";
import Tours from "../../providers/Tours";
import Reservas from "../../providers/Reservas";
import { Datetime } from 'vue-datetime';
import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';

const HotelesResource = new Hoteles();
const ClientesResource = new Clientes();
const ToursResource = new Tours();
const ReservasResource = new Reservas();

export default {
    components: {
        datetime: Datetime,
        ValidationObserver,
        ValidationProvider
    },
  props: {
    id: {
      default: 0
    }
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
      hotel: [],
      tour: [],
      agencia: [],
      form: {
          hotel: '',
          tour: '',
          precio_adulto: '',
          precio_nino: '',
          nombre: '',
          pax: '',
          cuarto: '',
          agencia: '',
          sucursal: '',
          vendedor: '',
          fecha_alta: new Date().toLocaleString(),
          fecha_modifico: new Date().toLocaleString(),
          fecha_tour: '',
          cupon: '',
          observacion: '',
          cortesia: '',
          convertidor: '',
          clavere: this.usuario,
          usuario: this.usuario,
          usr_modi: this.usuario,
          nacionalidad_reserva: ''
      },
      hotelList: [],
      tourList: [],
      agenciasList: [],
      sucursalList:[],
      vendedorList:[],
      options: []
    }
  },
  computed: {
    usuario() {
      
          let data_user = localStorage.getItem("data_user");
          data_user = JSON.parse(data_user);
          console.log('usuario', data_user.user.idusuario)
          return data_user.user.idusuario; 
    }
  },
  watch: {
    externalEmail(val){
      this.email = val;
      this.emailConfirm = val;
    },
    hotel(newValue, beforeValue) {
      this.form.hotel = newValue.clave
    },
    tour(newValue) {
      this.form.precio_adulto = this.tour.precioadu;
      this.form.precio_nino = this.tour.precionin;
      this.form.tour = newValue.clave
    },
    agencia(newValue) {
      this.form.agencia = newValue.clave
    }
  },
  methods: {
    editar() {
      try {
        ReservasResource.update(this.form, this.id);
        this.$swal.fire({
                icon: 'success',
                title: 'Bien',
                toast: true,
                position: 'top',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                text: 'Reserva Editada de forma correcta',
            })
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
    createReserva() {
      try {
        ReservasResource.create(this.form);
        this.$swal.fire({
                icon: 'success',
                title: 'Bien',
                toast: true,
                position: 'top',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                text: 'Reserva guardado de forma correcta',
            })
        location.reload();
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
    selectHotel() {
      this.hotel = this.hotelList.filter(hotel => {
       if(hotel.clave === this.form.hotel) {
         console.log('si entramos')
          return hotel;
        }
      } )
      this.form.hotel = this.hotel[0].clave
      console.log(this.form.hotel)
      console.log(this.hotel[0])
    },
    async getHoteles() {
      const {data} = await HotelesResource.get();
      this.hotelList = data.data;
    },
    async getTours() {
      const {data} = await ToursResource.get();
      this.tourList = data.data;
      console.log(data)
    },
    async getClientes() {
      const {data} = await ClientesResource.get();
      this.agenciasList = data.data;
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
    async getTour() {
      let data = await ReservasResource.findReservas(this.id);
      data = data.data.data.original.data[0];
      this.form.hotel = data.hotel;
      this.form.tour = data.tour;
      this.form.precio_adulto = data.precioa;
      this.form.precio_nino = data.preciob;
      this.form.nombre = data.nombre;
      this.form.pax = data.paxa+'.'+data.paxb;
      this.form.cuarto = data.cuarto;
      this.form.agencia = data.agencia;
      this.form.sucursal = data.sucursal;
      //this.form.fecha_alta = data.fechalta;
      this.form.fecha_tour = data.fechatour;
      this.form.cupon = data.cupon;
      this.form.observacion = data.observacion;
      this.form.cortesia = data.cortesia;
      this.form.convertidor = data.convertidor;
      this.form.usuario = data.usuario;
      this.form.usr_modi = data.usr_modi;
      this.form.nacionalidad_reserva = data.nacionalidad_reserva;
      const dataTours = await ToursResource.find(data.tour);
      const dataHoteles = await HotelesResource.find(data.hotel);
      const dataAgencia = await ClientesResource.find(data.agencia);
      this.agencia = dataAgencia.data.data[0];
      this.tour = dataTours.data.data[0];
      this.hotel = dataHoteles.data.data[0];
      let dataFechaTour = data.fechatour.split(" ");
      dataFechaTour = dataFechaTour[0] + 'T00:00:00.000-05:00';
      this.form.fecha_tour = dataFechaTour;
      console.log('SOY EL DATA HOTELES', dataFechaTour);
    }
  },
  async mounted() {
    this.getHoteles();
    this.getClientes();
    this.getTours();
    console.log('SI ESTANOS', this.id)
    if (this.id) {
      
      this.getTour();
    }
  }
}
</script>