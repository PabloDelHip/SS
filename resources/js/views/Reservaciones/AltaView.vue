<template>
  <!-- Main content -->
  <div>
    <titulo-component title="Reservaciones" :breadcrumbs="breadcrumb"></titulo-component>
    <form-alta-component></form-alta-component>
  </div>
</template>

<script>
import tituloComponent from "../../components/Generales/TitulosComponent";
import formAltaComponent from "../../components/Reservaciones/formAltaComponent";

export default {
  components: {
    tituloComponent,
    formAltaComponent,
  },
  data(){
    return {
      breadcrumb: [
        {
          name: 'Reservaciones',
          href: '#'
        },
        {
          name: 'Alta',
          href: '#'
        },
      ]
    }
  },
};
</script>