<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li @if(Route::is('admin.dashboard')) class="active" @endif>
      <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Overview <span class="sr-only">(current)</span></a>
    </li>
    <li>
      <a href="#users"><i class="fa fa-users"></i> Users</a>
    </li>
  </ul>
</div>