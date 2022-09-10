<template>
  <!-- Main content -->
  <div>
    <titulo-component
    :title="'Clientes - Tours'"
    :breadcrumbs="breadcrumb"
    url="/clients/list"
  ></titulo-component>
    <list-clients/>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import listClients from "../../components/Clientes/ToursComponent";

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
        {
          name: 'Clientes-Tours',
          href: '#',
        },
      ]
    }
  },
};
</script>