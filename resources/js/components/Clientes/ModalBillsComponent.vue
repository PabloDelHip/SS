<template>
  <div>
    <modal
      name="add-tour-bills"
      :width="'30%'"
      :height="'auto'"
      :scrollable="true"
    >
      <div class="modal-body row">
        <div class="form-group col-12">
          <label>Nombre</label>
          <input type="text" v-model="form.nombre" class="form-control rounded-0" placeholder="Nombre">
        </div>
        <div class="form-group col-12">
          <label>Gasto</label>
          <input type="number" v-model="form.gasto" class="form-control rounded-0" placeholder="Ganancia">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button @click="AddBillInTour" type="button" class="btn btn-primary">{{textButton}}</button>
      </div>
    </modal>
  </div>  
</template>

<script>
import GastosTours from "../../providers/Gastos";

const GastosToursResources = new GastosTours();

export default {
  props: {
    idGasto: {
      type: Number,
      default:0      
    },
  },
  data() {
    return {
      listTours: [],
      claveGasto: 0,
      form: {
        nombre: '',
        gasto: '',
      }
    }
  },
  watch: {
    async idGasto(newValue) {
      this.clear()
      if(newValue) {
        const { data } = (await GastosToursResources.find(newValue)).data;
        console.log('MI DATAA', data);
        this.form = {
          nombre: data.nombre,
          gasto: data.gasto,
        }
        this.claveGasto = data.clave;
      }
    }
  },
  computed: {
    clave_clientes_tours() {
      return this.$route.params.id;
    },
    textButton() {
      return this.idGasto > 0 ? 'Editar Gasto' : 'Guardar Gasto';
    }
  },
  methods: {
    clear() {
      this.form = {
        nombre: '',
        gastos: '',
      };
    },
    async AddBillInTour() {
      const params = {
        clave_tour: this.clave_clientes_tours,
        ...this.form,
      }
      if (this.idGasto) {
        await GastosToursResources.update(params, this.idGasto);  
      } else {
        await GastosToursResources.create(params);
      }
      this.$emit('OnActualizarTablaGasto');
      this.$modal.hide('add-tour-bills');
      this.clear();
    }
  }
}
</script>
