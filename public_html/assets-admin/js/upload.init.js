var dataModal = null;

//FUNCTIONS
function preview_img($form) {
    $form.change(function () {
        var input = $(this);
        var target = $("#file");
        var fileDefault = target.attr('data-cover');
        if (!input.val()) {
            target.fadeOut('fast', function () {
                $(this).attr('src', fileDefault).fadeIn('slow');
            });
            return false;
        }
        if (this.files && (this.files[0].type.match("image/jpeg") || this.files[0].type.match("image/png"))) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.fadeOut('fast', function () {
                    $(this).attr('src', e.target.result).width('100%').fadeIn('fast');
                    $('#cover-default').attr('src', e.target.result);
                });
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            target.fadeOut('fast', function () {
                $(this).attr('src', fileDefault).fadeIn('slow');
            });
            input.val('');
            return false;
        }
    });
}
function form_upload($form) {

    var bar = $('.progress-bar');
    var percent = $('.percent');
    $form.ajaxForm({
        beforeSend: function () {
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function (event, posicao, total, completo) {
            var porcento = completo + '%';
            bar.width(porcento);
            percent.html(completo);
        },
        success: function (responseText, statusText, xhr, $form) {
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
            if (responseText.result) {
                if (responseText.location) {
                    $('form[name="AjaxForm"]').find("#cover").val(responseText.location);
                    $('form[name="AjaxUploadForm"]').find("#id").val(responseText.id);
                }
                $('form[name="AjaxUploadForm"]').find("#id").val(responseText.id);
            }
        }, // post-submit callback
        complete: function (xhr) {
            dataModal.modal('hide');
        },
        type: 'post', // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json' // 'xml', 'script', or 'json' (expected server response type)
    });
}

function uploadInit(url) {
    $.ajax({
        url: url,
        success: function (data) {
            dataModal = $(data).modal({
                backdrop: false
            }).on('shown.bs.modal', function (e) {
                preview_img($('form input[name="file"]'));
                form_upload($('form[name="AjaxUploadForm"]'));
            }).on('hidden.bs.modal', function (e) {
                e.target.remove();
            })

        }
    })
}