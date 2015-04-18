@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <a class="btn btn-danger" href="{{ route('auth.logout') }}">Sign out</a>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      @foreach($worlds as $world)
        <div class="col-xs-12">
          <h1>World <small>{{ $world->name }}</small></h1>
        </div>
        @foreach($world->maps as $map)
          <div class="col-xs-12">
            <h2>Map <small>{{ $map->name }}</small></h2>
            {{-- TODO: Create blade control to get text and perform nl2br --}}
            <p>{!! nl2br(Lang::get($map->text_entry)) !!}</p>
          </div>
          @foreach($map->tiles as $tile)
            <div class="col-xs-3">
              <div data-toggle="tooltip" data-placement="top" @if($tile->type == 3) title="Dungeon Wall" class="alert alert-danger" @else title="Dungeon" class="alert alert-success" @endif>
                <p class="text-center" style="color:#666;">z: {{ $tile->z }}, x: {{ $tile->x }}</p>
              </div>
            </div>
          @endforeach
        @endforeach
      @endforeach
    </div>
  </div>
@stop