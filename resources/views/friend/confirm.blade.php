
<div class="container spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Подтвердить друзей {{ Auth::user()->name }}</div>

        <div class="panel-body">
          <div class="row">
            @forelse (App\Friend::notconfirm(Auth::user()->id)->get() as $friend)
              <div class="col-sm-4 col-md-4 col-xs-4">
                <div class="thumbnail">
                  @if ($friend->userFriend->avatar)
                  <img src="/uploads/users/avatars/{{ $friend->userFriend->id }}/{{ $friend->userFriend->avatar }}"
                  alt="{{ $friend->userFriend->name }} avatar" style="height: 240px; width: 100%; display: block;">
                  @else
                  <img src="/images/users/avatars/noavatar.png"
                  alt="{{ $friend->userFriend->name }} avatar" style="height: 240px; width: 100%; display: block;">
                  @endif
                  <div class="caption text-center">
                    <div>
                      <a href="{{ route('profile.show', [$friend->userFriend->id]) }}">{{ $friend->userFriend->name }}</a>
                    </div>
                    <p></p>
                    @can('removeFriend', $friend->userFriend)
                    <a href="{{ route('friend.confirm.add', [$friend->id]) }}"
                      onclick="return confirm('Вы уверены?')" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i>
                      Принять дружбу</a>
                    <p></p>
                    <a href="{{ route('friend.remove', [$friend->userFriend]) }}"
                      onclick="return confirm('Вы уверены?')" class="btn btn-danger btn-sm"><i class="fa fa-user-times"></i>
                      Отклонить дружбу</a>
                    @endcan
                    <p></p>
                    @can('sendMessage', $friend->userFriend)
                      <a href="{{ route('message.send', [$friend->userFriend]) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-btn fa-envelope"></i>Отправить сообщение</a>
                    @endcan
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center">Заявок на дружбу больше нет</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
