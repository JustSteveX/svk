@props(['media' => null])
<div
    {{ $attributes->merge(['class' => 'cursor-pointer bg-primary text-center text-white hover:bg-accent hover:rounded-lg rounded-none transition-all']) }}
    onclick="window.openModal('globalModal', null, {
        title: '{{$media->name}}',
        content: `
            <div class='flex justify-center flex-col'>
              <video id='video' controls>
                <source src='{{ $media->url() }}' type='video/mp4'>
              </video>
              @isset($media->caption)
                <small class='text-gray-500 font-bold pt-4'>{{$media->caption}}</small>
              @endisset
            </div>
        `,
        action: null,
        inputData: {
        }
    })"
>
  <div class="py-16 flex flex-col justify-center items-center gap-4">
    <x-bi-play-fill class="w-8 h-8" />

    <p>{{$media->name}}</p>
  </div>
</div>
