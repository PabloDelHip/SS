<template>
  <div class="col-md-9 col-12">
    <div class="col-md-12 p-0 m-0">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#notes" data-toggle="tab"
                >Notas</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#cases" data-toggle="tab">Casos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contacts" data-toggle="tab"
                >Contactos</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#settings" data-toggle="tab">Tours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#settings" data-toggle="tab"
                >Reservaciones</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#documents" data-toggle="tab"
                >Documentos</a
              >
            </li>
          </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="notes">
              <div class="col-md-12">
                <textarea id="editor" v-model="note"> </textarea>
                <div class="col-3"></div>
              </div>
              <div class="col-12 text-right">
                <button
                  type="submit"
                  @click="saveNote()"
                  class="btn btn-outline-primary btn-sm"
                >
                  Añadir nota
                </button>
              </div>
              <!-- /.col-->
              <hr />
              <div class="ticontenedor-notas">
                <transition-group name="fade">
                  <div v-for="note in notes" :key="note.id" class="post">
                    <!-- Post -->
                    <div class="post clearfix">
                      <div class="user-block">
                        <img
                          class="img-circle img-bordered-sm"
                          src="/dist/img/user7-128x128.jpg"
                          alt="User Image"
                        />
                        <span class="username">
                          <a href="#"
                            >{{ note.user.profile.name }}
                            {{ note.user.profile.last_name }}</a
                          >
                          <a href="#" class="float-right btn-tool"
                            ><i class="fas fa-times"></i
                          ></a>
                        </span>
                        <span class="description"
                          >Escribio la nota -
                          {{ note.created_at | moment("LLLL") }}</span
                        >
                      </div>
                      <!-- /.user-block -->
                      <span v-html="note.note"> </span>

                      <!--<form class="form-horizontal">
                                                    <div class="input-group input-group-sm mb-0">
                                                    <input class="form-control form-control-sm" placeholder="Response">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                    </div>
                                                    </div>
                                                </form> -->
                    </div>
                    <!-- /.post -->
                  </div>
                </transition-group>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="cases">
              <table-cases
                ref="tableCases"
                :id_vendor="id_vendor"
              ></table-cases>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="contacts">
              <table-contacts :id_vendor="id_vendor"></table-contacts>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
              <!-- The timeline -->
              <div class="timeline timeline-inverse">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-danger">
                    10 Feb. 2014
                  </span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-envelope bg-primary"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                    <h3 class="timeline-header">
                      <a href="#">Support Team</a> sent you an email
                    </h3>

                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy
                      zoodles, weebly ning heekya handango imeem plugg dopplr
                      jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                      Babblely odeo kaboodle quora plaxo ideeli hulu weebly
                      balihoo...
                    </div>
                    <div class="timeline-footer">
                      <a href="#" class="btn btn-primary btn-sm">Read more</a>
                      <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-user bg-info"></i>

                  <div class="timeline-item">
                    <span class="time"
                      ><i class="far fa-clock"></i> 5 mins ago</span
                    >

                    <h3 class="timeline-header border-0">
                      <a href="#">Sarah Young</a> accepted your friend request
                    </h3>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-comments bg-warning"></i>

                  <div class="timeline-item">
                    <span class="time"
                      ><i class="far fa-clock"></i> 27 mins ago</span
                    >

                    <h3 class="timeline-header">
                      <a href="#">Jay White</a> commented on your post
                    </h3>

                    <div class="timeline-body">
                      Take me to your leader! Switzerland is small and neutral!
                      We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class="timeline-footer">
                      <a href="#" class="btn btn-warning btn-flat btn-sm"
                        >View comment</a
                      >
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-success">
                    3 Jan. 2014
                  </span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-camera bg-purple"></i>

                  <div class="timeline-item">
                    <span class="time"
                      ><i class="far fa-clock"></i> 2 days ago</span
                    >

                    <h3 class="timeline-header">
                      <a href="#">Mina Lee</a> uploaded new photos
                    </h3>

                    <div class="timeline-body">
                      <img
                        src="https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg"
                        alt="..."
                      />
                      <img
                        src="https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg"
                        alt="..."
                      />
                      <img
                        src="https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg"
                        alt="..."
                      />
                      <img
                        src="https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg"
                        alt="..."
                      />
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <div>
                  <i class="far fa-clock bg-gray"></i>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="settings"></div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="documents">
              <!-- /.card-body -->
              <div class="card-footer bg-white">
                <ul
                  class="mailbox-attachments d-flex align-items-stretch clearfix"
                >
                  <li>
                    <span class="mailbox-attachment-icon"
                      ><i class="far fa-file-pdf"></i
                    ></span>

                    <div class="mailbox-attachment-info">
                      <a href="#" class="mailbox-attachment-name"
                        ><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a
                      >
                      <span class="mailbox-attachment-size clearfix mt-1">
                        <span>1,245 KB</span>
                        <a href="#" class="btn btn-default btn-sm float-right"
                          ><i class="fas fa-cloud-download-alt"></i
                        ></a>
                      </span>
                    </div>
                  </li>
                  <li>
                    <span class="mailbox-attachment-icon"
                      ><i class="far fa-file-word"></i
                    ></span>

                    <div class="mailbox-attachment-info">
                      <a href="#" class="mailbox-attachment-name"
                        ><i class="fas fa-paperclip"></i> App
                        Description.docx</a
                      >
                      <span class="mailbox-attachment-size clearfix mt-1">
                        <span>1,245 KB</span>
                        <a href="#" class="btn btn-default btn-sm float-right"
                          ><i class="fas fa-cloud-download-alt"></i
                        ></a>
                      </span>
                    </div>
                  </li>
                  <li>
                    <span class="mailbox-attachment-icon has-img"
                      ><img src="/dist/img/photo1.png" alt="Attachment"
                    /></span>

                    <div class="mailbox-attachment-info">
                      <a href="#" class="mailbox-attachment-name"
                        ><i class="fas fa-camera"></i> photo1.png</a
                      >
                      <span class="mailbox-attachment-size clearfix mt-1">
                        <span>2.67 MB</span>
                        <a href="#" class="btn btn-default btn-sm float-right"
                          ><i class="fas fa-cloud-download-alt"></i
                        ></a>
                      </span>
                    </div>
                  </li>
                  <li>
                    <span class="mailbox-attachment-icon has-img"
                      ><img src="/dist/img/photo2.png" alt="Attachment"
                    /></span>

                    <div class="mailbox-attachment-info">
                      <a href="#" class="mailbox-attachment-name"
                        ><i class="fas fa-camera"></i> photo2.png</a
                      >
                      <span class="mailbox-attachment-size clearfix mt-1">
                        <span>1.9 MB</span>
                        <a href="#" class="btn btn-default btn-sm float-right"
                          ><i class="fas fa-cloud-download-alt"></i
                        ></a>
                      </span>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</template>

