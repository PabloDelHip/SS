<template>
  <div class="col-md-3">
    <modal-description-component
      ref="modalDescriptionComponent"
      :textDescription="this.infoVendor.description"
    ></modal-description-component>
    <!-- Main content -->
    <div class="col-md-12 p-0 m-0">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img
              class="profile-user-img img-fluid img-circle"
              src="/dist/img/user4-128x128.jpg"
              alt="User profile picture"
            />
          </div>

          <h3 class="profile-username text-center">
            {{ this.infoVendor.name }}
          </h3>

          <!--<p class="text-muted text-center">Software Engineer</p>-->

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Tours Realizados</b> <a class="float-right">543</a>
            </li>
            <li class="list-group-item">
              <b>Codigo</b>
              <a class="float-right">{{ this.infoVendor.code }}</a>
            </li>
            <li class="list-group-item">
              <b>Email</b>
              <a class="float-right" :href="'mailto:' + infoVendor.email">{{ this.infoVendor.email }}</a>
            </li>
            <li class="list-group-item">
              <b>Telefono</b>
              <a class="float-right" :href="'tel:' + infoVendor.phone">{{ this.infoVendor.phone }}</a>
            </li>
            <li class="list-group-item">
              <b>Web</b>
              <a class="float-right" :href="infoVendor.web != null && infoVendor.web.includes('http') ? infoVendor.web : '//' + infoVendor.web"
              target="_blank">{{ this.infoVendor.web }}</a>
            </li>
            <li class="list-group-item">
              <b>Descripción</b>
              <p class="float-left">
                {{ this.infoVendor.description_corta }}
                <a
                  href="#"
                  @click="$refs.modalDescriptionComponent.openModal(1)"
                >
                  <strong>...</strong>
                </a>
              </p>
            </li>
          </ul>
          <div class="row">
            <div class="col-6">
              <router-link
                class="btn btn-primary btn-block"
                :to="{ name: 'EditVendor', params: { id: +this.id_vendor } }"
              >
                <b><i class="fas fa-pen"></i> Editar</b>
              </router-link>
            </div>
            <div class="col">
              <router-link
                class="btn btn-warning btn-block"
                :to="{ name: 'listContactsVendor', params: { id: +this.id_vendor } }"
              >
                <b><i class="fas fa-users"></i> Contactos</b>
              </router-link>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</template>

<script>
import Vendor from "../../../providers/Vendor";
import modalDescriptionComponent from "./modalDescriptionComponent";

const vendorResource = new Vendor();

export default {
  props: ["id_vendor"],
  components: {
    modalDescriptionComponent,
  },
  data() {
    return {
      infoVendor: [],
    };
  },
  methods: {
    async getVendor() {
      this.infoVendor = await vendorResource.getVendor(this.id_vendor);
      this.infoVendor = this.infoVendor.data.data;
      this.infoVendor.description_corta = this.infoVendor.description.substring(0, 80);
      if (this.infoVendor.city) {
        this.infoVendor.city = this.infoVendor.city.city;
      }
    },
  },
  mounted() {
    this.getVendor();
  },
};
</script>
