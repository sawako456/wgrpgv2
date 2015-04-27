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
            @if($user->trashed())
              <a class="btn btn-lg btn-warning pull-right" href="#restore" data-toggle="modal" data-target="#confirm-restore">@lang('general.restore')</a>
            @else
              <a class="btn btn-lg btn-default" href="{{ route('admin.users.edit', [$user->id]) }}">@lang('general.edit')</a>
              <a class="btn btn-lg btn-danger pull-right" href="#delete" data-toggle="modal" data-target="#confirm-delete">@lang('general.delete')</a>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <h2 class="card-header">@lang('general.profile')</h2>
          <div class="card-content">
            <div class="form-group">
              <label class="control-label" for="username">@lang('general.username')</label>
              <p id="username" class="form-control-static">{{ $user->username }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="email">@lang('general.email')</label>
              <p id="email" class="form-control-static">{{ $user->email or trans('general.none') }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="roles">@lang('general.roles')</label>
              <p id="roles" class="form-control-static">
                @foreach($user->roles as $role)
                  <span class="label label-{{ $role->label }}">{{ $role->name }}</span>
                @endforeach
              </p>
            </div>
            <h3 class="card-header">@lang('general.timestamps')</h3>
            <div class="form-group">
              <label class="control-label" for="created_at">@lang('general.date.created_at')</label>
              <p id="created_at" class="form-control-static">{{ $user->created_at }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="updated_at">@lang('general.date.updated_at')</label>
              <p id="updated_at" class="form-control-static">{{ $user->updated_at }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="last_login_at">@lang('general.date.last_login_at')</label>
              <p id="last_login_at" class="form-control-static">{{ $user->logins ? $user->last_login_at : trans('general.never') }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="deleted_at">@lang('general.date.deleted_at')</label>
              <p id="deleted_at" class="form-control-static">{{ $user->deleted_at or trans('general.na') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <h2 class="card-header">@lang('general.stats')</h2>
          <div class="card-content">
            <div class="form-group">
              <label class="control-label" for="logins">@lang('general.num.logins')</label>
              <p id="logins" class="form-control-static">{{ $user->logins }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="worlds">@lang('general.num.worlds')</label>
              <p id="worlds" class="form-control-static">{{ $worldCount }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="characters">@lang('general.num.characters')</label>
              <p id="characters" class="form-control-static">{{ $characterCount or 0 }}</p>
            </div>
            <div class="form-group">
              <label class="control-label" for="heaviest">@lang('character.heaviest')</label>
              @if(isset($heaviestCharacter))
                <p id="heaviest" class="form-control-static">{{ $heaviestCharacter->name }}: {{ $heaviestCharacter->weight }}<small>lbs</small></p>
              @else
                <p id="heaviest" class="form-control-static">@lang('general.na')</p>
              @endif
            </div>
            <div class="form-group">
              <label class="control-label" for="description">@lang('general.description')</label>
              <p id="description" class="form-control-static">@lang('lorem.ipsum')</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('modal')
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="confirm-delete-label">@lang('admin.users.delete.confirm.title')</h4>
        </div>
        <div class="modal-body">
          <p>@lang('admin.users.delete.confirm.description', ['name' => $user->username])</p>
        </div>
        <div class="modal-footer">
          <form class="form-confirm-delete" action="{{ route('admin.users.destroy', [$user->id]) }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">@lang('general.cancel')</button>
            <button type="submit" class="btn btn-lg btn-danger">
              <i class="fa fa-times"></i> @lang('general.delete')
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm-restore" tabindex="-1" role="dialog" aria-labelledby="confirm-restore-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="confirm-restore-label">@lang('admin.users.restore.confirm.title')</h4>
        </div>
        <div class="modal-body">
          <p>@lang('admin.users.restore.confirm.description', ['name' => $user->username])</p>
        </div>
        <div class="modal-footer">
          <form class="form-confirm-delete" action="{{ route('admin.users.restore', [$user->id]) }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">@lang('general.cancel')</button>
            <button type="submit" class="btn btn-lg btn-warning">
              <i class="fa fa-undo"></i> @lang('general.restore')
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop