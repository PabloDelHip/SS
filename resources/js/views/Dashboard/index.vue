<template>
      <div class="wrapper">
        <modal-add-cases-component ref="modalAddCasesComponent"></modal-add-cases-component>
          <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              <!--<li class="nav-item d-none d-sm-inline-block">
                <a href="/users" class="nav-link">Usuarios</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a> 
              </li>-->
            </ul>
        
            <!-- SEARCH FORM -->
            <!--<form class="form-inline ml-3">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form> -->
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Messages Dropdown Menu -->
              <li class="nav-item dropdown">
                <button @click="$refs.modalAddCasesComponent.openModal();" type="button" class="btn btn-block btn-primary btn-sm">
                  <i class="fas fa-tasks"></i>
                  CASOS
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Brad Diesel
                          <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          John Pierce
                          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Nora Silvester
                          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
              </li>
              <!-- Notifications Dropdown Menu -->
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.navbar -->
        
          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link class="brand-link" 
                :to="{ path:'/'}">
              <img src="/img/LogotipoCRM.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">CRM TOURS</span>
            </router-link>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  <img
                  v-bind:src="user == null || user.profile == null || user.profile.image == null ? '/img/profile-icon.png' : user.profile.image"
                  class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <router-link class="d-block" 
                      :to="{ name:'perfilUsuario', params: { id: +user.id }}">
                      {{ user.full_name }}
                  </router-link>
                  <button type="button"
                          class="btn btn-outline-danger btn-block btn-sm logout mt-3"
                          @click="logout()">
                            <i class="fas fa-sign-out-alt"></i> 
                            Cerrar sesión
                  </button>
                </div>
              </div>
        
              <!-- SidebarSearch Form -->
              <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>
        
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                      with font-awesome or any other icon font library -->
                  <!-- <li class="nav-header">EXAMPLES</li> -->
                  <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                      <i class="fas fa-hand-holding-usd"></i>
                      <p>
                        Oportunidades de venta
                        <span class="badge badge-danger right">2</span>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name:'ListUser'}">
                      <i class="fas fa-users"></i>
                      <p>
                        Usuarios
                      </p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-shopping-cart"></i>
                      <p>
                        Productos
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tours</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/compose.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Catamaranes</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Autos</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Vuelos</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Hoteles</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name:'Contacts'}">
                      <i class="fas fa-address-card"></i>
                      <p>
                        Contactos
                      </p>
                    </router-link>
                  </li>
                  <li class="nav-item" v-if="user.vendor_id == null">
                     <router-link class="nav-link" :to="{ name:'ListVendor'}">
                        <i class="fas fa-store"></i>
                        <p>
                          Agencias
                        </p>
                     </router-link>
                  </li>
                  <li class="nav-item" v-else>
                     <router-link class="nav-link" :to="{ 
                        name: 'profileVendor',
                        params: { id: user.vendor_id },}">
                        <i class="fas fa-store"></i>
                        <p>
                          Agencia
                        </p>
                     </router-link>
                  </li>
                  <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                      <i class="fas fa-file-alt"></i>
                      <p>
                        Documentos
                      </p>
                    </a>
                  </li>
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>

          <div class="content-wrapper">
              <!-- Content Wrapper. Contains page content -->
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
          </div>
            <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
          </aside>
          <!-- /.control-sidebar -->

          <!-- Main Footer -->
        <footer class="main-footer">
          <!-- <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
          All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0-rc
          </div> -->
        </footer>
      </div>
      <!-- ./wrapper -->
</template>

<script>
    
    import Auth from '../../providers/Auth';
    import UserPermission from "../../providers/UserPermission";
    import modalAddCasesComponent from '../../components/Cases/modalAddCasesComponent';

    const AuthResourse = new Auth();
    const userPermissionResource = new UserPermission();
    
    export default {
      components: {
            modalAddCasesComponent
        },
        data(){
          return{
          usuarioActual: null,
          };
        },
        methods: { 
            async logout() {
                try {
                  this.user = await AuthResourse.logout();
                  localStorage.removeItem('data_user');
                  window.location.href = '/login';
                } catch (error) {
                  console.log(error)
                }
            },
            async permisos() { 
             try {
              this.usuarioActual = JSON.parse(localStorage.getItem('data_user'));
              var response = (await userPermissionResource.UserPermissions(this.usuarioActual.user.id)).data;
              localStorage.setItem('permits_user', JSON.stringify(response.data));
             } catch (error) {
               console.log(error);
             }
           },
        },
        computed: {
          user: function () {
            return this.$store.state.user
          }
        },
        mounted() {
          this.$store.dispatch('SET_CURRENT_USER')
          this.permisos();
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
  .logout {
    color: #fff;
    border: none;
  }
</style>