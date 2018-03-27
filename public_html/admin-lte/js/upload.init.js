var dataModal=null;
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
    $form.ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {
            return true;
        }, // pre-submit callback
        success: function(responseText, statusText, xhr, $form) {
            if(responseText.result){
                if(responseText.location){
                    $('form[name="AjaxForm"]').find("#cover").val(responseText.location);
                    $('form[name="AjaxUploadForm"]').find("#id").val(responseText.id);
                }
                $('form[name="AjaxUploadForm"]').find("#id").val(responseText.id);
                $(".progress").fadeOut(100, function () {
                    dataModal.modal('hide');
                });
            }
        }, // post-submit callback
        uploadProgress:function(evento, posicao, total, completo) {
            var porcento = completo + '%';
            $("#upload-progress").css("width", + porcento +"%").find('span').text(porcento);
        },
        type: 'post', // 'get' or 'post', override for form's 'method' attribute
        dataType: 'json' // 'xml', 'script', or 'json' (expected server response type)
    });
}