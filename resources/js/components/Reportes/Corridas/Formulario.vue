<template>
    <div class="container">
        <div class="row">
            <div class="form-group col-4">
                <label>Fecha corridas:</label>
                <input type="date" v-model="fecha" class="form-control rounded-0" placeholder="Jhon Dave">
            </div>
            <div class="custom-radio col-12 row pl-4 mt-3">
                                <div class="col-3">
                                    <input type="radio" value="nacional" v-model="nacionalidad_reserva">
                                    <label >Nacional</label>
                                </div>

                                 <div class="col-3">
                                    <input type="radio" value="extranjero" v-model="nacionalidad_reserva">
                                    <label >Extranjero</label>
                                </div>

                                <div class="col-3">
                                   <input type="radio" value="local" v-model="nacionalidad_reserva">
                                    <label >Local</label>
                                </div>

                                <div class="col-3">
                                   <input type="radio" value="todos" v-model="nacionalidad_reserva">
                                    <label >Todos</label>
                                </div>
                            </div>
            <div class="col-12"></div>
            <div>
                <button  @click="generarReporte" class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            fecha: null,
            nacionalidad_reserva: ''
        }
    },
    methods: {
        generarReporte(){
            window.open(`http://192.168.1.5:8000/pdf/corridas/${this.fecha}/${this.nacionalidad_reserva}`);
        }
    }
}
</script>