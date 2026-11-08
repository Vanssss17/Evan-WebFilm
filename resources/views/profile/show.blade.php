@extends('templates.index')

@section('content')
@section('content')
<style>
  .form-module input[type="number"],
  .form-module textarea {
    outline: none;
    display: block;
    width: 100%;
    border: 1px solid #d9d9d9;
    margin: 0 0 20px;
    padding: 10px 15px;
    box-sizing: border-box;
    font-weight: 400;
    font-size: 14px;
    transition: 0.3s ease;
  }
  .form-module input[type="number"]:focus,
  .form-module textarea:focus {
    border: 1px solid #C7D0F5;
    color: #333333;
  }
  .form-module textarea {
    resize: vertical;
    min-height: 90px;
  }
  .form-module input:disabled {
    background: #f3f3f3;
    color: #777;
  }
</style>

<div class="container" style="padding: 2em 0 3em;">
  ...
<div class="container" style="padding: 2em 0 3em;">
  <div class="form-module">
    <div class="form" style="display:block;">
      <h3>Profil Saya</h3>

      @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger" style="font-size:13px;">
          <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('PUT')

        <label for="name" style="display:block; text-align:left; color:#555; font-size:13px; margin:8px 0 4px;">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

        <label style="display:block; text-align:left; color:#555; font-size:13px; margin:8px 0 4px;">Email</label>
        <input type="email" value="{{ $user->email }}" disabled>

        <label for="umur" style="display:block; text-align:left; color:#555; font-size:13px; margin:8px 0 4px;">Umur</label>
        <input type="number" id="umur" name="umur" value="{{ old('umur', $user->profile->umur) }}" required>

        <label for="bio" style="display:block; text-align:left; color:#555; font-size:13px; margin:8px 0 4px;">Bio</label>
        <textarea id="bio" name="bio" required>{{ old('bio', $user->profile->bio) }}</textarea>

        <label for="alamat" style="display:block; text-align:left; color:#555; font-size:13px; margin:8px 0 4px;">Alamat</label>
        <textarea id="alamat" name="alamat" required>{{ old('alamat', $user->profile->alamat) }}</textarea>

        <input type="submit" value="Simpan">
        </form>
    </div>
  </div>
</div>
@endsection