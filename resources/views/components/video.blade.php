@props(['media'])
<video class="max-w-[33%] max-h-[50%]" controls>
  <source src="{{Storage::url('ftplink/'.$media->name)}}" type="video/mp4">
</video>
