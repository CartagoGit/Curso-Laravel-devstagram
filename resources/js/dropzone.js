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
	
	init: function () {
		this.on('addedfile', function (file) {
			// Si se agrega una segunda imagen, remueve la imagen anterior
			if (this.files.length > 1) {
				this.removeFile(this.files[0]);
			}
		});
	},
});

// dropzone.on('sending', function (file, xhr, formData) {});
