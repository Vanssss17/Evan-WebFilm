@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  @include('admin._nav')
  <h3>Kelola Genre</h3>

  @if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
  @endif
  @if (session('error'))
    <p style="color:red">{{ session('error') }}</p>
  @endif

  <a href="{{ route('admin.genres.create') }}" class="btn btn-warning" style="margin-bottom:15px;">+ Tambah Genre</a>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:60px;">No</th>
          <th>Nama Genre</th>
          <th>Jumlah Film</th>
          <th style="width:150px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($genres as $genre)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $genre->name }}</td>
            <td>{{ $genre->films_count }}</td>
            <td>
              <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-primary btn-xs">Edit</a>
              <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('Yakin hapus genre ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4">Belum ada genre.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection