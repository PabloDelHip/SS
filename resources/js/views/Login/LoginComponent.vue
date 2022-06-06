<template>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
            <!--<img src="/img/Logotipo.png" alt="Logo Caribbean Hollidays"> -->
            </div>
            <div class="card-body">
            <p class="login-box-msg">Iniciar sesión</p>
            <transition name="fade">
                <div class="alert alert-danger text-center" v-if="show_error">
                    {{ message }}
                </div>
            </transition>
            <ValidationObserver v-slot="{validate }" ref="observer">
                <form method="post">
                    <ValidationProvider name="email" rules="required" v-slot="{ errors }">
                    <div class="input-group mb-3">
                        <input v-model="email" type="text" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                    </div>
                    </ValidationProvider>
                    <!-- VALIDATOR EMAIL-->

                    <ValidationProvider name="password" rules="required" v-slot="{ errors }">
                        <div class="input-group mb-3">
                            <input type="password" v-model="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <span :class="['error', 'invalid-feedback', errors[0] ? 'ver' : '']">{{ errors[0] }}</span>
                        </div>
                    </ValidationProvider>
                    <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="button" @click="validate().then(login)" class="btn btn-primary btn-block">Ingresar</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
            </ValidationObserver>
        
            <!--<p class="mb-1 text-center mt-2">
                <router-link :to="{ name:'RestablecerContrasena'}">
                    Recuperar contraseña
                </router-link>
            </p> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</template>

<script>
    import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';
    
    import Auth from '../../providers/Auth';

    const AuthResourse = new Auth();

    export default {
        name:"login-component",
        components: {
            ValidationObserver,
            ValidationProvider
        },
        data () {
            return {
                email: null,
                password: null,
                show_error: false,
                message: null,
                disabled: true,
            }
        },
        methods: { 
            async login() {
                this.show_error = false;

                const isValid = await this.$refs.observer.validate();
                if (!isValid) {
                    this.message = "Verifique que el formulario fue llenado de forma correcta";
                    this.show_error = true;
                }
                else {
                    let formData = {
                        email: this.email,
                        password: this.password,
                    }
                    AuthResourse.login(formData).then((response) => {
                        this.show_error = false;
                        localStorage.setItem('data_user', JSON.stringify(response.data));
                        window.location.href = '/overview';
                    }).catch(err => {
                        let error = err.response;
                        this.message = this.statusCode(error.status)
                        this.show_error = true
                    })
                }
            },
            statusCode(status) {
                switch (status) {
                    case 401:
                        return 'Usuario o contraseña incorrectos'
                    case 422:
                        return 'Favor de llenar todos los campos'
                }
            }
        },
    }
</script>
