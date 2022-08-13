<template>
  <!-- Main content -->
  <div>
    <titulo-component :title="'Hoteles'" :breadcrumbs="breadcrumb"></titulo-component>
    <list-hotels/>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import listHotels from "../../components/Hotels/ListComponent";

export default {
  components: {
    tituloComponent,
    listHotels,
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
          name: 'Hoteles',
          href: '#',
        },
      ]
    }
  },
};
</script>