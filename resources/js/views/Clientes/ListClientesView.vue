<template>
  <!-- Main content -->
  <div>
    <titulo-component :title="'Clientes'" :breadcrumbs="breadcrumb"></titulo-component>
    <list-clients/>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import listClients from "../../components/Clientes/ListComponent";

export default {
  components: {
    tituloComponent,
    listClients,
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
          name: 'Clientes',
          href: '#',
        },
      ]
    }
  },
};
</script>