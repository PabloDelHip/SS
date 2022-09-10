<template>
  <div class="row">
    <div class="col-9 text-right">
      <button @click="openModal" class="btn mb-3 btn-primary">Agregar Tour</button>
      <div class="card">
        <div class="card-body">
          <table
            style="width: 100%"
            id="table-tours"
            class="table table-bordered table-striped"
          >
            <thead>
              <tr>
                <th>Tour</th>
                <th>Precio</th>
                <th>Porcentaje</th>
                <th>Ganancia</th>
                <th>Tipo cambio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="tour in listClientesTours" :key="tour.clave">
                <td> {{ tour.tour.nombretour }} </td>
                <th>{{ tour.precio }}</th>
                <th>{{ tour.porcentaje ? 'SI' : 'NO' }}</th>
                <th>{{ tour.ganancia }}</th>
                <th>{{ tour.tipo_cambio }}</th>
                <th>
                  <button @click="showModal(tour.clave)" class="btn btn-info btn-sm">
                    <i class="fas fa-pen"></i>
                  </button>
                  <button @click="deleteTour(tour.clave)" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </button>
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <modal-tours-component
      @OnActualizarTablaTour="ActualizarTablaTour"
      :idClaveClienteTour="idClaveClienteTour"
    />
  </div>
</template>

<script>
import ModalToursComponent from "./ModalToursComponent";
import Clientes from "../../providers/Clientes";
import ClienteTours from "../../providers/ClienteTours";

const ClienteToursResource = new ClienteTours();

export default {
  components: {
    ModalToursComponent,
  },
  data() {
    return {
      listClientesTours: [],
      idClaveClienteTour: 0,
    };
  },
  methods: {
    createTable() {
      $(function () {
        //DATA-TABLE
        $("#table-tours")
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
      this.idClaveClienteTour = 0;
      this.$modal.show('add-tour-client');
    },
    async updateTableTours() {
      $("#table-tours").DataTable().destroy();
      this.getClientes();
      this.idHotel = 0;
    },
    async getClientes() {
      console.log('probando clientes');
      const { data } = (await ClienteToursResource.getTours(this.$route.params.id)).data;
      this.listClientesTours = data;
      this.createTable();
    },
    ActualizarTablaTour() {
      $("#table-tours").DataTable().destroy();
      this.getClientes();
      this.$swal.fire({
        icon: "success",
        title: "Bien",
        toast: true,
        position: "top",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true,
        text: "Tour agregado de forma correcta",
      });
    },
    showModal(idClaveClienteTour) {
      this.idClaveClienteTour = idClaveClienteTour;
      this.$modal.show('add-tour-client');
    },
    async deleteTour(clave) {
      this.$swal
      .fire({
        title: "¿Estas seguro?",
        text: "El tour se eliminara permanentemente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar tour",
      })
      .then(async (result) => {
        if (result.isConfirmed) {
          ClienteToursResource.delete(clave);
          $("#table-tours").DataTable().destroy();
          this.getClientes();
          this.$swal.fire({
            icon: "success",
            title: "Bien",
            toast: true,
            position: "top",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            text: "Tour eliminado de forma correcta",
          });
        }
      });
    }
  },
  async mounted() {
    this.getClientes();
  },
};
</script>
