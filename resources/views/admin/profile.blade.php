@extends('layouts.admin')

@section('navbar')
  @include('components.navbar')
@stop

@section('sidebar')
  @include('components.admin.sidebar')
@stop

@section('content')
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">@lang('profile.title')</h1>
    @include('components.messages')
    <form class="form-profile" action="{{ route('admin.profile.update') }}" method="POST" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <h2 class="card-header">@lang('profile.edit.details')</h2>
            <div class="card-content">
              <div class="form-group">
                <label class="control-label" for="username">@lang('general.username')</label>
                <p id="username" class="form-control-static">{{ $user->username }}</p>
              </div>
              <div class="form-group @if($errors->has('email')) has-error @endif">
                <label class="control-label" for="email">@lang('profile.edit.email.new') @if($user->email) <span class="muted">(@lang('profile.edit.email.current', ['email' => $user->email]))</span> @endif </label>
                <input type="email" id="email" name="email" class="form-control" value="{{ Input::old('email') }}" placeholder="@lang('profile.edit.email.new')">
              </div>
              <div class="form-group @if($errors->has('email')) has-error @endif">
                <label class="control-label" for="email_confirmation">@lang('profile.edit.email.confirmation')</label>
                <input type="email" id="email_confirmation" name="email_confirmation" class="form-control" placeholder="@lang('profile.edit.email.confirmation')">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <h2 class="card-header">@lang('profile.edit.password.update')</h2>
            <div class="card-content">
              <div class="form-group @if($errors->has('current_password')) has-error @endif">
                <label class="control-label" for="current_password">@lang('profile.edit.password.current')</label>
                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="@lang('profile.edit.password.current')">
              </div>
              <div class="form-group @if($errors->has('password')) has-error @endif">
                <label class="control-label" for="password">@lang('profile.edit.password.new')</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="@lang('profile.edit.password.new')">
              </div>
              <div class="form-group @if($errors->has('password')) has-error @endif">
                <label class="control-label" for="password_confirmation">@lang('profile.edit.password.confirmation')</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="@lang('profile.edit.password.confirmation')">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="card clearfix">
            <div class="card-actions pull-right">
              <a class="btn btn-lg btn-danger" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-times"></i> @lang('general.cancel')</a>
              <button class="btn btn-lg btn-success" type="submit">
                <i class="fa fa-check"></i> @lang('general.update')
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@stop