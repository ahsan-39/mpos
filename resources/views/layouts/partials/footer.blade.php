<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.1.0
  </div>
  <strong>Copyright &copy; {{date('Y')}} {{ config('app.vendor') }}.</strong>
</footer>
<!-- Logout Form -->

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>