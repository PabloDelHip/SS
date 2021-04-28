<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Perfil de contacto</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <data-customer-component :id_customer = id></data-customer-component>
                    <info-customer-component
                        :id_customer = id
                    ></info-customer-component>
                </div>
            </div>
        </section>
        
    </div>
</template>

<script>
    import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';
    import dataCustomerComponent from '../../components/Customers/info/dataComponent';
    import infoCustomerComponent from '../../components/Customers/info/infoComponent';

    import Auth from '../../providers/Auth';

    const AuthResourse = new Auth();

    export default {
        props: ['id'],
        name:"login-component",
        components: {
            ValidationObserver,
            ValidationProvider,
            dataCustomerComponent,
            infoCustomerComponent
        },
        data () {
            return {
                email: null,
                password: null,
                show_error: false,
                message: null,
                disabled: true
            }
        },
    }
</script>
