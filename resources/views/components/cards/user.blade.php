<div class="card">
  <a href="{{ route('admin.users.show', [$user->id]) }}">
    <div class="card-logo jumbo card-header text-center">
      <i class="fa fa-user"></i>
    </div>
    <div class="card-content">
      <p>
        {{ $user->username }}
        @if($user->trashed())
          <span class="label label-danger">@lang('general.deleted')</span>
        @endif
        @if($user->id === Auth::id())
          <span class="label label-info">@lang('general.you')</span>
        @endif
        @foreach($user->roles as $role)
          @if($role->name !== 'Login')
            <span class="label label-{{ $role->label }}">{{ $role->name }}</span>
          @endif
        @endforeach
      </p>
    </div>
  </a>
</div>