<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd(request()->all());
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // if ($request->hasFile('profilepicture')) {
        //     $request->user()->profilepicture = $request->file('profilepicture')->store('profilepicture');
        // }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

public function updatePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|max:2048', // 2MB Max
    ]);

    $user = Auth::user(); // Get the authenticated user

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        
        // Generate a unique file name
        $fileName = time().'_'.$file->getClientOriginalName();
        
        // Move the file to a public directory and get the file path
        $path = $file->storeAs('public/profile_pictures', $fileName);

        // If you want to make the file accessible directly via the web, use the 'public' disk
        // Remember to run 'php artisan storage:link' to create the symbolic link
        
        // Update the user's profile with the new profile picture path
        $user->profile_picture = $path;
        $user->save();

        return back()->with('success', 'Profile picture updated successfully.');
    }

    return back()->with('error', 'There was a problem uploading your profile picture.');
}
}