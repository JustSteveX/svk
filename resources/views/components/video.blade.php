@props(['media'])
<video controls>
  <source src="{{Storage::url('ftplink/'.$media->name)}}" type="video/mp4">
</video>
