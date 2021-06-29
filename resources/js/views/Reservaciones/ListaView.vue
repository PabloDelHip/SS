<template>
  <!-- Main content -->
  <div>
    <titulo-component title="Reservaciones" :breadcrumbs="breadcrumb"></titulo-component>
    <filtros-component></filtros-component>
    <tabla-component></tabla-component>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import filtrosComponent from "../../components/Reservaciones/Lista/FiltrosComponent";
import tablaComponent from "../../components/Reservaciones/Lista/TablaComponent";

export default {
  components: {
    tituloComponent,
    filtrosComponent,
    tablaComponent
  },
  data(){
    return {
      breadcrumb: [
        {
          name: 'Reservaciones',
          href: '#'
        }
      ]
    }
  },
};
</script>