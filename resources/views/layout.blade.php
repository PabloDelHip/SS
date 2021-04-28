<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{url('img/favicon.ico')}}" />
    <title>CRM Tours</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  </head>
<body class="hold-transition sidebar-mini">
    <div>
		  @yield('contenido')
    </div>
    <!-- REQUIRED SCRIPTS -->
    <!--Script-->
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
      <!-- Bootstrap -->
    <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{url('/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{url('/plugins/jquery-validation/additional-methods.min.js')}}"></script>

      <!-- OPTIONAL SCRIPTS -->
    <script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
      <!-- AdminLTE for demo purposes -->
    <script src="{{url('dist/js/demo.js')}}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('dist/js/pages/dashboard3.js')}}"></script>
  
    <!-- Summernote -->
    <script src="{{ url('/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{url('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{url('/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{url('/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{url('/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{url('/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/dist/js/adminlte.min.js')}}"></script>
  </body>
</html>