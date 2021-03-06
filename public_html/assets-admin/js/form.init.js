$.AdminLTE = {
    base: $("link[rel='base']").attr("href"),
};
/* --------------------
 * - AdminLTE Options -
 * --------------------
 * Modify these options to suit your implementation
 */

var dataModal = null;

function formInit() {
    $('form[name="AjaxForm"]').ajaxForm({
        beforeSubmit: showRequest, // pre-submit callback
        success: showResponse, // post-submit callback
        type: 'post', // 'get' or 'post', override for form's 'method' attribute
        dataType: 'html' // 'xml', 'script', or 'json' (expected server response type)
    });
    if ($(".upload-modal").length) {
        $('.upload-modal').click(function () {
            uploadInit($(this).attr('href'));
            return false;
        });
    }
    add();


}

// pre-submit callback
function showRequest(formData, jqForm, options) {
    if (typeof tinymce !== 'undefined') {
        tinymce.triggerSave();
    }
    $(jqForm).append('<div class="processing" style="display: block"></div>').fadeIn(100);
    return true;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form) {
    $($form).parent().html(responseText);
    plugins();
}

function uploadProgress(evento, posicao, total, completo) {
    var porcento = completo + '%';
    $('.processing p').text(porcento);
}

function add() {
    if ($(".add").length) {
        //
        $('.add').click(function (e) {
            var $this = $(this);
            $.ajax({
                url:  $(this).attr('href'),
                success: function (data) {
                    $(data).modal({
                        backdrop: false
                    }).on('shown.bs.modal', function (e) {
                        $('form[name="AjaxAddForm"]').ajaxForm({
                            beforeSubmit: function (formData, jqForm, options) {
                                if (typeof tinymce !== 'undefined') {
                                    tinymce.triggerSave();
                                }
                                $(jqForm).find('.loading').fadeIn(100);
                                return true;
                            }, // pre-submit callback
                            success: function (responseText, statusText, xhr, $form) {
                                $($form).find('.modal-dialog').html(responseText);
                                $($form).find('.loading').fadeOut(100);
                                $('form[name="AjaxForm"]').find($this.attr('data-id'))
                                    .append('<option selected value="'+$($form)
                                        .find('input[name="id"]').val()+'">'+$($form).find('input[name="name"]').val()+'</option>');
                            }, // post-submit callback
                            type: 'post', // 'get' or 'post', override for form's 'method' attribute
                            dataType: 'html' // 'xml', 'script', or 'json' (expected server response type)
                        });
                    }).on('hidden.bs.modal', function (e) {
                        e.target.remove();
                    })
                }
            })
            return false;
        });
    }
}

function plugins() {
    if ($(".real").length) {
        $(".real").formatCurrency();
        $(".real").blur(function () {
            $(".real").formatCurrency();
        });
    }

    if ($(".colorpicker-addon").length) {
        $('.colorpicker-addon').colorpicker({
            format: null
        });
    }
    if ($(".colorpicker-addon-rgba").length) {
        $('.colorpicker-addon-rgba').colorpicker({
            format: 'rgba'
        });
    }
    if ($(".datemask").length) {
        //Datemask dd/mm/yyyy
        $('.datemask').inputmask({
            "mask": "99/99/9999"
        });
    }
    if ($(".datepicker").length) {
        //Datemask dd/mm/yyyy
        //Date picker
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            startDate: new Date(2018, 01, 01),
            autoclose: true,
            clearBtn: true
        })
    }
    if ($(".phonemask").length) {
        //Datemask dd/mm/yyyy
        $('.phonemask').inputmask({
            "mask": "(99) 9999[9]-9999"
        });
    }
    if ($(".documentmask").length) {
        //Datemask dd/mm/yyyy
        $('.documentmask').inputmask({
            "mask": "999.999.999-99"
        });
    }
    if ($(".j_documentmask").length) {
        //Datemask dd/mm/yyyy
        $('.j_documentmask').inputmask({
            "mask": "99.999.999/9999-99"
        });
    }
    if ($(".j_zipcode").length) {
        //Datemask 99999-999
        $('.j_zipcode').inputmask({
            "mask": "99999-999"
        });
    }

    if ($(".datetimemask").length) {
        //Datemask dd/mm/yyyy
        $('.datetimemask').inputmask({
            "mask": "99/99/9999 99:99"
        });
    }

    if ($("#ducument").length) {
        $("#ducument").keypress(function () {
            mascaraMutuario(this, cpfCnpj)
        })
        $("#ducument").blur(function () {
            clearTimeout();
        })
    }
}