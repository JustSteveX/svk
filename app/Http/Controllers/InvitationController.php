<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $existsInUsers = DB::table('users')->where('email', $value)->exists();
                    $existsInInvitations = DB::table('invitations')->where('email', $value)->exists();

                    if ($existsInUsers || $existsInInvitations) {
                        $fail('The email address is already in use.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Die Email existiert bereits im System.');
        }

        $invitation = new Invitation($request->all());
        $invitation->generateInvitationToken();
        $invitation->save();

        Mail::to($invitation->email)->send(
            new InvitationMail(
                $invitation->invitation_token
            ));

        return redirect()->route('dashboard')
            ->with('success', 'Einladungslink wurde erfolgreich erstellt und versendet.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Sendet eine erneute Email
     */
    public function update(Request $request, Invitation $invitation)
    {
        if (
            ! $request->validate(['email' => 'required|string', 'reinvite' => 'required', 'token' => 'required|exists:invitations,invitation_token'])) {
            return redirect()->back()->with('error', 'Wichtige Informationen fehlen!');
        }

        $invitation = Invitation::where('invitation_token', '=', $request->token)->where('email', '=', $request->email)->firstOrFail();

        if ($invitation !== null) {
            Mail::to($invitation->email)->send(
                new InvitationMail(
                    $invitation->invitation_token
                ));

            return redirect()->back()->with('success', 'Mail wurde erneut versendet.');
        }

        return redirect()->back()->with('error', 'Mail konnte nicht zugestellt werden.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate(['email' => 'required|exists:invitations,email']);

        $invitation = Invitation::where('email');

        if ($invitation) {
            // Eintrag löschen
            $invitation->delete();

            // Erfolgsnachricht und Umleitung
            return redirect()->back()->with('success', 'Einladungslink ungültig gemacht.');
        }

        // Fehlermeldung und Umleitung, falls das Event nicht existiert
        return redirect()->back()->with('error', 'Einladung nicht gefunden.');
    }
}
