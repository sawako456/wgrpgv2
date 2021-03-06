@extends('layouts.admin')

@section('navbar')
  @include('components.navbar')
@stop

@section('sidebar')
  @include('components.admin.sidebar')
@stop

@section('content')
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">@lang('general.dashboard')</h1>
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <a href="{{ route('admin.users') }}">
            <div class="card-logo jumbo card-header text-center">
              <i class="fa fa-users"></i>
            </div>
            <div class="card-content">
              <h2>@lang('general.users') <small>{{ $userCount }}</small></h2>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <a href="#worlds">
            <div class="card-logo jumbo card-header text-center">
              <i class="fa fa-globe"></i>
            </div>
            <div class="card-content">
              <h2>@lang('general.worlds') <small>{{ $worldCount }}</small></h2>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <a href="#templates">
            <div class="card-logo jumbo card-header text-center">
              <i class="fa fa-cubes"></i>
            </div>
            <div class="card-content">
              <h2>@lang('general.templates')</h2>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <a href="#settings">
            <div class="card-logo jumbo card-header text-center">
              <i class="fa fa-cogs"></i>
            </div>
            <div class="card-content">
              <h2>@lang('general.settings')</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
@stop