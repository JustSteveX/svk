@props(['media' => null])

<img
    {{ $attributes->merge(['class' => 'cursor-pointer']) }}
    onclick="window.openModal('globalModal', null, {
        title: '{{$media->getShortName()}}',
        content: `
            <div class='flex items-center justify-center'>
                <img src='{{ $media->url() }}'
                     class='min-h-[200px] max-h-[80vh]'
                     alt='{{ $media->name }}'>
            </div>
        `,
        action: `
            <div class='flex justify-end gap-4'>
                <a href='{{ $media->url() }}'
                   class='px-4 py-2 font-extrabold uppercase duration-150 ease-in-out bg-primary text-accent-50 hover:bg-accent'
                   download>
                    Bild herunterladen
                </a>
            </div>
        `,
        inputData: {
            imageUrl: '{{ $media->url() }}'
        }
    })"
    alt="{{ $media->name }}"
    src="{{ $media->url() }}"
>
