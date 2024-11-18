<!-- Globales dynamisches Modal -->
<div
    x-data="modalComponent(false, 'globalModal')"
    x-ref="modal"
    data-modal-name="globalModal"
    x-show="show"
    class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 overflow-y-auto sm:px-0"
    style="display: none;"
    @open-modal.window="handleEvent($event)"
    @close.window="close()"
    @close-all-modals.window="close()"
>
    <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 opacity-75" @click="close()"></div>
    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl sm:w-full sm:max-w-3xl sm:mx-auto">
        <!-- Dynamischer Inhalt -->
        <div class="flex justify-between p-4">
            <h3 class="text-lg font-semibold" id="modal-title" x-text="title"></h3>
            <button @click="close()" class="text-gray-600 rounded-lg w-7 h-7 hover:text-gray-400 hover:bg-gray-300">
                <x-eos-close />
            </button>
        </div>
        <hr class="border-accent">
        <div class="p-4" x-html="content"></div>

        <div x-show="action">
          <hr class="border-accent">
          <div class="p-4 bg-gray-100 dark:bg-gray-700">
              <template x-if="action">
                  <div x-html="action"></div>
              </template>
          </div>
        </div>
    </div>
</div>

<script>
  function modalComponent(initialShow, name) {
      return {
          show: initialShow,
          title: '',      // Dynamischer Titel
          content: '',    // Dynamischer Inhalt (HTML)
          action: null,   // Dynamische Aktionen (HTML)
          inputData: {},  // Daten, die das Modal benötigt
          reset() {
              this.title = '';
              this.content = '';
              this.action = null;
              this.inputData = {};
          },
          close() {
              this.show = false;
              this.reset();
          },
          open(data) {
              this.title = data.title || '';
              this.content = data.content || '';
              this.action = data.action || null;
              this.inputData = data.inputData || {};
              this.show = true;
          },
          handleEvent(event) {
              if (event.detail.name === name) {
                  this.open(event.detail);
              }
          },
          init() {
              this.$watch('show', value => {
                  document.body.classList.toggle('overflow-y-hidden', value);
              });
          }
      };
  }
</script>
