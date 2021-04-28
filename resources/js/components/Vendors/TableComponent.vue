<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <router-link
              :to="{ name: 'CreateVendor' }"
              name="created"
              class="btn btn-warning"
            >
              <i class="fas fa-store"></i>
              Nueva Agencia
            </router-link>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item active">Agencias</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-store"></i> AGENCIAS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table
                style="width:100%"
                id="example1"
                class="table table-bordered table-striped"
              >
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>País</th>
                    <th>Estado</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="vendor in vendors" :key="vendor.id">
                    <td>{{ vendor.code }}</td>
                    <td>{{ vendor.name }}</td>
                    <td>{{ vendor.email }}</td>
                    <td>{{ vendor.phone }}</td>
                    <td>{{ vendor.address.country.country }}</td>
                    <td>{{ vendor.address.state.name }}</td>
                    <td>{{ vendor.address.city.city }}</td>
                    <td class="table-actions">
                      <div class="btn-group">
                        <router-link
                          class="btn btn-primary btn-sm"
                          :to="{
                            name: 'profileVendor',
                            params: { id: +vendor.id },
                          }"
                        >
                          <i class="far fa-eye"></i>
                        </router-link>
                        <router-link
                          class="btn btn-info btn-sm"
                          :to="{
                            name: 'EditVendor',
                            params: { id: +vendor.id },
                          }"
                        >
                          <i class="fas fa-pencil-alt"> </i>
                        </router-link>
                        <router-link
                          class="btn btn-warning btn-sm"
                          :to="{
                            name: 'listContactsVendor',
                            params: { id: +vendor.id },
                          }"
                        >
                          <i class="fas fa-user"> </i>
                        </router-link>
                        <a
                          class="btn btn-danger btn-sm"
                          @click="deleteVendor(vendor.id)"
                        >
                          <i class="fas fa-trash"> </i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vendor from "../../providers/Vendor";

import modalFormComponent from "../../components/Customers/modalFormComponent";

const vendorResource = new Vendor();
export default {
  name: "TableVendors",
  components: {
    modalFormComponent,
  },
  data() {
    return {
      vendors: [],
      modalEdit: false,
      destroyTable: false,
    };
  },
  methods: {
    async getVendorList() {
      try {
        //Cambiar el 1 por el idProvider
        this.vendors = await vendorResource.getVendorList();
        this.vendors = this.vendors.data.data;
        if (this.destroyTable) {
          $("#example1")
            .DataTable()
            .destroy();
          this.createTable();
        }
        this.destroyTable = true;
      } catch (error) {
        console.log(error);
        this.$swal.fire({
          icon: "error",
          title: "Oops...",
          toast: true,
          position: "top",
          timer: 3000,
          showConfirmButton: false,
          timerProgressBar: true,
          text: "Disculpe tuvimos un error para cargar los contactos",
        });
      }
    },
    async deleteVendor($id_vendor) {
      try {
        this.$swal
          .fire({
            title: "¿Estas seguro?",
            text: "La agencia se eliminara permanentemente",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar agencia",
          })
          .then(async (result) => {
            if (result.isConfirmed) {
              await vendorResource.deleteVendor($id_vendor);
              await this.getVendorList();
              this.$swal.fire({
                icon: "success",
                title: "Bien",
                toast: true,
                position: "top",
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                text: "Agencia eliminada de forma correcta",
              });
            }
          });
      } catch (error) {
        this.$swal.fire({
          icon: "error",
          title: "Oops...",
          toast: true,
          position: "top",
          timer: 3000,
          showConfirmButton: false,
          timerProgressBar: true,
          text: "Disculpe tuvimos un error para eliminar la agencia",
        });
      }
    },
    createTable() {
      $(function() {
        //SUMMERNOTE
        $("#editor").summernote();
        //DATA-TABLE
        $("#example1")
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
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
      });
    },
  },
  async mounted() {
    await this.getVendorList();
    this.createTable();
  },
};
</script>
