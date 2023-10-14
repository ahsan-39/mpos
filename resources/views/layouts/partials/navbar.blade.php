<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="{{route('dashboard')}}" class="navbar-brand">
      <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" id="sidebar-toggle" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item {{request()->segment(1)=='dashboard'?'active':''}}">
          <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
        </li>
        @if(auth()->user()->role_id == 1)
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Admin</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="{{route('users.list')}}" class="dropdown-item">Users </a></li>
          </ul>
        </li>
        @endif
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <span style="font-size: 25px;"> | </span>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <span class="mt-2" style="color: rgba(0,0,0,.5);">{{ auth()->user()->name }}</span>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button" title="Logout">
            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
  </nav>
  <!-- /.navbar -->