import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropZoneElement = document.querySelector('#dropzone');
export const dropzone =
	dropZoneElement &&
	new Dropzone('#dropzone', {
		// dictDefaultMessage: "Suelta tu imagen aquí",
		acceptedFiles: '.jpg,.png,.jpeg,.gif,.bmp',
		addRemoveLinks: true,
		dictRemoveFile: 'Eliminar archivo',
		maxFiles: 1,
		maxFilesize: 3,
		uploadMultiple: false,
		parallelUploads: 1,
		thumbnailWidth: '500',
		thumbnailHeight: '500',
		// url: "{{ route('images.store') }}",
		init: function () {
			if (!document.querySelector('#dropzone')) return;

			if (document.querySelector('[name="imagen"]')?.value.trim()) {
				let imagenPublicada = {
					accepted: true,
					name: document.querySelector('[name="imagen"]').value,
					size: 1234,
					status: 'success',
				};
				document
					.querySelector('#dropzone')
					.classList.add('border-green-300');

				this.options.addedfile.call(this, imagenPublicada);
				this.options.thumbnail.call(
					this,
					imagenPublicada,
					imagenPublicada.name
				);
				imagenPublicada.previewElement.classList.add(
					'dz-success',
					'dz-complete'
				);
				this.files.push(imagenPublicada);
			}

			this.on('addedfile', function (file) {
				if (this.files.length > 1) this.removeFile(this.files[0]);
			});
			this.on('maxfilesexceeded', function (file) {
				this.removeAllFiles();
				this.addFile(file);
			});
			this.on('error', function (_file, response) {
				if (response) {
					document
						.getElementById('dropzone')
						.classList.add('border-red-300');
				}
			});
			this.on('success', function (_file, response) {
				document
					.querySelector('#dropzone')
					.classList.remove('border-red-300');
				document
					.querySelector('#dropzone')
					.classList.add('border-green-300');
				document.querySelector('[name="imagen"]').value =
					response.data.public_path;
			});
			this.on('removedfile', function (_file, _response) {
				document
					.querySelector('#dropzone')
					.classList.remove('border-green-300');
				document
					.querySelector('#dropzone')
					.classList.remove('border-red-300');
				document.querySelector('[name="imagen"]').value = null;
			});
		},
	});
