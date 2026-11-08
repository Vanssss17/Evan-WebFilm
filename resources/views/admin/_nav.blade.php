<ul class="nav nav-tabs" style="margin-bottom:20px;">
  <li class="{{ request()->routeIs('admin.films.*') ? 'active' : '' }}">
    <a href="{{ route('admin.films.index') }}">Film</a>
  </li>
  <li class="{{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
    <a href="{{ route('admin.genres.index') }}">Genre</a>
  </li>
  <li class="{{ request()->routeIs('admin.casts.*') ? 'active' : '' }}">
    <a href="{{ route('admin.casts.index') }}">Cast</a>
  </li>
</ul>