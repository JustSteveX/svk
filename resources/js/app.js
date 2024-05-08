import './bootstrap';
import 'flowbite';

import 'flowbite-datepicker';
import 'flowbite/dist/datepicker.turbo.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

import.meta.glob(['../images/**', '../fonts/**']);

Alpine.start();

window.openModal = function (
	name,
	callback = null,
	options = { closeAll: true, inputData: {} }
) {
	const modal = document.querySelector('[x-ref="modal"]'); // Select the modal component
	if (modal) {
		const modalAlpineComp = modal._x_refs.modal._x_dataStack[0];
		if (options.closeAll) {
			modalAlpineComp.$dispatch('close-all-modals');
		}
		if (!!options.inputData) {
			modalAlpineComp.inputData = options.inputData;
		}
		modalAlpineComp.$dispatch('open-modal', name);
	}

	if (!!callback) {
		document.addEventListener(
			'modal-data-returned',
			function myListener(event) {
				callback(event);
				document.removeEventListener('modal-data-returned', myListener);
			}
		);
	}
};
