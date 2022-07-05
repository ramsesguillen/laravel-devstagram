import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if (document.querySelector('#dropzone')) {

    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,

        init: function() {
            if (document.querySelector('[name="imagen"]').value.trim()) {
                const imagenPublicado = {};
                imagenPublicado.size = 1234; // No importa el peso de la imagen
                imagenPublicado.name = document.querySelector('[name="imagen"]').value;

                this.options.addedfile.call(
                    this,
                    imagenPublicado
                );

                this.options.thumbnail.call(
                    this,
                    imagenPublicado,
                    `/uploads/${imagenPublicado.name}`
                );

                imagenPublicado.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    });

    dropzone.on('success', function(file, response) {
        document.querySelector('[name="imagen"]').value = response.imagen;
    });

    dropzone.on('removedfile', function() {
        document.querySelector('[name="imagen"]').value = '';
    });
}
