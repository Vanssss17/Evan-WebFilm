@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  @include('admin._nav')
  <h3>Peran di film: {{ $film->title }}</h3>
  <p><a href="{{ route('admin.films.index') }}">&larr; Kembali ke daftar film</a></p>

  @if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0; padding-left:18px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.films.perans.store', $film) }}" method="POST" class="form-inline" style="margin-bottom:20px;">
    @csrf
    <select name="cast_id" class="form-control" required>
      <option value="">-- Pilih cast --</option>
      @foreach ($casts as $cast)
        <option value="{{ $cast->id }}" @selected(old('cast_id') == $cast->id)>{{ $cast->name }}</option>
      @endforeach
    </select>
    <input type="text" name="actor" class="form-control" placeholder="Nama peran/karakter"
           value="{{ old('actor') }}" required>
    <button type="submit" class="btn btn-warning">+ Tambah Peran</button>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:60px;">No</th>
          <th>Cast</th>
          <th>Peran</th>
          <th style="width:150px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($perans as $peran)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $peran->cast->name ?? '-' }}</td>
            <td>{{ $peran->actor }}</td>
            <td>
              <a href="{{ route('admin.perans.edit', $peran) }}" class="btn btn-primary btn-xs">Edit</a>
              <form action="{{ route('admin.perans.destroy', $peran) }}" method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('Yakin hapus peran ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4">Belum ada peran di film ini.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection