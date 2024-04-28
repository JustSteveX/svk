@props(['media'])
<a class="px-4 py-2 bg-slate-900 text-slate-200 hover:bg-slate-700" href="{{ Storage::url('media/' . $media->name) }}" download>Download: {{$media->shortenedName(true)}}</a>
