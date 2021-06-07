<template>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img width="50%" src="/img/Logotipo.png" alt="Logo Caribbean Hollidays">
            </div>
            <div class="card-body">
                <div v-if="exist_token">
                    <p class="login-box-msg">Está a solo un paso de su nueva contraseña, recupere su contraseña ahora.</p>
                    <ValidationObserver v-slot="{ validate }" ref="observer">
                        <form action="login.html" method="post">
                            <ValidationProvider rules="required|password:@confirm" name="password" v-slot="{ errors }">
                                <div class="input-group mb-3">
                                    <input type="password" v-model="formData.password" class="form-control" placeholder="Contraseña">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>

                            <ValidationProvider name="confirmar contraseña" vid="confirm" rules="required" v-slot="{ errors }">
                                <div class="input-group mb-3">
                                    <input type="password" v-model="confirmation_password" class="form-control" placeholder="Confirmar Contraseña">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>
                            <div class="row">
                            <div class="col-12">
                                <button :disabled="disabled_button" @click="validate().then(updatePassword)" type="button" class="btn btn-primary btn-block">
                                    Cambiar contraseña <i v-if="disabled_button" class="fas fa-sync-alt fa-spin"></i>
                                </button>
                            </div>
                            <!-- /.col -->
                            </div>
                        </form>
                    </ValidationObserver>
        </div>
        <div v-else-if="password_update">
          <p class="login-box-msg">
            La contraseña fue modificada de forma correcta.
          </p>
          <p class="mt-3 mb-1">
            <router-link :to="{ name: 'Login' }">
              Login
            </router-link>
          </p>
        </div>
        <div v-else>
          <p class="login-box-msg">
            Parece que hizo clic en un enlace de restablecimiento de contraseña
            no válido. Inténtalo de nuevo.
          </p>
          <!--<p class="mt-3 mb-1">
            <router-link :to="{ name: 'RestablecerContrasena' }">
              Recuperar contraseña
            </router-link>
          </p>-->
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</template>

<script>
import {
  extend,
  ValidationProvider,
  ValidationObserver,
} from "vee-validate/dist/vee-validate.full";

import User from "../../providers/User";

    extend('password', {
        params: ['target'],
        validate(value, { target }) {
            return value === target;
        },
        message: 'Las contraseñas no coinciden.',
    });


const UserResourse = new User();

    export default {
        props: ['token'],
        components: {
            ValidationObserver,
            ValidationProvider
        },
        data () {
            return {
                formData : {
                    password: null,
                },
                confirmation_password: null,
                exist_token : true,
                password_update : false,
                disabled_button: false
            }
        },
        methods: {
            async getTokenPassword() {
                try {
                    let $info = await UserResourse.validateTokenPassword(this.token)
                } catch (error) {
                    this.exist_token = false
                }
            },
            async updatePassword() {
                try {
                    const isValid = await this.$refs.observer.validate();
                    if (isValid) {
                        this.disabled_button = true
                        await UserResourse.updatePassword(this.token,this.formData)
                        this.password_update = true
                        this.exist_token = false
                        this.$swal.fire({
                            icon: 'success',
                            title: 'Bien',
                            toast: true,
                            position: 'top',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            text: 'Contraseña modificada',
                        })
                    }
                    else {
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            toast: true,
                            position: 'top',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            text: 'Verifique que el formulario fue llenado de forma correcta',
                        })
                    }
                } catch (error) {
                    this.disabled_button = false
                    this.$swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            toast: true,
                            position: 'top',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            text: 'Disculpe tuvimos un error',
                        })
                }
            }
        },
        mounted() {
            this.getTokenPassword()
  },
};
</script>