<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
      <img src="{{asset('logo-32x32.png')}}" alt="{{ config('app.name') }} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(auth()->user()->role_id == 1)
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{request()->segment(1)=='dashboard'?'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endif
          @if(auth()->user()->role_id == 1)
          <li class="nav-item">
            <a href="{{route('users.list')}}" class="nav-link {{request()->segment(1)=='users'?'active':''}}">
              <i class="nav-icon fa fa-users"></i>
                <p>
                  Users
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{request()->segment(1)=='clients'?'active':''}}">
              <i class="nav-icon fa fa-user-alt"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="#" class="nav-link {{request()->segment(1)=='invoices'?'active':''}}">
              <i class="nav-icon fa fa-file-alt"></i>
              <p>
                Invoices
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>