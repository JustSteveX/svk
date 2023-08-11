<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $galleryAlbums = Album::where('show_in_gallery', 1)->withCount('images')->get();
    return view('components.content.gallery', ['albums' => $galleryAlbums->where('images_count', '>', '0')->all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function show(Album $news)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function edit(Album $news)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Album  $albums
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Album $news)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function destroy(Album $news)
  {
    //
  }
}
