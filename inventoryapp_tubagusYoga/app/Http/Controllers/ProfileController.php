<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profiles;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        $currentUser = Auth::user();
        $user = User::find($currentUser->id);
        if ($user->profile) {
            $profile = Profiles::where('user_id', $user->id)->first();
            return view('profile.update', ['profile' => $profile]);
        } else {
            return view('profile.add');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'age' => 'required|integer',
            'bio' => 'required|string',
        ]);

        $currentUser = Auth::user();
        $profile = new Profiles;
        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');
        $profile->user_id = $currentUser->id;

        $profile->save();

        return redirect('/profile')->with('success', 'Profil Berhasil Dibuat!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'age' => 'required|integer',
            'bio' => 'required|string',
        ]);

        $currentUser = Auth::user();
        $profile = Profiles::where('user_id', $currentUser->id)->first();
        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');

        $profile->save();

        return redirect('/profile')->with('success', 'Profil Berhasil Diperbarui!');
    }
}
