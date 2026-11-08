<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Cast, Film, Peran};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeranController extends Controller
{
    public function index(Film $film)
    {
        $perans = Peran::with('cast')->where('film_id', $film->id)->get();
        $casts  = Cast::orderBy('name')->get();

        return view('admin.perans.index', compact('film', 'perans', 'casts'));
    }

    public function store(Request $request, Film $film)
    {
        $data = $request->validate([
            'cast_id' => [
                'required',
                'exists:casts,id',
                Rule::unique('perans', 'cast_id')->where('film_id', $film->id),
            ],
            'actor' => ['required', 'string', 'max:255'],
        ], [
            'cast_id.unique' => 'Cast ini sudah ada di film ini.',
        ]);

        Peran::create($data + ['film_id' => $film->id]);

        return redirect()->route('admin.films.perans.index', $film)
            ->with('success', 'Peran berhasil ditambahkan.');
    }

    public function edit(Peran $peran)
    {
        $peran->load('film');
        $casts = Cast::orderBy('name')->get();

        return view('admin.perans.edit', compact('peran', 'casts'));
    }

    public function update(Request $request, Peran $peran)
    {
        $data = $request->validate([
            'cast_id' => [
                'required',
                'exists:casts,id',
                Rule::unique('perans', 'cast_id')
                    ->where('film_id', $peran->film_id)
                    ->ignore($peran->id),
            ],
            'actor' => ['required', 'string', 'max:255'],
        ], [
            'cast_id.unique' => 'Cast ini sudah ada di film ini.',
        ]);

        $peran->update($data);

        return redirect()->route('admin.films.perans.index', $peran->film_id)
            ->with('success', 'Peran berhasil diperbarui.');
    }

    public function destroy(Peran $peran)
    {
        $filmId = $peran->film_id;
        $peran->delete();

        return redirect()->route('admin.films.perans.index', $filmId)
            ->with('success', 'Peran berhasil dihapus.');
    }
}