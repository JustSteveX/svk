@props(['compName' => ''])
<div id="md-wrapper" class="min-w-full prose">
		<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
		<textarea id="md-editor" name="{{ $compName }}"></textarea>
</div>
<script defer>
		var simplemde = new SimpleMDE({
				element: document.getElementById('md-editor')
		});

		/*const mdWrapperEl = document.getElementById('md-wrapper');
		const internalLinks = document.createElement('a');
		internalLinks.classList.add("fa", "fa-link");
		// TODO Umbauen dass eine dropdown menü geöffnet wird, und es eine Liste mit möglichen Paths gibt.
		internalLinks.onclick = function(path = null) {
										simplemde.value(simplemde.value() + `[${path}](${window.location.origin + '/' + path})`);
		}
		mdWrapperEl.querySelector('.editor-toolbar').appendChild(internalLinks);

		// TODO Erweitern um die funktion für medien */
</script>
