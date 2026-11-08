<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3_search">
      <form action="#" method="post">
        <input type="text" name="Search" placeholder="Search" required="">
        <input type="submit" value="Go">
      </form>
    </div>
    <div class="w3l_sign_in_register">
  <ul>
    @auth
      <li>
        <span style="color:#212121; font-weight:bold; margin-right:8px;">{{ auth()->user()->name }}</span>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display:none;">
          @csrf
        </form>
      </li>
    @else
      <li><a href="{{ route('login') }}">Login</a></li>
    @endauth
  </ul>
</div>
<div class="clearfix"> </div>
  </div>
</div>