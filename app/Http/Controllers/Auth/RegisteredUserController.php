<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $invitation_token = $request->get('invitation_token');
        $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
        //$email = $invitation->email;

        return view('auth.register', compact('invitation'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'invitation_token' => ['required', 'exists:invitations,invitation_token'],
        ]);

        $invitation = Invitation::where('invitation_token', $request->invitation_token)->firstOrFail();
        $invitation->registered_at = Carbon::now();
        $invitation->save();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $invitation->role_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function requestInvitation()
    {
        return view('auth.request');
    }

    public function update(Request $request){
      $request->validate(['userid' => 'required|exists:users,id', 'roleid' => 'required|exists:roles,id']);

      $user = User::find($request->userid);
      $role = Role::find($request->roleid);

      $user->role_id = $role->id;

      $user->save();

      return redirect()->back()->with('success', 'Benutzerrolle wurde geändert.');
    }
}
