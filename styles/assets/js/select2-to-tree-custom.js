(function ($) {
    // Lưu lại hàm gốc
    var oldFn = $.fn.select2ToTree;

    // Ghi đè để thêm option autoExpand
    $.fn.select2ToTree = function (options) {
        // Gộp option với mặc định
        var settings = $.extend({
            autoExpand: false
        }, options);

        // Gọi plugin gốc
        var $el = oldFn.call(this, settings);

        // Nếu bật autoExpand thì gắn sự kiện
        if (settings.autoExpand) {
            this.on('select2:open', function () {
                setTimeout(function () {
                    $(".select2-results__option[aria-expanded='false']")
                        .attr("aria-expanded", "true")
                        .show();
                }, 50);
            });
        }

        return $el;
    };
})(jQuery);
