<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('films')->orderBy('name')->get();

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45', 'unique:genres,name'],
        ]);

        Genre::create($data);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Genre berhasil ditambahkan.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45', Rule::unique('genres', 'name')->ignore($genre->id)],
        ]);

        $genre->update($data);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy(Genre $genre)
    {
        if ($genre->films()->exists()) {
            return back()->with('error', 'Genre "' . $genre->name . '" masih dipakai oleh ' . $genre->films()->count() . ' film, jadi tidak bisa dihapus.');
        }

        $genre->delete();

        return redirect()->route('admin.genres.index')
            ->with('success', 'Genre berhasil dihapus.');
    }
}