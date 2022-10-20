<template>
  <!-- Main content -->
  <div>
    <titulo-component :title="'Gastos'" :breadcrumbs="breadcrumb"></titulo-component>
    <gastos-clients/>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import gastosClients from "../../components/Clientes/GastosComponent";

export default {
  components: {
    tituloComponent,
    gastosClients,
  },
  props: {
    id: {
      default: 0
    }
  },
  data(){
    return {
      breadcrumb: [
        {
          name: 'Gastos',
          href: '#',
        },
      ]
    }
  },
};
</script>