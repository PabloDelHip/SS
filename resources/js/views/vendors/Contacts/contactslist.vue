<template>
  <div>
    <div>
      <user-modal-form-component 
      :openModal="openModal"
      :vendorId="+id"
      ref="userModalFormComponent"
      ></user-modal-form-component>
    </div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contactos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'ListVendor' }">
                  Agencias
                </router-link>
              </li>
              <li class="breadcrumb-item active">Contactos</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Contactos</h3>
            </div>
            <div class="card-header">
              <router-link
                :to="{ name: 'createContactsVendor', params: { id: +this.id, } }"
                
                name="created"
                style="color: #fff;"
                class="btn btn-warning"
              >
                <i class="fas fa-user"></i>
                Nuevo contacto
              </router-link>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table
                id="contactsTable"
                class="table table-bordered table-striped"
                style="width:100%"
              >
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="contact in contacts" :key="contact.contact_id">
                    <td>{{ contact.name }}</td>
                    <td>{{ contact.last_name }}</td>
                    <td>
                      <div class="btn-group">
                        <router-link
                          class="btn btn-info btn-sm"
                          :to="{ 
                            name: 'editContactsVendor',
                            params: { id: +id, contactId: +contact.contact_id },
                          }"
                        >
                          <i class="fas fa-pencil-alt"> </i>
                        </router-link >
                        <a v-if="!contact.WithUser"
                        class="btn btn-warning btn-sm" @click="$refs.userModalFormComponent.openModalForm(+contact.contact_id, +contact.id);">
                          <i class="fas fa-user"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import userModalFormComponent from '../../../components/Users/userModalFormComponent.vue';
import contactVendor from "../../../providers/ContactVendor";

const contactVendorResource = new contactVendor();

export default {
  components: { userModalFormComponent },
  props: {
    id: {
      required: true,
    },
  },
  data() {
    return {
      contacts: [],
      openModal: false,

      destroyTable: false,
    };
  },
  async created() {
    await this.getVendorContacts();
    this.tableContacts();
  },
  methods:{
    async getVendorContacts() {
      try {
        var response = (await contactVendorResource.getContactsByVendorId(this.id)).data;
        if (response.success) {
          this.contacts = response.data;
          if (this.destroyTable){
            $("#contactsTable")
              .DataTable()
              .destroy();
            this.tableContacts();
          }
        } 
        this.destroyTable = true;
      } catch (error) {
        this.$swal.fire({
            icon: 'error',
            title: 'Oops...',
            toast: true,
            position: 'top',
            timer: 5000,
            showConfirmButton: false,
            timerProgressBar: true,
            text: 'Disculpe tuvimos un error para cargar los contactos',
        })
      }
    },
    tableContacts() {
      this.$nextTick(() => {
        $("#contactsTable")
          .DataTable({
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            responsive: true,
            buttons: [
              {
                extend: "copyHtml5",
                text: "<i class='fas fa-copy'></i> Copiar",
                titleAttr: "Copiar",
                ClassName: "btn btn-secundary",
              },
              {
                extend: "excelHtml5",
                text: "<i class='fas fa-file-excel'></i> Excel",
                titleAttr: "Exportar a Excel",
                ClassName: "btn btn-success",
              },
              {
                extend: "pdfHtml5",
                text: "<i class='fas fa-file-pdf'></i> PDF",
                titleAttr: "Exportar a PDF",
                ClassName: "btn btn-danger",
              },
              {
                extend: "csvHtml5",
                text: "<i class='fas fa-file-csv'></i> CSV",
                titleAttr: "Exportar a CSV",
                ClassName: "btn btn-info",
              },
              {
                extend: "print",
                text: "<i class='fas fa-print'></i> Imprimir",
                titleAttr: "Imprimir",
                ClassName: "btn btn-secondary",
              },
              {
                extend: "colvis",
                text: "Columnas Visibles",
                titleAttr: "Columnas visibles",
                ClassName: "btn btn-info",
              },
            ],
            oLanguage: {
              sSearch: "Busqueda",
              oPaginate: {
                sNext: "Siguiente",
                sFirst: "Primero",
                sLast: "Ultimo",
                sPrevious: "Anterior",
              },
              sEmptyTable: "No hay Registros",
              sInfo: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
              sInfoEmpty: "No hay entradas que mostrar",
            },
          })
          .buttons()
          .container()
          .appendTo("#contactsTable_wrapper .col-md-6:eq(0)");
      });
    },
  },
}
</script>