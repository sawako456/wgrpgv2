@if(Session::has('errors') || Session::has('messages') || Session::has('infos'))
  @if(isset($errors) && $errors instanceof \Illuminate\Support\ViewErrorBag)
    @foreach($errors->all() as $error)
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{{ ucfirst($error) }}</p>
          </div>
        </div>
      </div>
    @endforeach
  @endif
  @if(Session::has('messages') && Session::get('messages') instanceof \Illuminate\Support\MessageBag)
    @foreach(Session::pull('messages')->all() as $message)
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{{ $message }}</p>
          </div>
        </div>
      </div>
    @endforeach
  @endif
  @if(Session::has('infos') && Session::get('infos') instanceof \Illuminate\Support\MessageBag)
    @foreach(Session::pull('infos')->all() as $info)
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{{ $info }}</p>
          </div>
        </div>
      </div>
    @endforeach
  @endif
@endif