@extends('layouts.admin')

@section('navbar')
  @include('components.navbar')
@stop

@section('sidebar')
  @include('components.admin.sidebar')
@stop

@section('content')
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">@lang('general.users')</h1>
    @include('components.messages')
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-actions">
            <a class="btn btn-lg btn-default" href="{{ route('admin.users') }}">@lang('general.back')</a>
          </div>
        </div>
      </div>
    </div>
    <form class="form-admin-user-update" action="{{ route('admin.users.store') }}" method="POST" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <h2 class="card-header">@lang('general.create')</h2>
            <div class="card-content">
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
                <input type="password" id="password" name="password" class="form-control" placeholder="@lang('general.password')" required>
              </div>
              <div class="form-group required @if($errors->has('password')) has-error @endif">
                <label class="control-label" for="password_confirmation">@lang('admin.users.create.password_confirmation')</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="@lang('admin.users.create.password_confirmation')" required>
              </div>
              <div class="form-group @if($errors->has('roles')) has-error @endif">
                <label class="control-label" for="roles">@lang('general.roles')</label>
                <select id="roles" name="roles[]" class="form-control" multiple>
                  @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if(in_array($role->id, Input::old('roles', []))) selected @endif>{{ $role->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="card-actions clearfix">
                <div class="pull-right">
                  <a class="btn btn-lg btn-danger" href="{{ route('admin.users') }}">
                    <i class="fa fa-times"></i> @lang('general.cancel')</a>
                  <button class="btn btn-lg btn-success" type="submit" data-updating-text="@lang('general.creating')...">
                    <i class="fa fa-check"></i> @lang('general.create')
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@stop
