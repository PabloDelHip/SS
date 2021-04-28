<template>
    <div class="login-box">
        <div class="card-header text-center">
            <img width="50%" src="/img/Logotipo.png" alt="Logo Caribbean Hollidays">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            
            <div v-if="show_confirmation">
                <p class="login-box-msg">Revise su correo electrónico para encontrar un enlace para restablecer su contraseña. Si no aparece en unos minutos, revise su carpeta de spam.</p>    
            </div>
            
            <div v-else>
                <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente una nueva contraseña.</p>
                <ValidationObserver v-slot="{ validate }" ref="observer">
                    <form method="post">
                        <ValidationProvider name="email" rules="required|email" v-slot="{ errors }">
                            <div class="input-group mb-3">
                                <input type="email" v-model="formData.email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                            </div>
                        </ValidationProvider>
                        <div class="row">
                        <div class="col-12">
                            <button type="button" :disabled="disabled_button" @click="validate().then(restorePassword())" class="btn btn-primary btn-block">
                                Solicitar nueva contraseña
                                <i v-if="disabled_button" class="fas fa-sync-alt fa-spin"></i>
                            </button>
                        </div>
                        <!-- /.col -->
                        </div>
                    </form>
                </ValidationObserver>
            </div>

            <p class="mt-3 mb-1">
                <router-link :to="{ name:'Login'}">
                    Login
                </router-link>
            </p>
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
        <!-- /.login-box -->
</template>

<script>
    import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';

    import User from '../../providers/User';

    const UserResourse = new User();
    export default {
        data () {
            return {
                formData : {
                    email: null,
                },
                message_error: '',
                show_confirmation: false,
                disabled_button: false,
            }
        },
        components: {
            ValidationObserver,
            ValidationProvider
        },
        methods: { 
            async restorePassword() {
                const isValid = await this.$refs.observer.validate();
                if (isValid) {
                    this.disabled_button = true;
                    UserResourse.restorePassword(this.formData).then((data) => {
                        this.show_confirmation = true;
                        this.$swal.fire({
                            icon: 'success',
                            title: 'Bien',
                            toast: true,
                            position: 'top',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            text: 'Contraseña solicitada correctamente',
                        })
                        this.disabled_button = false;
                    }).catch((err) => {
                        let error = err.response;
                        this.message_error = this.statusCode(error.status)
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            toast: true,
                            position: 'top',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            text: this.message_error,
                        })
                        this.disabled_button = false;
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
                        text: 'El formulario no fue llenado correctamente',
                    })
                }
            },
            statusCode(status) {
                switch (status) {
                    case 422:
                        return 'El email ingresado no tiene cuenta';
                    case 500:
                        return 'Error al enviar email';
                    
                }
            }
        },
    }
</script>