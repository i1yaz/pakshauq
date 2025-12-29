<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item"><a href="{{ route('club_admin.user.index')}}" class="nav-link nav-link {{ $route == 'club_admin.user.index' || $route == 'club_admin.register' || $route == 'club_admin.user.edit' ? 'active' : '' }}"><i class="nav-icon fas fa-lock"></i><span class="brand-text">Admins</span></a></li>
  {{-- <li class="nav-item"><a href="{{ route('club_admin.club.index')}}" class="nav-link {{ ($route == 'club_admin.club.index'|| $route == 'club_admin.club.create'|| $route == 'club_admin.club.edit') ? 'active' : '' }}"><i class="nav-icon fas fa-crown"></i><span class="brand-text">Clubs</span></a></li> --}}
  <li class="nav-item"><a href="{{ route('club_admin.player.index')}}" class="nav-link {{ ($route == 'club_admin.player.index'|| $route == 'club_admin.player.create'|| $route == 'club_admin.player.edit') ? 'active' : '' }}"><i class="nav-icon fas fa-male"></i><span class="brand-text">Players</span></a></li>
  <li class="nav-item">
      <a href="{{ route('club_admin.tournament.index')}}" class="nav-link 
        {{ ($route == 'club_admin.tournament.index'|| $route == 'club_admin.tournament.create'|| $route == 'club_admin.tournament.edit' || $route == 'club_admin.tournament.players' || $route == 'club_admin.tournament.show' ) ? 'active' : '' }}">
        <i class="nav-icon fas fa-trophy"></i><span class="brand-text">Tournaments</span>
      </a>
  </li>
  <li class="nav-item"><a href="{{ route('result.index')}}" class="nav-link {{ ($route == 'result.index'|| $route == 'result.edit' || $route == 'result.edit.date')   ? 'active' : '' }}"><i class="nav-icon fas fa-file-alt"></i><span class="brand-text">Results</span></a></li>
  <li class="nav-item"><a target="_blank" rel="noopener noreferrer" href="{{url('/')}}" class="nav-link"><i class="nav-icon fas fa-globe"></i><span class="brand-text">Website</span></a></li>

</ul>