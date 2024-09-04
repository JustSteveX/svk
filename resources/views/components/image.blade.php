@props(['media' => null])
<img {{ $attributes->merge(['class' => 'cursor-pointer']) }} onclick="openModal(
'imageModal', null, { closeAll: true, inputData: {'name': '{{$media->name}}', 'imageUrl': '{{Storage::url('media/' . $media->name)}}' }}
)" alt="{{$media->name}}" src="{{ Storage::url('media/' . $media->name) }}">


