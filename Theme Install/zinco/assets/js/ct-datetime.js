;(function ($) {

    "use strict";

    $(document).ready(function () {
        $('.ct-date input').datetimepicker({
            timepicker:false,
            format:'F j, Y'
        }); 
        $('.ct-time input').datetimepicker({
            datepicker:false,
            format:'H:i'
        }); 
    });

})(jQuery);