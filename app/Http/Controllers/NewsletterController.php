<?php

namespace App\Http\Controllers;

use App\Mail\VerifyNewsletter;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsletterController extends Controller
{
    public function unsubscribe($email, $token): RedirectResponse
    {
        $validator = Validator::make(
            ['email' => $email, 'token' => $token],
            ['email' => 'required|email|exists:subscribers,email', 'token' => 'required|string|exists:subscribers,token']
        );

        $subscriber = Subscriber::where('email', '=', $email);

        if ($validator->fails() || ! $subscriber) {
            return redirect()->route('startseite')->with('error', 'Ihre Abmeldung zum Newsletter ist fehlgeschlagen.');
        }

        $subscriber->delete();

        return redirect()->route('startseite')->with('success', 'Ihre Abmeldung zum Newsletter wurde bestätigt.');
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:subscribers,email']);

        $token = Str::random(60);

        Subscriber::create([
            'email' => $request->email,
            'token' => $token,
        ]);

        Mail::to($request->email)->send(new VerifyNewsletter($token));

        return redirect()->back()->with('success', 'Vielen Dank für Ihre Anmeldung! Bitte überprüfen Sie Ihre E-Mail, um Ihre Anmeldung abzuschließen.');
    }

    public function verifySubscription($token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();

        $subscriber->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Ihre Anmeldung zum Newsletter wurde bestätigt.');
    }

    public function resend($email): RedirectResponse
    {
        $subscriber = Subscriber::where('email', '=', $email)->firstOrFail();

        if (! $subscriber || isset($subscriber->email_verified_at)) {
            return redirect()->route('startseite')->with('error', 'Die Bestätigungsmail konnte nicht versendet werden!');
        }

        Mail::to($subscriber->email)->send(new VerifyNewsletter($subscriber->token));

        return redirect()->route('startseite')->with('success', 'Die Bestätigungsmail wurde erneut versendet!');
    }

    /** Entfernt alle unverifizierten Subscriber der letzten 30 Tage */
    public function destroy(): RedirectResponse
    {
      $thirtyDaysAgo = Carbon::now()->subDays(30);
      Subscriber::whereNull('email_verified_at')
                ->where('created_at', '<', $thirtyDaysAgo)
                ->delete();
      return redirect()->back()->with('success', 'Alle Newsletter-Abonnenten, deren E-Mail-Verifizierung seit mehr als 30 Tagen aussteht, wurden erfolgreich entfernt.');
    }
}
