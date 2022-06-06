<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
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
                <div class="form-group col-md-6">
                    <label for="start">Fecha de Tour:</label>
                    <input type="date" v-model="fechaTour" class="form-control form-control-sm">
                </div>
                <button @click="findReservas()" class="btn mt-3 btn-primary">Buscar reservas</button>
            </div>
            <div class="card">
                <div class="card-header">
                <h3 class="card-title"><i class="fas fa-store"></i> Reservas</h3>
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
                            <th>Clave</th>
                            <th>Pax</th>
                            <th>Nombre</th>
                            <th>Hotel</th>
                            <th>Razon</th>
                            <th>Cupon</th>
                            <th>Cancelada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="reserva in reservas" :key="reserva.clave">
                            <td>
                                {{ reserva.clave }}
                            </td>
                            <th>
                                {{ reserva.paxa }}.{{ reserva.paxb }}
                            </th>
                            <th>{{ reserva.nombre }}</th>
                            <th>{{ reserva.hotel.nombre }}</th>
                            <th>{{ reserva.agencia.razon }}</th>
                            <th>{{ reserva.cupon }}</th>
                            <th>{{ reserva.cancelada }}</th>
                            <th>
                                <router-link class="btn btn-info btn-sm" :to="{ name: 'ReservacionesEditar', params: { id: reserva.clave } }">
                                    <i class="fas fa-pen"></i>
                                </router-link>
                            </th>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
import Reservas from "../../../providers/Reservas";

const ReservasResource = new Reservas();

export default {
    data() {
        return {
            reservas: [],
            fechaTour: ''
        };
    },
    methods: {
        async findReservas(){
            const response = await ReservasResource.find(this.fechaTour)
            $("#example1")
            .DataTable()
            .destroy();
          this.createTable();
            this.reservas = response.data.data.original.data;
            console.log(this.reservas);
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
        this.createTable();
    },
}
</script>