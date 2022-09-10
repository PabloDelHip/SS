<template>
  <div>
    <modal
      name="add-tour-client"
      :width="'30%'"
      :height="'auto'"
      :scrollable="true"
    >
      <div class="modal-body row">
        <div class="form-group col-12">
          <label>Tours</label>
            <select
              class="custom-select rounded-0"
              v-model="form.clave_tour"
            >
              <option
                v-for="tour in listTours" :key="tour.clave"
                :value="tour.clave"
              >{{ tour.nombretour }}</option>
            </select>
        </div>
        <div class="form-group col-6">
          <label>Tipo de cambio</label>
            <select
              class="custom-select rounded-0"
              v-model="form.tipo_cambio"
            >
              <option value="MXN">MXN</option>
              <option value="USD">USD</option>
            </select>
        </div>
        <div class="form-group col-6">
          <label>Precio</label>
          <input type="number" v-model="form.precio" class="form-control rounded-0" placeholder="Precio">
        </div>
        <div class="form-group col-6">
          <label>Ganancia en porcentaje</label>
            <select
              class="custom-select rounded-0"
              v-model.number="form.porcentaje"
            >
              <option value="0">NO</option>
              <option value="1">SI</option>
            </select>
        </div>
        <div class="form-group col-6">
          <label>Ganancia</label>
          <input type="number" v-model="form.ganancia" class="form-control rounded-0" placeholder="Ganancia">
        </div>
        <div class="form-group col-12">
          <label>Descripción</label>
          <input type="text" v-model="form.descripcion" class="form-control rounded-0" placeholder="descripcion">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button @click="AddTourInCliente" type="button" class="btn btn-primary">{{textButton}}</button>
      </div>
    </modal>
  </div>
</template>

<script>
import Tours from "../../providers/Tours";
import ClienteTours from "../../providers/ClienteTours";

const ToursResource = new Tours();
const ClienteToursResource = new ClienteTours();
export default {
  props: {
    idClaveClienteTour: {
      type: Number,
      default:0      
    },
  },
  data() {
    return {
      listTours: [],
      claveClienteTour: 0,
      form: {
        clave_tour: '',
        descripcion: '',
        tipo_cambio: '',
        precio: '',
        porcentaje: '',
        ganancia: '',
      }
    }
  },
  watch: {
    async idClaveClienteTour(newValue) {
      this.clear()
      if(newValue) {
        const { data } = (await ClienteToursResource.find(newValue)).data;
        this.form = {
          clave_tour: data[0].clave_tour,
          descripcion: data[0].descripcion,
          tipo_cambio: data[0].tipo_cambio,
          precio: data[0].precio,
          porcentaje: data[0].porcentaje,
          ganancia: data[0].ganancia,
        }
        this.claveClienteTour = data[0].clave;
      }
    }
  },
  computed: {
    claveCliente() {
      return this.$route.params.id;
    },
    textButton() {
      return this.idClaveClienteTour > 0 ? 'Editar Tour' : 'Guardar Tour';
    }
  },
  methods: {
    clear() {
      this.form = {
        clave_tour: '',
        descripcion: '',
        tipo_cambio: '',
        precio: '',
        porcentaje: '',
        ganancia: '',
      };
    },
    async getTours() {
      const { data } = (await ToursResource.get()).data;
      this.listTours = data;
    },
    async AddTourInCliente(){
      const params = {
        clave_cliente: +this.claveCliente,
        ...this.form
      }
      if(this.idClaveClienteTour) {
        await ClienteToursResource.update(params, this.claveClienteTour);  
      } else {
        await ClienteToursResource.create(params);
      }
      this.$emit('OnActualizarTablaTour');
      this.$modal.hide('add-tour-client');
      this.clear();
    }
  },
  async mounted() {
    await this.getTours();
  }
}
</script>
