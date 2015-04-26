<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li @if(Route::is('admin.dashboard')) class="active" @endif>
      <a href="{{ route('admin.dashboard') }}">Overview</a>
    </li>
    <li @if(Route::is('admin.users*')) class="active" @endif>
      <a href="{{ route('admin.users') }}">Users</a>
    </li>
  </ul>
</div>