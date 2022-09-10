<template>
  <div>
    <modal
      name="add-hotel"
      :width="'50%'"
      :height="'auto'"
      :scrollable="true"
    >
      <div class="modal-body row">
        <div class="form-group col-12">
          <label>* Nombre del hotel</label>
            <input type="text" v-model="nombre" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-6">
          <label>Ciudad</label>
            <input type="text" v-model="ciudad" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-6">
          <label>Estado</label>
            <input type="text" v-model="estado" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-12">
          <label>Dirección</label>
            <input type="text" v-model="direccion" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-6">
          <label>Telefonos</label>
          <input type="text" v-model="telefonos" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-6">
          <label>Pickup Fijo</label>
          <the-mask :mask="['##:##']" v-model="pickfijo" placeholder="hh:mm" class="form-control rounded-0"/>
        </div>
        <div class="form-group col-4">
          <label>Zona</label>
          <input type="number" v-model="zona" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-4">
          <label>Orden</label>
          <input type="number" v-model="orden" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
        <div class="form-group col-4">
          <label>Contacto</label>
          <input type="text" v-model="contacto" class="form-control rounded-0" placeholder="Papeles importantes de los tours">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button :disabled="disabledButton" @click="saveOrUpdateHotel" type="button" class="btn btn-primary">{{textButton}}</button>
      </div>
    </modal>
  </div>
</template>

<script>
import Hotel from '../../providers/Hoteles';

const HotelResource = new Hotel();

export default {
  props: {
    idHotel: {
      type: Number,
      default:0      
    },
  },
  data () {
    return {
      nombre: '',
      ciudad: '',
      estado: '',
      zona: 0,
      orden: 0,
      direccion: '',
      telefonos: '',
      contacto: '',
      pickfijo: '',
      cvehotxc: '',
      disabledButton: false,
    }
  },
  watch: {
    async idHotel(newValue) {
      this.clear()
      if(newValue) {
        const { data } = (await HotelResource.find(newValue)).data;
        this.nombre = data[0].nombre;
        this.ciudad = data[0].ciudad;
        this.estado = data[0].estado;
        this.zona = data[0].zona;
        this.orden = data[0].orden;
        this.direccion = data[0].direccion;
        this.telefonos = data[0].telefonos;
        this.contacto = data[0].contacto;
        this.pickfijo = data[0].pickfijo;
        this.cvehotxc = data[0].cvehotxc;
      }
    }
  },
  computed: {
    textButton() {
      return this.idHotel > 0 ? 'Editar Hotel' : 'Guardar Hotel';
    }
  },
  methods: {
    clear() {
      this.nombre = '';
      this.ciudad = '';
      this.estado = '';
      this.zona = 0;
      this.orden = 0;
      this.direccion = '';
      this.telefonos = '';
      this.contacto = '';
      this.pickfijo = '';
      this.cvehotxc = '';
    },
    async saveOrUpdateHotel() {
      this.disabledButton = true;
      try {
        const params = {
          nombre: this.nombre,
          ciudad: this.ciudad,
          estado: this.estado,
          zona: this.zona,
          orden: this.orden,
          direccion: this.direccion,
          telefonos: this.telefonos,
          contacto: this.contacto,
          pickfijo: this.pickfijo,
          cvehotxc: this.cvehotxc,
        }
        if(this.idHotel) {
          await HotelResource.update(params, this.idHotel);
        } else {
          await HotelResource.create(params);
        }
        this.$modal.hide('add-hotel');
        this.$emit('onUpdateTableHotels')
        this.clear();
        this.$swal.fire({
          icon: 'success',
          title: 'Bien',
          toast: true,
          position: 'top',
          timer: 3000,
          showConfirmButton: false,
          timerProgressBar: true,
          text: 'Hotel guardado de forma correcta',
        });
      } catch (error) {
        console.log('EEE', error)
        this.$swal.fire({
          icon: 'error',
          title: 'Oops...',
          toast: true,
          position: 'top',
          timer: 5000,
          showConfirmButton: false,
          timerProgressBar: true,
          text: 'Error al guardar hotel',
        })
      }
      this.disabledButton = false;
    }
  }
}
</script>