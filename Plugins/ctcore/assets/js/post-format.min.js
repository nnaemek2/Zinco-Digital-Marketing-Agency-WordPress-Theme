;( function( $ ) {
    "use strict";
    setTimeout(function () {
        $(".postbox[id*='post_format_']").css('display','none');
        if(typeof post_format !== 'undefined' && post_format.length !==''){
            $("#post_format_"+post_format).css('display','block');
        }
    },1000);
    $(document).on('click','.post-format',function () {
       $(".postbox[id*='post_format_']").css('display','none');
       $("#post_format_"+$(this).val()).css('display','block');
    });
})(jQuery);

