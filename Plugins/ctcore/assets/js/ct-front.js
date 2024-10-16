jQuery(document).ready(function ($) {
    var _inline_css = "<style>";
    $(document).find('div.ct-inline-css').each(function () {
        var _this = $(this);
        _inline_css += _this.attr("data-css") + " ";
        _this.remove();
    });
    _inline_css += "</style>";
    $('head').append(_inline_css);
});
