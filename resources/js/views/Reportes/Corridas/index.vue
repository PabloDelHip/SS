<template>
    <div>
        <titulo-component title="Corridas" :breadcrumbs="breadcrumb"></titulo-component>
        <formulario-corrida></formulario-corrida>
    </div>
</template>

<script>
import tituloComponent from "../../../components/Generales/TitulosComponent";
import formularioCorrida from "../../../components/Reportes/Corridas/Formulario"
export default {
   components: {
    tituloComponent,
    formularioCorrida
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
}
</script>