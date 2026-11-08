@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em; max-width:700px;">
  <h3>Tambah Film</h3>

  <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.films._form')
    <button type="submit" class="btn btn-warning">Simpan</button>
    <a href="{{ route('admin.films.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection