@extends('layouts.admin')

@section('navbar')
  @include('components.navbar')
@stop

@section('content')
  <div class="col-xs-12 main">
    <h1 class="page-header">@lang('general.dashboard')</h1>
    <div class="row">
      <div class="col-lg-4">
        <div class="news card">
          <div class="row">
            <div class="col-xs-12">
              <div class="news-post">
                <h2 class="card-header news-header">News Header 1</h2>
                <p class="news-body">New Body 1</p>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="news-post">
                <h2 class="card-header news-header">News Header 2</h2>
                <p class="news-body">New Body 2</p>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="news-post">
                <h2 class="card-header news-header">News Header 3</h2>
                <p class="news-body">New Body 3</p>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="news-post">
                <h2 class="card-header news-header">News Header 4</h2>
                <p class="news-body">New Body 4</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop