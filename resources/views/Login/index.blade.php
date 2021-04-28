<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{url('img/favicon.ico')}}" />
    <title>Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">
</head>
    <body class="hold-transition login-page">
        <div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
            <login-component></login-component><!--Añadimos nuestro componente vuejs-->
        </div>
        
        <!-- jQuery -->
        <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ url ('/dist/js/adminlte.min.js')}}"></script>
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>