@props(['compName' => '', 'subpageList' => []])
<div id="md-wrapper" class="min-w-full prose">
		<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
		<textarea id="md-editor" name="{{ $compName }}"></textarea>
</div>

<div x-data="{ selectIsOpen: false }" x-on:openselectmenu.window="selectIsOpen = !selectIsOpen" class="relative not-prose" id="custom-menu">
  <!-- HTML-Element zum Öffnen des Select-Menüs -->
  <!--button @click="isOpen = !isOpen" type="button" class="p-4 text-white bg-slate-800 hover:text-gray-200 hover:bg-slate-600">Testbutton</button-->
<!-- w-full h-full max-w-xs overflow-x-hidden overflow-y-scroll max-h-96->
  <!-- Select-Menü -->
  <ul x-show="selectIsOpen" class="absolute w-48 p-0 py-1 m-0 overflow-x-hidden overflow-y-scroll text-gray-200 list-none bg-slate-700 max-h-80" @click.away="selectIsOpen = false">
    @foreach($subpageList as $subpageItem)
      <li x-on:click="selectIsOpen = false; $dispatch('menu-item-selected', {'title': '{{$subpageItem->title}}', 'path': '{{$subpageItem->getUrlPath()}}'});" class="px-4 py-2 cursor-pointer hover:bg-slate-500 z-[9999]">
        <p class="font-sans not-prose">{{$subpageItem->title}}</p>
      </li>
    @endforeach
  </ul>
</div>

<script defer>
		const simplemde = new SimpleMDE({
				element: document.getElementById('md-editor'),
        spellChecker: false,
				toolbar: [
						"bold",
						"italic",
						"strikethrough",
						"|",
						"heading",
						"heading-smaller",
						"heading-bigger",
						"|",
						"heading-1",
						"heading-2",
						"heading-3",
						"|",
						"code",
						"|",
						"quote",
						"unordered-list",
						"ordered-list",
						"clean-block",
						"|",
						"link",
						"image",
						{
								name: 'mediaSelection',
								action: openMediaSelection,
								className: 'fa fa-bold',
								title: "Opens the media selection"
						},
            {
              name: 'subpageSelection',
              action: addSubpageSelection,
              className: 'fa fa-bold',
              title: "Opens the subpage selection"
            },
						"|",
						"table",
						"horizontal-rule",
						"|",
						"preview",
						"side-by-side",
						"fullscreen",
						"guide"
				]
		});

    // Hack um das menü einzubinden
    const originalMenu = document.getElementById('custom-menu');
    const menu = originalMenu.cloneNode(true);
    originalMenu.remove();
    simplemde.toolbarElements.subpageSelection.appendChild(menu);
    simplemde.gui.toolbar.style.zIndex = 30;


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

    //window.addEventListener('openselectmenu', (event)=> console.log(event));

    window.addEventListener('menu-item-selected', event => handleItemSelection(event));

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
