<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial {{this.case.title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Historial de casos</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <time-line-component :id_case="id_case" :status_case="status_case"></time-line-component>
                </div>
            </div>
        </section>
        
    </div>
</template>

<script>
    import timeLineComponent from '../../components/Cases/timeLineComponent';

    import Case from '../../providers/Case';

    const caseResourse = new Case();

    export default {
        props: ['id_case'],
        components: {
            timeLineComponent
        },
        data () {
            return {
                case: [],
                status_case: ''
            }
        },
        methods: {
            async getCase() {
                this.case = await caseResourse.getCase(this.id_case)
                this.case = this.case.data.data
                this.status_case = this.case.status
            }
        },
        mounted () {
            this.getCase()
        }
    }
</script>
