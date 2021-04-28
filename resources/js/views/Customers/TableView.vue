<template>
    <div>
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <modal-form-component ref="modalFormComponent" @onRefreshTable="getCustomers()" :OpenModalEdit="modalEdit"></modal-form-component>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item active">Contactos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-address-card"></i> CONTACTOS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table style="width:100%" id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido(s)</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Fecha Nacimiento</th>
                            <th>Sexo</th>
                            <th>País</th>
                            <th>Estado</th>
                            <th>Ciudad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="customer in customers" :key="customer.id">
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.last_name }}</td>
                            <td>{{ customer.email }}</td>
                            <td>{{ customer.phone }}</td>
                            <td>{{ customer.birth_date }}</td>
                            <td v-if="customer.sex == 1">Masculino</td>
                            <td v-else-if="customer.sex == 2">Femenino</td>
                            <td v-else>Otro</td>
                            <td v-if="customer.country != null">{{ customer.country.country }}</td>
                            <td v-else> &nbsp;</td>
                            <td v-if="customer.state != null">{{ customer.state.name }}</td>
                            <td v-else></td>
                            <td v-if="customer.city != null">{{ customer.city.city }}</td>
                            <td v-else></td>
                            <td class="table-actions">
                                <router-link class="btn btn-primary btn-sm" :to="{ name:'profileCustomer',  params: { id: customer.id }}">
                                    <i class="far fa-eye"></i>
                                </router-link>
                                <a class="btn btn-info btn-sm" @click="$refs.modalFormComponent.openModal(customer.id);" href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a class="btn btn-danger btn-sm" @click="deleteCustomer(customer.id)" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </section>
    </div>
</template>

<script>

    import Customer from '../../providers/Customer';

    import tableComponent from '../../components/Customers/tableComponent';
    import modalFormComponent from '../../components/Customers/modalFormComponent';

    const customerResource = new Customer();
    export default {
        components: {
            tableComponent,
            modalFormComponent
        },
        data () {
            return {
                customers: [],
                modalEdit: false,
                destroyTable: false
            }
        },
        methods: {
            async getCustomers() {
                try {
                    //Cambiar el 1 por el idProvider
                    this.customers = await customerResource.getListCustomer(1);
                    this.customers = this.customers.data.contactos
                    if(this.destroyTable) {
                        $("#example1").DataTable().destroy();
                        this.createTable();
                    }
                    this.destroyTable = true
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
            async deleteCustomer($id_customer) {

                this.$swal.fire({
                title: '¿Esta seguro que desea eliminar contacto?',
                text: "El contacto sera eliminado de forma permanente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar'
                }).then( async (result) => {
                    if (result.isConfirmed) {
                        try {
                            await customerResource.deleteCustomer($id_customer)
                            await this.getCustomers()
                            this.$swal.fire({
                                icon: 'success',
                                title: 'Bien',
                                toast: true,
                                position: 'top',
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                                text: 'Contacto eliminado de forma correcta',
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
                                text: 'Disculpe tuvimos un error para eliminar al contactos',
                            })
                        }
                    }
                })

            },
            createTable() {
                $(function () {
                    //SUMMERNOTE
                    $('#editor').summernote()
                    //DATA-TABLEf
                    $("#example1").DataTable({
                    "responsive": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                })
            }
        },
        async mounted() {
            await this.getCustomers()
            this.createTable()
            
        }
    }
</script>
