@props(['compName'])
<div>
  <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
  <textarea id="md-editor" class="w-24" name="{{ $compName }}"></textarea>
</div>
<script defer>
  var simplemde = new SimpleMDE({
    element: document.getElementById('md-editor')
  });
</script>
