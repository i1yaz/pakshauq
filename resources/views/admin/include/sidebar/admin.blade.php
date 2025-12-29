<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  @if (Auth::user()->super_admin)
    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
    <li class="nav-item"><a href="{{ route('news.index')}}" class="nav-link {{ ($route == 'news.index'|| $route == 'news.create'|| $route == 'news.edit') ? 'active' : '' }}"><i class="nav-icon fas fa-newspaper"></i><span class="brand-text">News</span></a></li>
    <li class="nav-item"><a href="{{ route('user.index')}}" class="nav-link nav-link {{ $route == 'user.index' || $route == 'register' || $route == 'user.edit' ? 'active' : '' }}"><i class="nav-icon fas fa-lock"></i><span class="brand-text">Admins</span></a></li>
    <li class="nav-item"><a href="{{ route('club.index')}}" class="nav-link {{ ($route == 'club.index'|| $route == 'club.create'|| $route == 'club.edit') ? 'active' : '' }}"><i class="nav-icon fas fa-crown"></i><span class="brand-text">Clubs</span></a></li>
    <li class="nav-item"><a href="{{ route('player.index')}}" class="nav-link {{ ($route == 'player.index'|| $route == 'player.create'|| $route == 'player.edit') ? 'active' : '' }}"><i class="nav-icon fas fa-male"></i><span class="brand-text">Players</span></a></li>
    <li class="nav-item">
      <a href="{{ route('tournament.index')}}" class="nav-link 
        {{ ($route == 'tournament.index'|| $route == 'tournament.create'|| $route == 'tournament.edit' || $route == 'tournament.players' || $route == 'tournament.show' ) ? 'active' : '' }}">
        <i class="nav-icon fas fa-trophy"></i><span class="brand-text">Tournaments</span>
      </a>
    </li>
  @endif
  <li class="nav-item"><a href="{{ route('result.index')}}" class="nav-link {{ ($route == 'result.index'|| $route == 'result.edit' || $route == 'result.edit.date')   ? 'active' : '' }}"><i class="nav-icon fas fa-file-alt"></i><span class="brand-text">Results</span></a></li>
  @if (Auth::user()->super_admin)
    <li class="nav-item"><a href="{{ route('website.index')}}" class="nav-link {{ ($route == 'website.index'|| $route == 'website.create'|| $route == 'website.edit') ? 'active' : '' }}"><i class="nav-icon fas fa-cog"></i><span class="brand-text">Setting</span></a></li>
  @endif
    <li class="nav-item"><a target="_blank" rel="noopener noreferrer" href="{{url('/')}}" class="nav-link"><i class="nav-icon fas fa-globe"></i><span class="brand-text">Website</span></a></li>
</ul>