<template>
  <div class="row">
    <div class="col-9 text-right">
      <button @click="openModal" class="btn mb-3 btn-primary">Agregar Gasto</button>
      <div class="card">
        <div class="card-body">
          <table
            style="width: 100%"
            id="table-gastos"
            class="table table-bordered table-striped"
          >
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Gasto</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="gasto in listGastos" :key="gasto.clave">
                <td>{{ gasto.nombre }}</td>
                <td>${{ gasto.gasto }}</td>
                <td>
                  <button @click="showModal(gasto.clave)" class="btn btn-info btn-sm">
                    <i class="fas fa-pen"></i>
                  </button>
                  <button @click="deleteGasto(gasto.clave)" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
       </div>
      </div>
    </div>
    <modal-bills-component
      @OnActualizarTablaGasto="ActualizarTablaGasto"
      :idGasto="idGasto"
    />
  </div>
</template>

<script>
import ModalBillsComponent from "./ModalBillsComponent";
import GastosTours from "../../providers/Gastos";

const GastosToursResources = new GastosTours();

export default {
  components: {
    ModalBillsComponent,
  },
  data() {
    return {
      listGastos: [],
      idGasto: 0,
    };
  },
  methods: {
    createTable() {
      $(function () {
        //DATA-TABLE
        $("#table-gastos")
          .DataTable({
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            language: {
              decimal: "",
              emptyTable: "No hay información",
              info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
              infoFiltered: "(Filtrado de _MAX_ total entradas)",
              infoPostFix: "",
              thousands: ",",
              lengthMenu: "Mostrar _MENU_ Entradas",
              loadingRecords: "Cargando...",
              processing: "Procesando...",
              search: "Buscar:",
              zeroRecords: "Sin resultados encontrados",
              paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
              },
            },
          })
          .buttons()
          .container()
          .appendTo("#table-hotels_wrapper .col-md-6:eq(0)");
      });
    },
    openModal() {
      this.idGasto = 0;
      this.$modal.show('add-tour-bills');
    },
    async getGastos() {
      const { data } = (await GastosToursResources.getClaveClientesTours(this.$route.params.id)).data;
      this.listGastos = data;
      this.createTable();
    },
    ActualizarTablaGasto() {
      $("#table-gastos").DataTable().destroy();
      this.getGastos();
      this.$swal.fire({
        icon: "success",
        title: "Bien",
        toast: true,
        position: "top",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true,
        text: "Gasto agregado de forma correcta",
      });
    },
    async deleteGasto(clave) {
      this.$swal
      .fire({
        title: "¿Estas seguro?",
        text: "El Gasto se eliminara permanentemente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar gasto",
      })
      .then(async (result) => {
        if (result.isConfirmed) {
          GastosToursResources.delete(clave);
          $("#table-gastos").DataTable().destroy();
          this.getGastos();
          this.$swal.fire({
            icon: "success",
            title: "Bien",
            toast: true,
            position: "top",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            text: "Gasto eliminado de forma correcta",
          });
        }
      });
    },
    showModal(idGasto) {
      this.idGasto = idGasto;
      this.$modal.show('add-tour-bills');
    },
  },
  mounted() {
    this.getGastos();
  }
}
</script>

<style>

</style>