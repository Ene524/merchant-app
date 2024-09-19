<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','') | {{env('APP_NAME')}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
          name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
          href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="{{asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet"
          href="{{asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet"
          href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/dist/css/custom.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/dist/css/Source_Sans_Pro.css')}}">
    @yield('customStyle')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="#"
           class="logo">
            <span class="logo-mini"><b>K</b>P</span>
            <span class="logo-lg"><b>Ko</b>Pa</span>
        </a>
        @include('layouts.header')
    </header>
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    @include('layouts.footer')
    @include('layouts.control_sidebar')

    <div class="control-sidebar-bg"></div>
</div>


<script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
@yield('customScript')

</body>
</html>