<script>
import tableCases from "../../../components/Cases/listVendorsComponent";
import tableContacts from "../../../components/Contacts/listVendorsComponents";
import Note from "../../../providers/Note";

const NoteResourse = new Note();
export default {
  props: ["id_vendor"],
  components: {
    tableCases,
    tableContacts,
  },
  data() {
    return {
      note: null,
      notes: [],
    };
  },
  computed: {
    user: function() {
      return this.$store.state.user;
    },
  },
  methods: {
    async saveNote() {
      this.note = $("#editor").val();
      if (this.note === null || this.note === "") {
        this.$swal.fire({
          icon: "error",
          title: "Oops...",
          toast: true,
          position: "top",
          timer: 3000,
          showConfirmButton: false,
          timerProgressBar: true,
          text: "El campo de notas esta vacio",
        });
      } else {
        let formData = {
          note: this.note,
          user_profile_id: Number(this.id_user),
          user_id: this.user.id,
          vendor_id: this.id_vendor,
          entity: "vendors",
        };
        try {
          await NoteResourse.saveNote(formData);
          this.getNote();
          $("#editor").val("");
          $("#editor").summernote("code", "");
        } catch (error) {
          this.$swal.fire({
            icon: "error",
            title: "Oops...",
            toast: true,
            position: "top",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            text: "Ocurrio un problema al guardar la nota",
          });
        }
      }
    },
    async getNote() {
      try {
        this.notes = await NoteResourse.getNotesUser(this.id_vendor, "vendors");
        this.notes = this.notes.data.notes;
      } catch (error) {}
    },
  },
  mounted() {
    this.getNote();
    $(function() {
      //SUMMERNOTE
      $("#editor").summernote();
      //DATA-TABLE
      $("#example1")
        .DataTable({
          responsive: false,
          lengthChange: false,
          autoWidth: false,
          buttons: ["copy", "csv", "excel", "pdf", "print"],
          language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
              first: "Primero",
              last: "Ultimo",
              next: "Siguiente",
              previous: "Anterior",
            },
          },
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
    });
  },
};
</script>

<style>
#settings div.dataTables_wrapper div.row div.col-sm-12.col-md-6 {
  flex: 0 0 100%;
  max-width: 100%;
  margin-top: 12px;
}
</style>
