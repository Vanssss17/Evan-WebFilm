@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em; max-width:700px;">
  <h3>Tambah Cast</h3>

  <form action="{{ route('admin.casts.store') }}" method="POST">
    @csrf
    @include('admin.casts._form')
    <button type="submit" class="btn btn-warning">Simpan</button>
    <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection