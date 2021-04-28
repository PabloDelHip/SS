<template>
    <div class="card-body">
        <modal-update-cases-component :_id_case="id_case" ref="modalUpdateCasesComponent" @onRefreshTable="getCasesVendor()"></modal-update-cases-component>
        <table id="tableCase" class="table table-bordered table-striped no-footer dataTable dtr-inline">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Usuario</th>
                    <th>Celular</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="_case in cases" :key="_case.id">
                    <td>{{ _case.title }}</td>
                    <td>{{ _case.user.profile.name }} {{ _case.user.profile.last_name }}</td>
                    <td>{{ _case.user.contact.moviles }}</td>
                    <td>{{ _case.user.contact.phones }}</td>
                    <td>{{ _case.user.email }}</td>
                    <td v-if="_case.status" class="text-center">
                        <span class="right badge badge-success text-center">Abierto</span>
                    </td>
                    <td v-else class="text-center">
                        <span class="right badge badge-danger">Cerrado</span>
                    </td>
                    <td class="table-actions">
                        <router-link
                            class="btn btn-primary btn-sm"
                            style="display: inline"
                          :to="{
                            name: 'caseHistory',
                            params: { id_case: _case.id },
                          }"
                        >
                          <i class="far fa-eye"></i>
                        </router-link>
                        <button v-if="_case.status" class="btn btn-info btn-sm" @click=" id_case = _case.id, $refs.modalUpdateCasesComponent.openModal();">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button v-if="_case.status" href="#" @click="updateStatusCase(_case.id, false)" class="btn btn-danger btn-sm">
                            <i class="fas fa-lock"></i>
                        </button>
                        <button  v-else @click="updateStatusCase(_case.id, true)" class="btn btn-success btn-sm">
                            <i class="fas fa-lock-open"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /.card-body -->
    </div>
</template>

<script>
    import Case from '../../providers/Case';
    import modalUpdateCasesComponent from '../../components/Cases/modadUpdateCasesComponent';

    const caseResourse = new Case();

    export default {
        props: ['id_vendor'],
        components: {
            modalUpdateCasesComponent
        },
        data () {
            return {
                cases: [],
                id_case: ''
            }
        },
        methods: { 
            async getCasesVendor() {
                try {
                    this.cases = await caseResourse.getListCaseVendor(this.id_vendor)
                    this.cases = this.cases.data.cases;
                    
                } catch (error) {
                }
            },
            async updateStatusCase(id_case, status) {
                try {
                    await caseResourse.updateStatusCase(id_case, status)
                    this.getCasesVendor();
                } catch (error) {}
            },
            createTable () {
                $(function () {
                //DATA-TABLE
                $("#tableCase").DataTable({
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
            await this.getCasesVendor();
            this.createTable()
        }
    }
</script>