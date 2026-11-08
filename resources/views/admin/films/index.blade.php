@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  @include('admin._nav')

  <h3>Kelola Film</h3>
  @if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
  @endif

  <a href="{{ route('admin.films.create') }}" class="btn btn-warning" style="margin-bottom:15px;">+ Tambah Film</a>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Poster</th>
          <th>Judul</th>
          <th>Genre</th>
          <th>Tahun</th>
          <th style="width:220px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($films as $film)
          <tr>
            <td><img src="{{ asset($film->poster) }}" alt="" style="height:60px;"></td>
            <td>{{ $film->title }}</td>
            <td>{{ $film->genre->name ?? '-' }}</td>
            <td>{{ $film->year }}</td>
            <td>
                <a href="{{ route('admin.films.perans.index', $film) }}" class="btn btn-success btn-xs">Peran</a>
                <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-primary btn-xs">Edit</a>
              <form action="{{ route('admin.films.destroy', $film) }}" method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('Yakin hapus film ini beserta komentarnya?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">Belum ada film.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection