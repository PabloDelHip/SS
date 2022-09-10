<template>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{title}}</h1>
            <router-link class="btn btn-info btn-sm mt-2" 
                :to="{ path: url}">
              <i class="fas fa-arrow-left"></i>
              <p>Volver</p>
            </router-link>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item" v-for="breadcrumb in breadcrumbs" :key="breadcrumb.name">
                    <a href="#" >{{breadcrumb.name}}</a>
                </li>

              <span></span>
            </ol>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
export default {
    props: {
      title: {
          required: true,
          default: ''
      },
      breadcrumbs: {
        type: Array,
        default: () => []
      },
      url: {
        type: String,
        default: '/'
      },
    },
    mounted() {
        this.breadcrumbs.unshift({
          name: 'Home',
          href: '#'
        })
    }
}
</script>