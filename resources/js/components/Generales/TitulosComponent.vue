<template>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{title}}</h1>
            <button :disabled="invalid" type="submit" class="btn btn-info btn-sm mt-2">
                <i class="fas fa-arrow-left"></i>
                Volver
            </button>
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
      </div><!-- /.container-fluid -->
    </section>
</template>

<script>
export default {
    props: {
        title: {
            required: true,
        },
        breadcrumbs:[]
    },
    mounted() {
        this.breadcrumbs.unshift({
          name: 'Home',
          href: '#'
        })
    }
}
</script>