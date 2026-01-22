<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'city' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $avatarPath = 'avatars/plug.png';

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'avatar' => $avatarPath,
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'profession' => $request->profession,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('welcome');
    }
}
