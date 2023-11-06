<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:10', 'regex:/^\d{10}$/'],
            'attachment' => ['required', 'image', 'mimes:jpeg,png,gif'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_type' => 'student',
            'password' => Hash::make($request->password),
        ]);
        if($request->file('attachment')){
            // dd('fca');
            $this->storeAttachment($request, $user);
        }
        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    protected function storeAttachment($request, $user){
        $extension = $request->file('attachment')->extension();
        $contents = file_get_contents($request->file('attachment'));
        $filename = $request->name;
        $noSpacesString = str_replace(' ', '_', $filename);
        $currentDateTime = date("Y-m-d_H:i:s");
        $filenameWithDateTime = $currentDateTime . '_' . $noSpacesString;
        // dd($filenameWithDateTime);
        $path = "images/$filenameWithDateTime.$extension";
        // dd($contents);
        Storage::disk('public')->put($path, $contents);
        $user->update(['image' => $path]);
    }

    // if($request->file('attachment')){
    //     // dd('fca');
    //     // Storage::disk('public')->delete($ticket->attachment);
        
    //     if ($ticket->attachment) {
    //         $oldAttachmentPath = $ticket->attachment;
    //         // dd($oldAttachmentPath);
    //         // Check if the old attachment exists
    //         if (Storage::disk('public')->exists($oldAttachmentPath)) {
    //             // Delete the old attachment file
    //             // dd('test 67687');
    //             Storage::disk('public')->delete($oldAttachmentPath);
    //         }
    //         $this->storeAttachment($request, $ticket);
    //     }

        

    // }
}
