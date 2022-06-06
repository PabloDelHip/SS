<template>
  <!-- Main content -->
  <div>
    <titulo-component title="Reservaciones" :breadcrumbs="breadcrumb"></titulo-component>
    <tabla-component></tabla-component>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import tablaComponent from "../../components/Reservaciones/Lista/TablaComponent";

export default {
  components: {
    tituloComponent,
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