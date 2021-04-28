<template>
    <div class="col-md-3">
        <!-- Main content -->
                    <div class="col-md-12 p-0 m-0">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="/dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ allName }}</h3>

                            <!--<p class="text-muted text-center">Software Engineer</p>-->

                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Reservaciones</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Ciudad</b> <a class="float-right">{{ this.infoCustomer.city }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Edad</b> <a class="float-right">26 Años</a>
                            </li>
                            </ul>
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

    import Customer from '../../../providers/Customer';

    const customerResource = new Customer();

    export default {
        props: ['id_customer'],
        data () {
            return {
                infoCustomer: []
            }
        },
        computed:{
            allName: function (){
                return `${this.infoCustomer.name} ${this.infoCustomer.last_name}` 
            }
        },
        methods: {
            async getCustomer() {
                this.infoCustomer = await customerResource.getCustomer(this.id_customer);
                this.infoCustomer = this.infoCustomer.data.data;
                if(this.infoCustomer.city)
                {
                    this.infoCustomer.city = this.infoCustomer.city.city
                }
            },
        },
        mounted() {
            this.getCustomer()
        }
    }
</script>
