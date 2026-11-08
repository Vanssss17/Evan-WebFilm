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
  <label for="name">Nama</label>
  <input type="text" id="name" name="name" class="form-control"
         value="{{ old('name', $cast->name ?? '') }}" required>
</div>

<div class="form-group">
  <label for="age">Umur</label>
  <input type="number" id="age" name="age" class="form-control"
         value="{{ old('age', $cast->age ?? '') }}" required>
</div>

<div class="form-group">
  <label for="bio">Bio</label>
  <textarea id="bio" name="bio" rows="5" class="form-control" required>{{ old('bio', $cast->bio ?? '') }}</textarea>
</div>