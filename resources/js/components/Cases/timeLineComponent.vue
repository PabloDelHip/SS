<template>
    <div class="col-8">

                <div  class="col-sm-12 p-2 mb-3" style="background: #fff; display: block;">
            <!-- textarea -->
            <div class="form-group">
                <label>Actualizar caso</label>
                <textarea id="editorCase"></textarea>
            </div>
            <button v-if="status_case" @click="saveCaseHistory()" type="button" class="btn btn-primary">Actualizar Caso</button>
            <p v-else style="color: #DC4146;">Ya no puede actualizar este caso por que ya esta cerrado</p>
        </div>
        <div class="col-md-12 p-2 contenedor-case-history">
            <!-- The time line -->
            <div class="timeline" v-for="_case in cases" :key="_case.id">
                <!-- timeline time label -->
                <div class="time-label">
                    <span class="bg-success">{{ _case.created_at}}</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div v-for="caseInfo in _case.data" :key="caseInfo.id">
                    <i class="fas fa-comments"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ caseInfo.created_at | moment("LT") }} </span>
                        <h3 class="timeline-header"><a href="#">{{ caseInfo.user.profile.name }} {{ caseInfo.user.profile.last_name }}</a></h3>

                        <div class="timeline-body">
                            <span v-html="caseInfo.information"></span>
                        </div>
                    </div>
                </div>
                <!-- timeline item -->
                
                <div>
                <i class="fas fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Case from '../../providers/Case';
    
    const caseResource = new Case();
    export default {
        props: ['id_case', 'status_case'],
        data () {
            return {
                cases: [],
                form: {
                    information: '',
                    status: true,
                    case_id: this.id_case
                    
                }
            }
        },
        computed: {
          user: function () {
            return this.$store.state.user
          }
        },
        methods: {
            async getHistoryCase() {
                this.cases = await caseResource.getCaseHistory(this.id_case)
                this.cases = this.cases.data.case
            },
            async saveCaseHistory() {
                try {
                    this.form.information = $('#editorCase').summernote('code');
                    $('#editorCase').summernote('code', '')
                    this.form.user_id = this.user.id
                    await caseResource.createCaseHistory(this.form)
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Bien',
                        toast: true,
                        position: 'top',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        text: 'Caso modificado de forma correcta',
                    })
                    this.getHistoryCase()
                } catch (error) {
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
            
            this.getHistoryCase()
            $(function () {
                //SUMMERNOTE
                $('#editorCase').summernote()
                $('#editorCase').summernote('code', '')
            })
        },
    };
</script>
