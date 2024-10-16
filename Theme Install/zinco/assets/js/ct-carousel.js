(function($) {
    "use strict";

    $(document).ready(function () {

        setTimeout(function () {
            $('.owl-carousel').each(function() {
                var _this = $(this);
                var data = {
                    navText : ['<i class="fac fac-angle-left"></i></i>','<i class="fac fac-angle-right"></i>'],
                    responsive:{
                        0:{
                            items:parseInt($(this).attr('data-item-xs')),
                        },
                        580:{
                            items:parseInt($(this).attr('data-item-sm')),
                        },
                        768:{
                            items:parseInt($(this).attr('data-item-md')),
                        },
                        992:{
                            items:parseInt($(this).attr('data-item-lg')),
                            stagePadding:parseInt($(this).attr('data-stagepadding-lg')),
                        },
                        1200:{
                            stagePadding:parseInt($(this).attr('data-stagepadding-xl')),
                            items:parseInt($(this).attr('data-item-xl')),
                        },
                        1400:{
                            items:parseInt($(this).attr('data-item-xl')),
                            stagePadding:parseInt($(this).attr('data-stagepadding')),
                        },
                        
                    }
                };
                if(typeof _this.attr('data-loop') !== 'undefined') {
                    data.loop = _this.attr('data-loop') == 'true' ? true : false;
                }
                if(typeof _this.attr('data-autoplay') !== 'undefined') {
                    data.autoplay = _this.attr('data-autoplay') == 'true' ? true : false;
                }
                if(typeof _this.attr('data-bullets') !== 'undefined') {
                    data.dots = _this.attr('data-bullets') == 'true' ? true : false;
                }
                if(typeof _this.attr('data-dotscontainer') !== 'undefined') {
                    data.dotsContainer = _this.attr('data-dotscontainer') == 'true' ? _this.parents('.ct-testimonial-carousel-wrap').find('.slider-nav .thumbs') : '';
                }
                if(typeof _this.attr('data-center') !== 'undefined') {
                    data.center = _this.attr('data-center') == 'true' ? true : false;
                }
                if(typeof _this.attr('data-arrows') !== 'undefined') {
                    data.nav = _this.attr('data-arrows') == 'true' ? true : false;
                }
                if(typeof _this.attr('data-rtl') !== 'undefined') {
                    data.rtl = _this.attr('data-rtl') == 'true' ? true : false;
                }
                if(typeof _this.attr('data-margin') !== 'undefined') {
                    data.margin = parseInt(_this.attr('data-margin'));
                }
                if(typeof _this.attr('data-autoplaytimeout') !== 'undefined') {
                    data.autoplayTimeout = parseInt(_this.attr('data-autoplaytimeout'));
                }
                if(typeof _this.attr('data-smartspeed') !== 'undefined') {
                    data.smartSpeed = parseInt(_this.attr('data-smartspeed'));
                }
                
                var owl = _this.owlCarousel(data);
                var owlAnimateFilter = function(even) {
                    $(this)
                    .addClass('item-loading')
                    .delay(70 * $(this).parent().index())
                    .queue(function() {
                        $(this).dequeue().removeClass('item-loading');
                    });
                };

                _this.parent().find('.ct-carousel-filter').on('click', '.ct-filter-item', function(e) {
                    var filter_data = $(this).attr('data-filter');
                    if($(this).hasClass('ct-filter-active')) return;
                    $(this).addClass('ct-filter-active').siblings().removeClass('ct-filter-active');
                    owl.owlFilter(filter_data, function(_owl) {
                        $(_owl).find('.ct-item').each(owlAnimateFilter);
                    });
                });

                $('.owl-carousel .btn-video').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,

                    fixedContentPos: false
                });

            });
        }, 300);

        $(document).find('.ct-carousel-nav').on('click', '.ct-nav-prev', function (e) {
            var _this = $(this);
            _this.parents('.owl-carousel').find('.owl-nav .owl-prev').trigger('click');
        });

        $(document).find('.ct-carousel-nav').on('click', '.ct-nav-next', function (e) {
            var _this = $(this);
            _this.parents('.owl-carousel').find('.owl-nav .owl-next').trigger('click');
        });

    });
}(jQuery));