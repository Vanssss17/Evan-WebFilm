@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  <div class="form-module">
    <div class="form" style="display:block;">
      <h3>Login ke akun kamu</h3>

      @if ($errors->any())
        <div class="alert alert-danger" style="font-size:13px;">
          <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('login.store') }}" method="post">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Password" required>
        <label style="font-weight:400; font-size:13px;">
          <input type="checkbox" name="remember"> Ingat saya
        </label>
        <input type="submit" value="Login">
      </form>
    </div>
    <div class="cta">
      Belum punya akun? <a href="{{ route('register') }}"><b>Daftar</b></a>
    </div>
  </div>
</div>
@endsection