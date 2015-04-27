@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
      @include('components.messages')
      <form class="form-signin" action="{{ route('auth.login.do') }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="form-signin-heading">@lang('auth.please')</h2>
        <label for="username" class="sr-only">@lang('general.username')</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ Input::old('username') }}" placeholder="@lang('general.username')" required autofocus>
        <label for="password" class="sr-only">@lang('general.password')</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="@lang('general.password')" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" value="1" @if(Input::old('remember') == 1) checked @endif> @lang('auth.remember_me')
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('auth.sign_in')</button>
        <div class="to-register">
          <a href="{{ route('auth.register') }}">@lang('auth.no_account')</a>
        </div>
      </form>
    </div>
  </div>
@stop