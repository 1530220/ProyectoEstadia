$('.image-title').html('Ningún archivo cargado');

function readURL(input) {
    var split = input.files[0]['name'].split(".");

    var extension = split[split.length - 1];

    var accepted_extentions = ['jpeg', 'JPEG', 'png', 'PNG', 'jpg', 'JPG'];

    var accepted_file = false;

    if (accepted_extentions.includes(extension)) {
        accepted_file = true;
    }

    if (accepted_file) {
        if (input.files && input.files[0]) {
            if(input.files[0]['size']<4194304){
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);
            }else{
                $("#image_input").val("");
                swal({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El archivo supera los 4 MB de tamaño, por favor seleccione un archivo que no sobrepase los 4 MB de tamaño.',
                    buttons: 'Aceptar',
                });
            }

        } else {
            removeUpload();
        }
    }else{
        removeUpload();
        $("#image_input").val("");
        swal({
            icon: 'error',
            title: 'Formato de imagen no valido',
            text: 'Por favor solo agregue imágenes con los siguientes formatos validos: jpg, png, jpeg.',
            buttons: 'Aceptar',
        })

    }
}

function readURLForTutorias(input) {
    var split = input.files[0]['name'].split(".");

    var extension = split[split.length - 1];

    var accepted_extentions = ['pdf', 'PDF', 'jpeg', 'JPEG', 'png', 'PNG', 'jpg', 'JPG', 'bmp', 'BMP'];

    var accepted_file = false;

    if (accepted_extentions.includes(extension)) {
        accepted_file = true;
    }

    if (accepted_file) {
        if (input.files && input.files[0]) {
            if(input.files[0]['size']<4194304){
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    if(extension=="pdf" || extension=="PDF"){
                        $('.file-upload-image').height(100);
                        $('.file-upload-image').width(75);
                        $('.file-upload-image').attr('src', window.location.href.split('/').slice(0, 3).join('/')+"/img/pdf_icon.png");
                    }else{
                        $('.file-upload-image').css('height', 'auto');
                        $('.file-upload-image').css('width', 'auto');
                        $('.file-upload-image').attr('src', e.target.result);
                    }
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);
            }else{
                $("#image_input").val("");
                removeUpload();
                swal({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El archivo supera los 4 MB de tamaño, por favor seleccione un archivo que no sobrepase los 4 MB de tamaño.',
                    buttons: 'Aceptar',
                });
            }
        } else {
            removeUpload();
        }
    }else{
        $("#image_input").val("");
        swal({
            icon: 'error',
            title: 'Formato de archivo no valido',
            text: 'Por favor solo agregue archivos con los siguientes formatos validos: pdf, jpg, png, jpeg, bmp.',
            buttons: 'Aceptar',
        })

    }
}


function readURLForImportation(input) {
    var split = input.files[0]['name'].split(".");

    var extension = split[split.length - 1];

    var accepted_extentions = ['csv', 'CSV'];

    var accepted_file = false;

    if (accepted_extentions.includes(extension)) {
        accepted_file = true;
    }

    if (accepted_file) {
        if (input.files && input.files[0]) {
            if(input.files[0]['size']<4194304){
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    if(extension=="csv" || extension=="CSV"){
                        $('.file-upload-image').height(100);
                        $('.file-upload-image').width(75);
                        $('.file-upload-image').attr('src', window.location.href.split('/').slice(0, 3).join('/')+"/img/csv_icon.png");
                    }
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };


                reader.readAsDataURL(input.files[0]);
            }else{
                $("#image_input").val("");
                removeUpload();

                swal({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El archivo supera los 4 MB de tamaño, por favor seleccione un archivo que no sobrepase los 4 MB de tamaño.',
                    buttons: 'Aceptar',
                });
            }
        } else {

            removeUpload();

        }
    }else{
        $("#image_input").val("");
        swal({
            icon: 'error',
            title: 'Formato de archivo no valido',
            text: 'Por favor solo agregue archivos con formato csv.',
            buttons: 'Aceptar',
        })

    }
}

function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $("#image_input").val("");
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
    $('.image-title').html('Ningún archivo cargado');
}
$('.image-upload-wrap').bind('dragover', function() {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function() {
    $('.image-upload-wrap').removeClass('image-dropping');
});
