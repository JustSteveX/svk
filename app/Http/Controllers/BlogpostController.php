<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogpostController extends Controller
{
    public function index()
    {
        $blogpostList = Blogpost::all();

        $groupedBlogposts = $blogpostList->sortByDesc('created_at')->groupBy(function ($blogpost) {
            return Carbon::parse($blogpost->created_at)->format('Y');
        });

        return view('components.content.blogpost', compact('groupedBlogposts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'author' => ['string', 'required', 'max:255'],
            'content' => ['string', 'required'],
            'album' => ['nullable', 'exists:albums,id'],
            'media' => ['nullable', 'exists:media,id'],
        ]);

        $blogpost = Blogpost::create([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
            'media_id' => $request->media,
            'album_id' => $request->album,
        ]);

        $blogpost->save();

        return redirect()->back()->with('success', 'Beitrag erfolgreich angelegt');
    }
}
