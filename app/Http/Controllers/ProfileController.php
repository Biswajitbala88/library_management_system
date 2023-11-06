<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


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
        
        $user = Auth::user();
        // dd($user);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        if($request->attachment){
            if ($request->user()->image) {
                $oldAttachmentPath = $user->image;
                
                if (Storage::disk('public')->exists($oldAttachmentPath)) {
                    // dd('111');
                    Storage::disk('public')->delete($oldAttachmentPath);
                }
                $this->storeAttachment($request, $user);
            }
        }
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    protected function storeAttachment($request, $user)
    {
        // dd($user);
        $extension = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = $user->name;
        $noSpacesString = str_replace(' ', '_', $filename);
        $currentDateTime = date("Y-m-d_H:i:s");
        $filenameWithDateTime = $currentDateTime . '_' . $noSpacesString;
        $path = "images/$filenameWithDateTime.$extension";

        Storage::disk('public')->put($path, $contents);
        $user->update(['image' => $path]);
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

    
}
