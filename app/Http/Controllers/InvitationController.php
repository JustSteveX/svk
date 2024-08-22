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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
}
