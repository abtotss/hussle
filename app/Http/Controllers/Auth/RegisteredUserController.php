<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * Behavior:
     * - If the current user is an admin, they can create a user and set the role.
     *   Admin-creator is NOT logged out and we do NOT log in as the newly created user.
     * - If the request comes from guest (public registration), we create a 'user' and log them in.
     */
    public function store(Request $request)
    {
        // Base validation rules for all registrations
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // If current user is admin, allow optional role field (checked later)
        if (auth()->check() && auth()->user()->role === 'admin') {
            $rules['role'] = ['nullable', 'string', 'in:user,admin'];
        }

        $validated = $request->validate($rules);

        // Determine role to assign:
        $roleToAssign = 'user'; // default

        if (auth()->check() && auth()->user()->role === 'admin') {
            // Admin may set role, but default to 'user' if nothing provided
            $roleToAssign = $validated['role'] ?? 'user';
        } else {
            // Public registration always becomes 'user'
            $roleToAssign = 'user';
        }

        // Create the user
        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $roleToAssign,
        ]);

        event(new Registered($newUser));

        // If the creator is an admin, do NOT log in as the created user.
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->back()->with('success', "User '{$newUser->email}' created with role '{$newUser->role}'.");
        }

        // Otherwise, log the newly registered user in and redirect to home/dashboard
        Auth::login($newUser);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
