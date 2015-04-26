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
            <a class="btn btn-lg btn-primary" href="{{ route('admin.users.create') }}">@lang('general.create')</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($users as $i => $user)
        <div class="col-sm-4 col-md-3">
          @include('components.cards.user', ['user' => $user])
        </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card clearfix">
          <div class="card-actions pull-right">
            {!! $users->render() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop