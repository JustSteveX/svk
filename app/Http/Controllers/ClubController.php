<?php

namespace App\Http\Controllers;

use App\Models\Subpage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    // Gibt die Vereinsstartseite zurück
    public function index(): View
    {
        $subpage = Subpage::get()->first();

        return view('components.content.club', compact('subpage'));
    }

    // Gibt eine Vereinsseite zurück enthält
    public function show(string $path): View
    {
        $subpageTitles = array_map(function ($step) {
            return urldecode(strtolower($step));
        }, explode('/', $path));

        $subpageList = Subpage::all();
        $subpage = null;
        foreach ($subpageList as $subpageItem) {
            if (in_array(strtolower($subpageItem->title), $subpageTitles)) {
                $subpage = $subpageItem;
            }
        }

        return view('components.content.club', compact('subpage'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:subpages,id',
            'title' => 'required|string',
            'markdown_details' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Fehlgeschlagen '.implode(', ', $validator->errors()->keys()));
        }

        $subpage = Subpage::find($request->id);
        if ($subpage === null) {
            Subpage::create(['title' => $request->title, 'content' => $request->markdown_details]);
        } else {
            $subpage->title = $request->title;
            $subpage->content = $request->markdown_details;
            $subpage->save();
        }

        $responseText = $subpage ? 'Die Seite wurde erfolgreich editiert' : 'Die Seite wurde erfolgreich angelegt';

        return redirect()->back()->with('success', $responseText);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['id' => 'string|required|exists:subpages,id']);
        Subpage::destroy($request->id);

        return redirect()->back()->with('success', 'Die Seite wurde erfolgreich gelöscht');
    }
}
