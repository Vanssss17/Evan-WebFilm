<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CastController extends Controller
{
    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:45'],
            'age'  => ['required', 'integer', 'between:1,120'],
            'bio'  => ['required', 'string', 'max:2000'],
        ];
    }

    public function index()
    {
        $casts = Cast::withCount('perans')->orderBy('name')->get();

        return view('admin.casts.index', compact('casts'));
    }

    public function create()
    {
        return view('admin.casts.create');
    }

    public function store(Request $request)
    {
        Cast::create($request->validate($this->rules()));

        return redirect()->route('admin.casts.index')
            ->with('success', 'Cast berhasil ditambahkan.');
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.edit', compact('cast'));
    }

    public function update(Request $request, Cast $cast)
    {
        $cast->update($request->validate($this->rules()));

        return redirect()->route('admin.casts.index')
            ->with('success', 'Cast berhasil diperbarui.');
    }

    public function destroy(Cast $cast)
    {
        DB::transaction(function () use ($cast) {
            $cast->perans()->delete();
            $cast->delete();
        });

        return redirect()->route('admin.casts.index')
            ->with('success', 'Cast berhasil dihapus.');
    }
}