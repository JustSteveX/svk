<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Models\Blogpost;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BlogpostController extends Controller
{
    public function index()
    {
        $blogpostList = Blogpost::where('archived', '=', false)->get();

        $groupedBlogposts = $blogpostList->sortByDesc('created_at')->groupBy(function ($blogpost) {
            return Carbon::parse($blogpost->created_at)->format('Y');
        });

        return view('components.content.blogpost', compact('groupedBlogposts'));
    }

    public function store(Request $request)
    {
        if (
            ! $request->validate([
                'title' => ['string', 'required', 'max:255'],
                'author' => ['string', 'required', 'max:255'],
                'content' => ['string', 'required'],
                'album' => ['nullable', 'exists:albums,id'],
                'media' => ['nullable', 'exists:media,id'],
            ])) {
            return redirect()->back()->with('error', 'Beitrag konnte nicht angelegt werden.');
        }

        $blogpost = Blogpost::create([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
            'media_id' => $request->media,
            'album_id' => $request->album,
        ]);

        foreach (Subscriber::whereNotNull('email_verified_at')->get() as $subscriber) {
            Mail::to($subscriber->email)->send(
                new NewsletterMail(
                    $blogpost->content,
                    $blogpost->title,
                    $blogpost->author,
                    $blogpost->created_at,
                    $subscriber->email,
                    $subscriber->token
                ));
        }

        return redirect()->back()->with('success', 'Beitrag erfolgreich angelegt & Mails versendet');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|string|exists:blogposts,id',
        ]);

        Blogpost::destroy($request->id);

        return redirect()->back()->with('success', 'Beitrag wurde erfolgreich gelöscht');
    }

    public function archive(Request $request)
    {
        $request->validate(['id' => 'required|string|exists:blogposts,id']);

        $blogpost = Blogpost::find($request->id);
        $blogpost->archived = ! $blogpost->archived;
        $blogpost->save();

        return redirect()->back()->with('success', 'Beitrag wurde '.($blogpost->archived ? 'archiviert' : 'wiederhergestellt'));
    }
}
