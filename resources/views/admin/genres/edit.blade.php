@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em; max-width:700px;">
  <h3>Edit Genre</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0; padding-left:18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.genres.update', $genre) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Nama Genre</label>
      <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $genre->name) }}" required>
    </div>
    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
    <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection