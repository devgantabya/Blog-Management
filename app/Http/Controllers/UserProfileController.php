<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class UserProfileController extends Controller
{
    /**
     * Show a user's profile by username.
     */
    public function show(string $username): Response
    {
        $user = User::where('username', $username)->firstOrFail();

        $profileData = [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'profile_image' => $user->profile_image
                ? Storage::url($user->profile_image)
                : null,
            'join_date' => $user->formatted_join_date, // accessor
            'created_at' => $user->created_at,
        ];

        return Inertia::render('Profile/Show', [
            'profileUser' => $profileData,
        ]);
    }

    /**
     * Store uploaded profile image for authenticated user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $user = Auth::user();

        // Store image in 'public/profile_images'
        $path = $request->file('image')->store('profile_images', 'public');

        // Update user profile image
        $user->profile_pic = $path;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'Profile image uploaded successfully.');
    }
}
