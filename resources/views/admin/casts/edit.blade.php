@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em; max-width:700px;">
  <h3>Edit Cast</h3>

  <form action="{{ route('admin.casts.update', $cast) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.casts._form')
    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
    <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection