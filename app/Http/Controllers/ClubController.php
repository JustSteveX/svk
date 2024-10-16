<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Subpage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    public function index(): View
    {
        $subpage = Subpage::where('parent_id', '=', null)->get()->first();

        return view('components.content.club', compact('subpage'));
    }

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

        //$album = Album::where('name', $albumName)->firstOrFail();
        //$mediaList = $album->media;

        //return view('components.content.gallery', compact('album', 'mediaList'));

        return view('components.content.club', compact('subpage'));
    }

    public function store(Request $request): RedirectResponse
    {
        /*if ($request->validate([
            'title' => ['string', 'required'],
            'content' => ['string', 'required'],
            'parent_id' => ['nullable', 'exists:subpages,id'],
        ])) {
            return redirect()->route('dashboard')->with('error', 'Fehlgeschlagen '.($request->parent_id ?? 'null'));
        }*/
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:subpages,id',
            'title' => 'required|string',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:subpages,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Fehlgeschlagen '.implode(', ', $validator->errors()->keys()));
        }

        $content = str_replace("\n", '', $request->content);

        // Sicherstellen dass es nur eine Subpage gibt die keine parent_id hat
        // damit, auf der vereinsseite auch immer die korrekte Seite angezeigt wird
        if (Subpage::exists()) {
            $subpage = Subpage::whereNull('parent_id')->first();
            if (($subpage->id !== ((int) $request->id)) && $request->parent_id === null) {
                return redirect()->back()->with('error', 'Bitte wähle eine Elternseite aus!');
            }
        }

        if ($request->id) {
            $subpage = Subpage::find($request->id);
            $subpage->title = $request->title;
            $subpage->content = $content;
            $subpage->parent_id = $request->parent_id;
            $subpage->save();
        } else {
            Subpage::create(['title' => $request->title, 'content' => $content, 'parent_id' => $request->parent_id]);
        }

        $responseText = $request->id ? 'Die Seite wurde erfolgreich editiert' : 'Die Seite wurde erfolgreich angelegt';

        return redirect()->route('dashboard')->with('success', $responseText);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['id' => 'string|required|exists:subpages,id']);
        if ($request->id === 1) {
            return redirect()->back()->with('error', 'Diese Seite kann nicht gelöscht werden');
        }
        Subpage::destroy($request->id);

        return redirect()->back()->with('success', 'Die Seite wurde erfolgreich gelöscht');
    }
}
