<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ $dashboardRoute }}">Cryptic's WGRPG v3</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <p class="navbar-text">@lang('general.logged_in_as', ['name' => Auth::user()->username])</p>
        <li @if(Route::is('dashboard', 'admin.dashboard')) class="active" @endif>
          <a href="{{ $dashboardRoute }}" title="@lang('general.dashboard')">
            <span class="sr-only">@lang('general.dashboard')</span>
            <i class="fa fa-dashboard"></i>
          </a>
        </li>
        <li @if(Route::is('profile.edit', 'admin.profile.edit')) class="active" @endif>
          <a href="{{ $profileRoute }}" title="@lang('general.profile')">
            <span class="sr-only">@lang('general.profile')</span>
            <i class="fa fa-user"></i>
          </a>
        </li>
        <li>
          <a href="{{ route('auth.logout') }}" title="@lang('auth.sign_out')">
            <span class="sr-only">@lang('auth.sign_out')</span>
            <i class="fa fa-sign-out"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>