define([
    "jquery",
    "jquery/ui"
], function ($) {
    "use strict";
    $.widget('pushnotification.activatecleverpush', {
        _create: function () {
            if (this.options.script) {
                var s = document.createElement("script");
                s.src = this.options.script;
                s.async = true;
                $("head").append(s);
            }
        }
    });
    return $.pushnotification.activatecleverpush;
});
