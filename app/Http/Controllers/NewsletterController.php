<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Models\Blogpost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'email']);

        $blogpost = Blogpost::latest()->first();

        Mail::to($request->get('email'))->send(new NewsletterMail($blogpost->content, $blogpost->title, $blogpost->author, $blogpost->created_at));
    }
}
