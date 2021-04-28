<template>
  <div class="col-md-3">
    <!-- Main content -->
    <div class="col-md-12 p-0 m-0">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <transition name="fade">
            <div
              class="alert alert-danger alert-dismissible text-center"
              v-if="errors.length > 0"
            >
              <ul>
                <li v-for="(e, index) in errors" :key="index"> {{ e }}</li>
              </ul>
            </div>
          </transition>
          <div class="text-center">
            <img
              class="profile-user-img img-fluid img-circle"
              v-bind:src="userProfile == null || userProfile.profile == null || userProfile.profile.image == null ? '/img/profile-icon.png' : userProfile.profile.image"
              alt="User profile picture"
            />
          </div>

          <h3 class="profile-username text-center">{{ this.userProfile.profile.name }} {{ this.userProfile.profile.last_name }}</h3>

          <!--<p class="text-muted text-center">Software Engineer</p>-->

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Tours vendidos</b> <a class="float-right">543</a>
            </li>
            <li class="list-group-item">
              <b>Ciudad</b> <a class="float-right">Cancún</a>
            </li>
            <li class="list-group-item">
              <b>Sucursal</b> <a class="float-right">Cancún ADO</a>
            </li>
          </ul>
          <router-link
            class="btn btn-primary btn-block"
            :to="{ name: 'EditUser', params: { id: +this.id_user } }"
            v-if="this.id_user == this.user.id || this.permission.update"
          >
            <b><i class="fas fa-pen"></i> Editar</b>
          </router-link>
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
import User from "../../../providers/User";
import UserPermissions from "../../../providers/UserPermission";

const UserResource = new User();
const userPermissionResource = new UserPermissions();

const NameModule = "Usuarios";

export default {
  props: {
    id_user: {
      // Revisar como convertirlo en número
      required: true,
    },
  },
  data(){
    return {
      userProfile: {
        profile: {
          name: null,
          last_name: null,
          image: null,
        }
      },

      errors: [],
      permission: [],

      nameProfile: null,
    };
  },
  watch:{
    async id_user(){
      await this.getUser();
    },
  },
  computed: {
    user: function () {
      return this.$store.state.user;
    }
  },
  async mounted(){
    await this.getPermission();
    await this.getUser();
  },
  methods:{
    async getPermission() {
      var response = (await userPermissionResource.UserPermissionsByModule(this.user.id, NameModule)).data;
      if (!response.success){
        this.$router.push({
            path: '/',
        });
      }
      this.permission = response.data.permission;
    },
    async getUser() {
      var response = (await UserResource.getUser(this.id_user)).data;
      if (!response.success) {
        this.errors.push("Error al obtener usuario.");
        return false;
      }
      if (response.data == "" || response.data == null) {
        this.errors.push("Usuario no existe.");
        setTimeout(() => {
          this.$router.push({ path: "/" });
        }, 5000);
        return false;
      }
      this.userProfile = response.data;

      // this.nameProfile = ;
      return true;
    },
  },
};
</script>
