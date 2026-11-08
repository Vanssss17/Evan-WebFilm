<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Film, Genre, Peran};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('genre')->orderByDesc('id')->get();

        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.films.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string'],
            'year'     => ['required', 'integer', 'between:1900,2100'],
            'genre_id' => ['required', 'exists:genres,id'],
            'poster'   => ['required', 'image', 'max:2048'],
        ]);

        $data['poster'] = 'storage/' . $request->file('poster')->store('images', 'public');

        Film::create($data);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.films.edit', compact('film', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'sinopsis' => ['required', 'string'],
            'year'     => ['required', 'integer', 'between:1900,2100'],
            'genre_id' => ['required', 'exists:genres,id'],
            'poster'   => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = 'storage/' . $request->file('poster')->store('images', 'public');
        } else {
            unset($data['poster']);
        }

        $film->update($data);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film)
    {
        DB::transaction(function () use ($film) {
            $film->kritiks()->delete();
            Peran::where('film_id', $film->id)->delete();
            $film->delete();
        });

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil dihapus.');
    }
}