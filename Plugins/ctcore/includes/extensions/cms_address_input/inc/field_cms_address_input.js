jQuery(function ($) {
    $(document).find('.cms-address-input').each(function () {
        var _this = $(this);
        var input = document.getElementById(_this.attr('id'));
        var autocomplete = new google.maps.places.Autocomplete(input);
    });
});