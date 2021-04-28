<template>
    <div class="card-body">
        <table id="tableContacts" class="table table-bordered table-striped no-footer dataTable dtr-inline">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Celular</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts" :key="contact.id">
                    <td>{{ contact.profile.name }}</td>
                    <td>{{ contact.profile.last_name }}</td>
                    <td>{{ contact.contact.moviles }}</td>
                    <td>{{ contact.contact.phones }}</td>
                    <td>{{ contact.email }}</td>
                    <td v-if="contact.status" class="text-center">
                        <span class="right badge badge-success text-center">Activo</span>
                    </td>
                    <td v-else class="text-center">
                        <span class="right badge badge-danger">Inactivo</span>
                    </td>
                    <td class="table-actions">
                        <router-link class="btn btn-primary btn-sm" :to="{ name: 'perfilUsuario', params: { id: contact.id } }" >
                            <i class="far fa-eye"></i>
                        </router-link>
                         <router-link class="btn btn-info btn-sm" :to="{ name: 'EditUser', params: { id: contact.id } }">
                            <i class="fas fa-pen"></i>
                        </router-link>
                        <a v-if="contact.status"  href="#" @click="updateStatus(contact.id, false)" class="btn btn-danger btn-sm">
                            <i class="fas fa-ban"></i>
                        </a>
                        <a v-else href="#" @click="updateStatus(contact.id, true)" class="btn btn-success btn-sm">
                            <i class="fas fa-check-circle"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /.card-body -->
    </div>
</template>

<script>
    
    import Contact from '../../providers/Contact';
    const contactResourse = new Contact();

    export default {
        props: ['id_vendor'],
        data () {
            return {
                contacts: [],
                modalEdit: false
            }
        },
        methods: {
            async updateStatus(id_user,status) {
                try {
                    await contactResourse.UpdateStatusContact(id_user, status)
                    this.getContactVendor();
                } catch (error) {}
            },
            async getContactVendor() {
                try {
                    this.contacts = await contactResourse.getContactVendors(this.id_vendor)
                    this.contacts = this.contacts.data.contacts;
                } catch (error) {}
            },
            createTable () {
                $(function () {
                //DATA-TABLE
                $("#tableContacts").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
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
        async mounted () {
            await this.getContactVendor();
            this.createTable()
        }
    }
</script>