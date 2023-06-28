import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

export const dropzone = new Dropzone('#dropzone', {
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
	init: function () {
		this.on('addedfile', function (file) {
			if (this.files.length > 1) this.removeFile(this.files[0]);
		});
		this.on('maxfilesexceeded', function (file) {
			this.removeAllFiles();
			this.addFile(file);
		});
		this.on('error', function (file, response) {
			console.log(response);
			if (response) {
				document.getElementById('dropzone').classList.add('border-red-300');
			}
		});
		this.on('success', function (file, response) {
			document.querySelector('#dropzone').classList.remove('border-red-300');
			document.querySelector('#dropzone').classList.add('border-green-300');
		});
		this.on('removedfile', function (file, response) {
			document
				.querySelector('#dropzone')
				.classList.remove('border-green-300');
			document.querySelector('#dropzone').classList.remove('border-red-300');
		});
	},
});
