<ul class="nav nav-tabs">
  <li role="presentation" @if ($activeClass == 'profile.index') class="active" @endif>
    <a href="{{ route('profile.index') }}">Профайл</a>
  </li>
  <li role="presentation" @if ($activeClass == 'profile.edit') class="active" @endif>
    <a href="{{ route('profile.edit', [Auth::user()->id]) }}">Изменить профайл</a>
  </li>
  <li role="presentation" @if ($activeClass == 'profile.avatar.create') class="active" @endif>
    <a href="{{ route('profile.avatar.create') }}">Изменить аватар</a>
  </li>
  <li role="presentation" @if ($activeClass == 'profile.password.edit') class="active" @endif>
    <a href="{{ route('profile.password.edit', [Auth::user()->id]) }}">Изменить пароль</a>
  </li>
</ul>
