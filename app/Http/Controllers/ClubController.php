<?php

namespace App\Http\Controllers;

use App\Models\Subpage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    // Gibt die Vereinsstartseite zurück (parent_id === null)
    public function index(): View
    {
        $subpage = Subpage::where('parent_id', '=', null)->get()->first();

        return view('components.content.club', compact('subpage'));
    }

    // Gibt eine Vereinsseite zurück die eine parent_id enthält
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
            'parent_id' => 'nullable|exists:subpages,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->with('error', 'Fehlgeschlagen '.implode(', ', $validator->errors()->keys()));
        }

        // Neue Zeilen durch ein br Tag ersetzen
        $markdown_details = preg_replace('/\r\n|\r|\n/', '<br>', $request->markdown_details);
        // Tabs durch ein span mit class tab ersetzen
        $markdown_details = str_replace("\t", '<span class="tab"></span>', $markdown_details);

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
            $subpage->content = $markdown_details;
            $subpage->parent_id = $request->parent_id;
            $subpage->save();
        } else {
            Subpage::create(['title' => $request->title, 'content' => $markdown_details, 'parent_id' => $request->parent_id]);
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
