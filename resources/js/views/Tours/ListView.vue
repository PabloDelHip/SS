<template>
  <div>
    <titulo-component title="Tours" :breadcrumbs="breadcrumb"></titulo-component>
    <tabla-component></tabla-component>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import tablaComponent from "../../components/Tours/TableComponent";

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
}

</script>
