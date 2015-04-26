@extends('layouts.admin')

@section('navbar')
  @include('components.navbar')
@stop

@section('sidebar')
  @include('components.admin.sidebar')
@stop

@section('content')
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">@lang('general.users') <small>{{ $user->username }}</small></h1>
    @include('components.messages')
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-actions">
            <a class="btn btn-lg btn-primary" href="{{ route('admin.users.create') }}">@lang('general.create')</a>
            <a class="btn btn-lg btn-default" href="{{ route('admin.users.show', [$user->id]) }}">@lang('general.show')</a>
          </div>
        </div>
      </div>
    </div>
    <form class="form-admin-user-update" action="{{ route('admin.users.update', [$user->id]) }}" method="POST" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <h2 class="card-header">@lang('general.profile') <small>@lang('general.editing')</small></h2>
            <div class="card-content">
              <div class="form-group @if($errors->has('username')) has-error @endif">
                <label class="control-label" for="username">@lang('general.username')</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ Input::old('username', $user->username) }}" placeholder="@lang('general.username')" required>
              </div>
              <div class="form-group @if($errors->has('email')) has-error @endif">
                <label class="control-label" for="email">@lang('general.email')</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ Input::old('email', $user->email) }}" placeholder="@lang('general.email')">
              </div>
              <div class="form-group @if($errors->has('roles')) has-error @endif">
                <label class="control-label" for="roles">@lang('general.roles')</label>
                <select id="roles" name="roles[]" class="form-control" multiple>
                  @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if(in_array($role->id, Input::old('roles', $user->roles()->lists('id')))) selected @endif>{{ $role->name }}</option>
                  @endforeach
                </select>
              </div>
              <h3 class="card-header">@lang('general.timestamps')</h3>
              <div class="form-group @if($errors->has('created_at')) has-error @endif">
                <label class="control-label" for="created_at">@lang('general.date.created_at')</label>
                <input type="text" id="created_at" name="created_at" class="datetime-picker form-control" value="{{ Input::old('created_at', $user->created_at) }}" placeholder="@lang('general.date.created_at')" required>
              </div>
              <div class="form-group @if($errors->has('updated_at')) has-error @endif">
                <label class="control-label" for="updated_at">@lang('general.date.updated_at')</label>
                <input type="text" id="updated_at" name="updated_at" class="datetime-picker form-control" value="{{ Input::old('updated_at', $user->updated_at) }}" placeholder="@lang('general.date.updated_at')" required>
              </div>
              <div class="form-group">
                <label class="control-label" for="last_login_at">@lang('general.date.last_login_at')</label>
                <input type="text" id="last_login_at" name="last_login_at" class="datetime-picker form-control" value="{{ Input::old('last_login_at', ($user->last_login_at != '0000-00-00 00:00:00' ? $user->last_login_at : null)) }}" placeholder="@lang('general.date.last_login_at')">
              </div>
              <div class="form-group">
                <label class="control-label" for="logins">@lang('general.num.logins')</label>
                <input type="number" min="0" step="1" id="logins" name="logins" class="form-control" value="{{ Input::old('logins', $user->logins) }}" placeholder="@lang('general.num.logins')" required>
              </div>
              <div class="card-actions clearfix">
                <div class="pull-right">
                  <a class="btn btn-lg btn-danger" href="{{ route('admin.users.show', [$user->id]) }}">
                    <i class="fa fa-times"></i> @lang('general.cancel')</a>
                  <button class="btn btn-lg btn-success" type="submit" data-updating-text="@lang('general.updating')...">
                    <i class="fa fa-check"></i> @lang('general.update')
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
