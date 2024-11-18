import './bootstrap';
import 'flowbite';

import 'flowbite-datepicker';
import 'flowbite/dist/datepicker.turbo.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

import.meta.glob(['../images/**', '../fonts/**']);

window.openModal = function (
  name,
  callback = null,
  options = { closeAll: true, title: '', content: '', action: '', inputData: {} }
) {
  const modal = document.querySelector(`[x-ref="modal"][data-modal-name="globalModal"]`);
  if (modal) {
      const modalAlpineComp = modal._x_dataStack.find((data) => data.show !== undefined);

      if (modalAlpineComp) {
          if (options.closeAll) {
              modalAlpineComp.$dispatch('close-all-modals');
          }

          modalAlpineComp.$dispatch('open-modal', {
              name,
              title: options.title,
              content: options.content,
              action: options.action,
              inputData: options.inputData,
          });
      }
  }

  if (callback) {
      const listener = (event) => {
          if (event.detail.name === name) {
              callback(event.detail);
              document.removeEventListener('modal-data-returned', listener);
          }
      };
      document.addEventListener('modal-data-returned', listener);
  }
};


/**
 * Verarbeitet eine Liste von Dateien und verkleinert Bilder, falls nötig.
 * @param {HTMLInputElement} inputElement
 */
window.processFiles = async function (inputElement) {
	const files = inputElement.files;
	const maxSizeInMB = 2; // Maximale Größe in MB (z.B. 2MB)
	const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

	// Neues DataTransfer-Objekt erstellen (zum Neusetzen des Inputs)
	let dataTransfer = new DataTransfer();

	for (let i = 0; i < files.length; i++) {
		let file = files[i];
		console.log(
			`Originalgröße von ${file.name}: ${(
				file.size /
				(1024 * 1024)
			).toFixed(2)} MB`
		);

		if (file.type.startsWith('image/') && file.size > maxSizeInBytes) {
			// Bildgröße überschreitet das Limit, Bild wird verkleinert
			const resizedFile = await resizeImage(file);
			console.log(
				`Neue Größe von ${resizedFile.name}: ${(
					resizedFile.size /
					(1024 * 1024)
				).toFixed(2)} MB`
			);
			dataTransfer.items.add(resizedFile); // Verkleinertes Bild hinzufügen
		} else {
			dataTransfer.items.add(file); // Datei unverändert hinzufügen
		}
	}

	// Setze die verarbeiteten Dateien in das neue Input-Feld
	inputElement.files = dataTransfer.files;
};

/**
 * Verkleinert ein Bild, falls es zu groß ist.
 * @param {File} file
 * @returns {Promise<File>} Ein neues, verkleinertes Bild als File
 */
async function resizeImage(file) {
	const img = new Image();
	const reader = new FileReader();

	return new Promise((resolve, reject) => {
		reader.onload = function (event) {
			img.src = event.target.result;

			img.onload = function () {
				const canvas = document.createElement('canvas');
				const ctx = canvas.getContext('2d');

				// Maximale Zielgröße für Breite und Höhe festlegen
				const maxWidth = 1024;
				const maxHeight = 1024;
				let width = img.width;
				let height = img.height;

				// Bild proportional skalieren
				if (width > maxWidth || height > maxHeight) {
					if (width > height) {
						height = Math.floor((height * maxWidth) / width);
						width = maxWidth;
					} else {
						width = Math.floor((width * maxHeight) / height);
						height = maxHeight;
					}
				}

				// Neue Dimensionen für das Canvas festlegen
				canvas.width = width;
				canvas.height = height;

				// Bild in das Canvas zeichnen (wird hier skaliert)
				ctx.drawImage(img, 0, 0, width, height);

				// Das Bild als Blob exportieren (JPEG mit 80% Qualität)
				canvas.toBlob(
					function (blob) {
						// Neuen File aus dem Blob erstellen und zurückgeben
						const resizedFile = new File([blob], file.name, {
							type: 'image/jpeg',
							lastModified: Date.now(),
						});
						resolve(resizedFile); // Rückgabe des neuen, verkleinerten Bildes
					},
					'image/jpeg',
					0.8 // Qualität der Komprimierung (80%)
				);
			};
		};

		reader.onerror = reject;
		reader.readAsDataURL(file); // Bild als DataURL lesen
	});
}
