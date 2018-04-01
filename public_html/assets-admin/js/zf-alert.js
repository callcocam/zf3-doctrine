(function (jQuery) {
    zfAlert = function (message, type) {
        var defaults = {
            message: "Alert",
            type: "info"
        };
        var options = $.extend(defaults, {
            message: message,
            type: type
        });
        console.log(options.type);
        switch (options.type) {
            case "alert":
                toastr.info(options.message);
                break;
            case "information":
                toastr.info(options.message);
                break;
            case "success":
                toastr.success(options.message);
                break;
            case "warning":
                toastr.warning(options.message);
                break;
            case "error":
                toastr.error(options.message);
                break;
        }

    };
    zfRedirect = function (url, time) {

        var defaults = {
            time: 3000
        };
        var options = $.extend(defaults, {
            href: url,
            time: time
        });
        setTimeout(function () {
            window.location.href = options.href;
        }, options.time);


    };
})(jQuery);
