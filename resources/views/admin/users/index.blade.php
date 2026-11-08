@extends('templates.index')

@section('content')
<div class="container" style="padding: 2em 0 3em;">
  @include('admin._nav')
  <h3>Daftar User</h3>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:60px;">No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Umur</th>
          <th>Alamat</th>
          <th>Komentar</th>
          <th>Terdaftar</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name ?? '-' }}</td>
            <td>{{ $user->profile->umur ?? '-' }}</td>
            <td>{{ \Illuminate\Support\Str::limit($user->profile->alamat ?? '-', 40) }}</td>
            <td>{{ $user->kritiks_count }}</td>
            <td>{{ $user->created_at?->format('d M Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="8">Belum ada user.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection