$.Tiny = {};
/* --------------------
 * - Tiny Options -
 * --------------------
 * Modify these options to suit your implementation
 */
$.Tiny.options = {
    selector: 'textarea.tiny_mce',
    language: 'pt_BR',
    menubar: false,
    theme: "modern",
    height: 400,
    skin: 'lightgray',
    entity_encoding: "raw",
    theme_advanced_resizing: true,
    content_css: "/admin-lte/css/tinymce.css",
    init_instance_callback: function (editor) {
        editor.on('Change', function (e) {
            tinymce.triggerSave();
        });
    },
    plugins: [
        "image advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor media"
    ],
    toolbar: "styleselect | forecolor | backcolor | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | image | media |  outdent | indent | preview | code | fullscreen",
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: '/admin/admin/up',
    style_formats: [
        {title: 'Normal', block: 'p'},
        {title: 'Titulo 3', block: 'h3'},
        {title: 'Titulo 4', block: 'h4'},
        {title: 'Titulo 5', block: 'h5'},
        {title: 'Código', block: 'pre', classes: 'brush: php;'}
    ],
    link_class_list: [
        {title: 'None', value: ''},
        {title: 'Blue CTA', value: 'btn btn-primary'},
        {title: 'Green CTA', value: 'btn btn-success'},
        {title: 'Yellow CTA', value: 'btn btn-warning'},
        {title: 'Red CTA', value: 'btn btn-danger'}
    ]
};

jQuery.fn.zfTiny = function (url, options) {

    $.Tiny.options = $.extend($.Tiny.options, options);
    $.Tiny.options.images_upload_url = url;
    initTiny();
};
function initTiny() {
    //options.onInit();
    tinymce.remove();
    tinymce.init($.Tiny.options);

}
