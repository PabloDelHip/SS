<template>
  <div class="row">
    <div class="col-9 text-right">
      <!-- <button @click="openModal" class="btn mb-3 btn-primary">Agregar Hotel</button> -->
      <div class="card">
        <div class="card-body">
          <table
            style="width: 100%"
            id="table-hotels"
            class="table table-bordered table-striped"
          >
            <thead>
              <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="tour in listTours" :key="tour.clave">
                <td> {{ tour.clave }} </td>
                <td> {{ tour.nombretour }} </td>
                <th>
                  <router-link
                    :to="{
                      name: 'tours.bills',
                      params: { id: tour.clave }
                    }"
                    name="created"
                    class="btn btn-success btn-sm"
                  >
                    <i class="fas fa-dollar-sign"></i>
                  </router-link>
                  <!-- <button @click="showModal(tour.clave)" class="btn btn-success btn-sm">
                    <i class="fas fa-dollar-sign"></i>
                  </button> -->
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- <modal-form-component
      @onUpdateTableHotels="updateTableHotels"
      :idHotel="idHotel" 
    /> -->
  </div>
</template>

<script>
// import ModalFormComponent from "./ModalFormComponent";
import Hoteles from "../../providers/Hoteles";
import Tours from "../../providers/Tours";

const HotelesResource = new Hoteles();
const ToursResource = new Tours();

export default {
  // components: {
  //   ModalFormComponent,
  // },
  data() {
    return {
      listTours: [],
      idHotel: 0,
    };
  },
  methods: {
    createTable() {
      $(function () {
        //DATA-TABLE
        $("#table-hotels")
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
      this.idHotel = 0;
      this.$modal.show('add-hotel');
    },
    async updateTableHotels() {
      $("#table-hotels").DataTable().destroy();
      this.getTours();
      this.idHotel = 0;
    },
    async getTours() {
      const { data } = (await ToursResource.get()).data;
      this.listTours = data;
      this.createTable();
    },
    showModal(idHotel) {
      this.idHotel = idHotel;
      this.$modal.show('add-hotel');
    },
    async deleteHotel(clave) {
      this.$swal
      .fire({
        title: "¿Estas seguro?",
        text: "El hotel se eliminara permanentemente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar hotel",
      })
      .then(async (result) => {
        if (result.isConfirmed) {
          HotelesResource.delete(clave);
          $("#table-hotels").DataTable().destroy();
          this.getTours();
          this.$swal.fire({
            icon: "success",
            title: "Bien",
            toast: true,
            position: "top",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            text: "Hotel eliminado de forma correcta",
          });
        }
      });
    }
  },
  async mounted() {
    this.getTours();
  },
};
</script>
