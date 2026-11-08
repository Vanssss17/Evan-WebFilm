@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  <div class="form-module">
    <div class="form" style="display:block;">
      <h3>Buat akun baru</h3>

      @if ($errors->any())
        <div class="alert alert-danger" style="font-size:13px;">
          <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register.store') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Password (min. 8 karakter)" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required>
        <input type="submit" value="Daftar">
      </form>
    </div>
    <div class="cta">
      Sudah punya akun? <a href="{{ route('login') }}"><b>Login</b></a>
    </div>
  </div>
</div>
@endsection