<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil de Agencia</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ path: '/' }">
                  Home
                </router-link>
              </li>
              <li class="breadcrumb-item active">Perfil de agencia</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <info-vendor-component :id_vendor="id"></info-vendor-component>
          <data-vendor-component :id_vendor="id"></data-vendor-component>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import {
  ValidationProvider,
  ValidationObserver,
} from "vee-validate/dist/vee-validate.full";
import dataVendorComponent from "../../components/Vendors/info/infoComponent";
import infoVendorComponent from "../../components/Vendors/info/dataComponent";

export default {
  props: ["id"],
  name: "login-component",
  components: {
    ValidationObserver,
    ValidationProvider,
    dataVendorComponent,
    infoVendorComponent,
  },
  data() {
    return {
      email: null,
      password: null,
      show_error: false,
      message: null,
      disabled: true,
    };
  },
};
</script>