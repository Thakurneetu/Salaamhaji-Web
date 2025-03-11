<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL') }}">

    {{--  Icons  --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/logo.png') }}">

    <title>@yield('title') {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <script src="{{ asset('plugins/datatables/jquery.js') }}"></script> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/datatable.styles.min.css') }}" rel="stylesheet">

    @yield('style')

    @stack('styles')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
    <!-- Main Header Navbar -->
@include('layouts.navbar')

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')
@include('sweetalert::alert')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pb-3">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="#">{{ config('app.name') }}</a>.</strong> All rights
        reserved.
    </footer>
</div>

@stack('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('vendor/sweetalert/min.js') }}"></script>
<script>
  window.addEventListener('load', function() {
      const className = sessionStorage.getItem('collapse');
      if (className !== null) {
        document.body.classList.add(className);
      }
  });
  function toggleValue(value){
    let collapse = 'collapse' 
    if (sessionStorage.getItem(collapse) !== null) {
      if(sessionStorage.getItem(collapse) != 'sidebar-collapse')
        sessionStorage.setItem('collapse', 'sidebar-collapse');
      else
        sessionStorage.setItem('collapse', '');
    } else {
      sessionStorage.setItem('collapse', 'sidebar-collapse');
    }
  }
</script>
@yield('script')
</body>
</html>
