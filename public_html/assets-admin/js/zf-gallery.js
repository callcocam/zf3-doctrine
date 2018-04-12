var fileCollection = new Array();
var countFiles = 0;
var options;
var countForms = 0;
(function (jQuery) {
    zfGallery = function (files, option) {
        var defaults = {
            selector: "#images-to-upload",
            countFiles: ".apload-all-result",
            data: {
                assets: '',
                parent: ''
            }
        };
        options = $.extend(defaults, option);
        atualiza();
        $.each(files, function (i, file) {
            countFiles = (countFiles + 1);
            fileCollection.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                jQuery.ajax({
                    url: options.url,
                    data: options.data,
                    beforeSend: function () {
                        $(options.selector).append('<div class="processing" style="display: block"></div>').fadeIn(100);
                    },
                    success: function (template) {
                        $('.processing').fadeOut(100, function () {
                            $(this).remove();

                        });
                        $(options.selector).append(template.replace('assets_images', e.target.result));

                        $('.upload-all').removeClass('disabled').attr('disabled', false);

                    },
                    dataType: 'html'
                })
           };


        });
         $(options.countFiles).text(countFiles);

    };
    zfGalleryList = function (option) {
        var defaults = {
            selector: "#images-to-upload",
            countFiles: ".apload-all-result",
            data: {
                assets: '',
                parent: ''
            }
        };
        options = $.extend(defaults, option);
        jQuery.ajax({
            url: options.url,
            data: options.data,
            beforeSend: function () {
                $(options.selector).append('<div class="processing" style="display: block"></div>').fadeIn(100);
            },
            success: function (template) {
                $('.processing').fadeOut(100, function () {
                    $(this).remove();
                    $(options.selector).html(template);
                    atualiza();
                    editarForm();
                });


            },
            type: 'post',
            dataType: 'html'
        })
    };

    zfGalleryDelete = function ($this) {
        jQuery.ajax({
            url: $this.attr('href'),
            beforeSend: function () {
                $(options.selector).append('<div class="processing" style="display: block"></div>').fadeIn(100);
            },
            success: function (template) {
                $('.processing').fadeOut(100, function () {
                    $(this).remove();
                    $(options.selector).html(template);
                    editarForm();
                    atualiza();
                });
            },
            dataType: 'html'
        })
    };
    $(document).on('click', ".gall-delete", function () {
        zfGalleryDelete($(this));
        return false;
    })



})(jQuery);

function uploadImage($form) {
    $form.find('.progress-bar').removeClass('progress-bar-success')
        .removeClass('progress-bar-danger');
    var formdata = new FormData($form[0]); //formelement
    var request = new XMLHttpRequest();
    //progress event...
    request.upload.addEventListener('progress', function (e) {
        var percent = Math.round(e.loaded / e.total * 100);
        $form.find('.progress-bar').width(percent + '%').html(percent + '%');
    });
    var index = $form.index();
    formdata.append('file', fileCollection[index]);

    //progress completed load event
    request.addEventListener('load', function (e) {
        var _response = e.target.response;
        if (_response.result) {
            $form.find('.progress-bar').addClass('progress-bar-success').html('upload completed....');
            carrega($form, e.target.response.id);
        }
        else {
            $form.find('.progress-bar').addClass('progress-bar-danger').html('upload error....');
        }
        if (!$('.ajax-gallery-upload').length) {
            $('.upload-all').addClass('disabled').attr('disabled', true);
            $(options.countFiles).text("00");
            countFiles = 0;
        }

    });
    request.responseType = 'json';
    request.open('post', $form.attr('action').replace('save', 'upload'));
    request.send(formdata);
    //append the file relation to index

}

function carrega($form, id) {
    $.ajax({
        beforeSend: function () {
            $form.append('<div class="processing" style="display: block"></div>');
        },
        url: options.url.replace('view', 'galeria-create/id').replace('id', id),
        success: function (data) {
            $form.html(data);
            $form.on('click', ".gall-delete", function () {
                zfGalleryDelete($(this));
                return false;
            })
            $form.removeClass('ajax-gallery-upload').addClass('ajax-gallery');
            atualiza();
            editarForm()
        }
    });
}

function editarForm() {
    $('.ajax-gallery').ajaxForm({
        beforeSubmit: function (formData, jqForm) {
            $(jqForm).append('<div class="processing" style="display: block"></div>');
        }, // pre-submit callback
        success: function (responseText, statusText, xhr, $form) {

            $('.processing').fadeOut(100, function () {
                $(this).remove();
                $($form).html(responseText);
                $($form).on('click', ".gall-delete", function () {
                    zfGalleryDelete($(this));
                    return false;
                })
                atualiza();
            });


        }, // post-submit callback
        type: 'post', // 'get' or 'post', override for form's 'method' attribute
        dataType: 'html' // 'xml', 'script', or 'json' (expected server response type)
    });
}

function atualiza() {
    fileCollection = new Array();
    $('.ajax-gallery').each(function (i) {
        fileCollection.push($(this).index());
    })
    console.log(fileCollection);
}
