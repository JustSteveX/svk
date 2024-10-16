@props(['compName' => '', 'subpageList' => []])
<div id="md-wrapper" class="min-w-full prose">
		<textarea id="md-editor" name="{{ $compName }}"></textarea>
</div>

<div x-data="{ selectIsOpen: false }" x-on:openselectmenu.window="selectIsOpen = !selectIsOpen" class="relative not-prose" id="custom-menu">

  <ul x-show="selectIsOpen" class="absolute w-48 p-0 py-1 m-0 overflow-x-hidden overflow-y-scroll text-gray-200 list-none bg-slate-700 max-h-80" @click.away="selectIsOpen = false">
    @foreach($subpageList as $subpageItem)
      <li x-on:click="selectIsOpen = false; $dispatch('menu-item-selected', {'title': '{{$subpageItem->title}}', 'path': '{{$subpageItem->getUrlPath()}}'});" class="px-4 py-2 cursor-pointer hover:bg-slate-500 z-[9999]">
        <p class="font-sans not-prose">{{$subpageItem->title}}</p>
      </li>
    @endforeach
  </ul>
</div>

<script defer>
  function openMediaSelection(editor) {
      const cm = editor.codemirror;
      const selectedText = cm.getSelection();
      const text = selectedText || 'Text';
      openModal('mediaSelection', (event) => {
          if (!event.detail) {
              return;
          }
          const images = [];
          const docs = [];
          const imageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp', 'image/svg+xml'];
          event.detail.forEach(media => {
              if (media.name.endsWith('.exe')) return;
              if (imageTypes.includes(media.mime_type)) images.push(media.name);
              else docs.push(media.name);
          });

          let output = '';
          output += images.map(image =>
              `![${text}](<${window.location.origin}/storage/media/${image}>)`
          );
          output += docs.map(doc => `[Download ${doc}](<${window.location.origin}/storage/media/${doc}>)`);

          cm.replaceSelection(output);
      });
  }

  function addSubpageSelection(editor){
    window.dispatchEvent(new CustomEvent('openselectmenu'));
    window.editor = editor;
  }

  function handleItemSelection(event) {
    const editor = window.editor;
    const cm = editor.codemirror;
    const selectedText = cm.getSelection();
    const output = `[${event.detail.title}](<${event.detail.path}>)`;
    cm.replaceSelection(output);
  }
</script>
