@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
      @include('components.messages')
      <form class="form-register" action="{{ route('auth.register.do') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="form-signin-heading">@lang('auth.registrar')</h2>
        <div class="form-group required @if($errors->has('username')) has-error @endif">
          <label class="control-label" for="username">@lang('general.username')</label>
          <input type="text" id="username" name="username" class="form-control" value="{{ Input::old('username') }}" placeholder="@lang('general.username')" required>
        </div>
        <div class="form-group @if($errors->has('email')) has-error @endif">
          <label class="control-label" for="email">@lang('general.email')</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ Input::old('email') }}" placeholder="@lang('general.email')">
        </div>
        <div class="form-group required @if($errors->has('password')) has-error @endif">
          <label class="control-label" for="password">@lang('general.password')</label>
          <input type="password" id="password" name="password" class="form-control" value="{{ Input::old('password') }}" placeholder="@lang('general.password')" required>
        </div>
        <div class="form-group required @if($errors->has('password')) has-error @endif">
          <label class="control-label" for="password_confirmation">@lang('admin.users.create.password_confirmation')</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="{{ Input::old('password_confirmation') }}" placeholder="@lang('admin.users.create.password_confirmation')" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.register')</button>
        <div class="to-auth">
          <a href="{{ route('auth.login') }}">@lang('auth.to_login')</a>
        </div>
      </form>
    </div>
  </div>
@stop