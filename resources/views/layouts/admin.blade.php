@extends('layouts.master')

@section('page')
  @yield('navbar')
  <div class="site-wrapper container-fluid">
    <div class="row">
      @yield('sidebar')
      @yield('content')
    </div>
  </div>
@stop
