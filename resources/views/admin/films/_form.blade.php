@if ($errors->any())
  <div class="alert alert-danger">
    <ul style="margin:0; padding-left:18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="form-group">
  <label for="title">Judul</label>
  <input type="text" id="title" name="title" class="form-control"
         value="{{ old('title', $film->title ?? '') }}" required>
</div>

<div class="form-group">
  <label for="sinopsis">Sinopsis</label>
  <textarea id="sinopsis" name="sinopsis" rows="5" class="form-control" required>{{ old('sinopsis', $film->sinopsis ?? '') }}</textarea>
</div>

<div class="form-group">
  <label for="year">Tahun</label>
  <input type="number" id="year" name="year" class="form-control"
         value="{{ old('year', $film->year ?? '') }}" required>
</div>

<div class="form-group">
  <label for="genre_id">Genre</label>
  <select id="genre_id" name="genre_id" class="form-control" required>
    <option value="">-- Pilih genre --</option>
    @foreach ($genres as $genre)
      <option value="{{ $genre->id }}" @selected(old('genre_id', $film->genre_id ?? '') == $genre->id)>
        {{ $genre->name }}
      </option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="poster">Poster</label>
  @isset($film)
    <div style="margin-bottom:8px;">
      <img src="{{ asset($film->poster) }}" alt="{{ $film->title }}" style="height:120px;">
    </div>
    <small>Kosongkan jika tidak ingin mengganti poster.</small>
  @endisset
  <input type="file" id="poster" name="poster" accept="image/*" {{ isset($film) ? '' : 'required' }}>
</div>