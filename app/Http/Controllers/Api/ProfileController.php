<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profession' => $user->profession,
                'bio' => $user->bio,
                'rating' => $user->rating ?? 0,
                'avatar' => $user->avatar ?? 'https://i.pravatar.cc/150?u=' . $user->id,
            ]
        ]);
    }
    public function edit(Request $request)
    {
        return Inertia::render('Profile/Edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
