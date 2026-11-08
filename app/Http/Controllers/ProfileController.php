<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user()->load('profile');

        return view('profile.show', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update(['name' => $request->name]);
        $user->profile->update($request->only('umur', 'bio', 'alamat'));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}