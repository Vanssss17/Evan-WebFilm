@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  @include('admin._nav')
  <h3>Kelola Cast</h3>

  @if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
  @endif

  <a href="{{ route('admin.casts.create') }}" class="btn btn-warning" style="margin-bottom:15px;">+ Tambah Cast</a>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:60px;">No</th>
          <th>Nama</th>
          <th>Umur</th>
          <th>Bio</th>
          <th>Jumlah Peran</th>
          <th style="width:150px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($casts as $cast)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cast->name }}</td>
            <td>{{ $cast->age }}</td>
            <td>{{ \Illuminate\Support\Str::limit($cast->bio, 80) }}</td>
            <td>{{ $cast->perans_count }}</td>
            <td>
              <a href="{{ route('admin.casts.edit', $cast) }}" class="btn btn-primary btn-xs">Edit</a>
              <form action="{{ route('admin.casts.destroy', $cast) }}" method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('Yakin hapus cast ini beserta perannya di film?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6">Belum ada cast.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection