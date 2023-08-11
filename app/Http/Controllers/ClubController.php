<?php

namespace App\Http\Controllers;

use App\Models\CollapsibleElement;
use Illuminate\Http\Request;

class ClubController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('components.content.club', ['collapsibleElements' => CollapsibleElement::where('parent_type', '=', 'club')->get()]);
  }
}
