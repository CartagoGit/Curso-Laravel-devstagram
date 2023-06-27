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
});

// dropzone.on('sending', function (file, xhr, formData) {});
