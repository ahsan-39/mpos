<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="{{asset('assets/img/logoT.png')}}" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MPOSE | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<img src="{{asset('assets/img/logoT.png')}}" alt="PHarmacy Logo"  style="width: 150px; height: 150px;   margin-left: 100px;" >
  <div class="login-logo" style="font-size: 20px;">
    <b>{{ config('app.vendor') }}</b>
  </div>
   
        @include('layouts.partials.css')
        @stack('css')

        
        @include('layouts.partials.js')
        @stack('js')

        @yield('content')
 

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/js/adminlte.min.js')}}"></script>
</body>
</html>
