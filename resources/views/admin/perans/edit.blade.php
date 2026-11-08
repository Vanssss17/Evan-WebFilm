@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em; max-width:700px;">
  <h3>Edit Peran di film: {{ $peran->film->title }}</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0; padding-left:18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.perans.update', $peran) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="cast_id">Cast</label>
      <select id="cast_id" name="cast_id" class="form-control" required>
        @foreach ($casts as $cast)
          <option value="{{ $cast->id }}" @selected(old('cast_id', $peran->cast_id) == $cast->id)>{{ $cast->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="actor">Nama Peran/Karakter</label>
      <input type="text" id="actor" name="actor" class="form-control"
             value="{{ old('actor', $peran->actor) }}" required>
    </div>

    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
    <a href="{{ route('admin.films.perans.index', $peran->film_id) }}" class="btn btn-default">Batal</a>
  </form>
</div>
@endsection