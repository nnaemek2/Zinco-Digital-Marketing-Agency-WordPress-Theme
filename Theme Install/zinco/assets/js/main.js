;(function ($) {

    "use strict";

    /* ===================
     Page reload
     ===================== */
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
    $(window).on('load', function () {
        $(".ct-loader").fadeOut("slow");
        window_width = $(window).width();
        zinco_col_offset();
        zinco_header_sticky();
        zinco_scroll_to_top();
        zinco_quantity_icon();
    });
    $(window).on('resize', function () {
        window_width = $(window).width();
       zinco_col_offset();
       zinco_header_sticky();
    });

    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
       zinco_header_sticky();
       zinco_scroll_to_top();
    });

    $(document).ready(function () {

        /* =================
         Pie Chart
         =================== */
        $('.vc_pie_chart').each(function () {
            var pie_color = $(this).attr('data-pie-color');
            $(this).find('.vc_pie_chart_value').css('color', pie_color );
        });

        /* =================
         Menu Dropdown
         =================== */
        var $menu = $('.main-navigation');
        $menu.find('.primary-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu');
            if ($submenu.length == 1) {
                $(this).hover(function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                }, function () {
                    $submenu.removeClass('back');
                });
            }
        });
        /* =================
         Menu Mobile
         =================== */
        $("#main-menu-mobile .open-menu").on('click', function () {
            $(this).toggleClass('opened');
            $('.header-navigation').toggleClass('navigation-open');
            $('.menu-mobile-overlay').toggleClass('active');
            $('body').toggleClass('ovhidden');
        })

        $(".menu-mobile-close").on('click', function () {
            $(this).parents('.header-navigation').removeClass('navigation-open');
            $('.menu-mobile-overlay').removeClass('active');
            $('#main-menu-mobile .open-menu').removeClass('opened');
            $('body').removeClass('ovhidden');
        })

        $(".menu-mobile-overlay").on('click', function () {
            $(this).parents('#header-main').find('.header-navigation').removeClass('navigation-open');
            $(this).removeClass('active');
            $('#main-menu-mobile .open-menu').removeClass('opened');
            $('.header-navigation').removeClass('navigation-open');
            $('body').removeClass('ovhidden');
        })

        $(".primary-menu li a.item-one-page").on('click', function () {
            $(this).parents('.header-navigation').removeClass('navigation-open');
            $('.menu-mobile-overlay').removeClass('active');
            $('#main-menu-mobile .open-menu').removeClass('opened');
            $('.header-navigation').removeClass('navigation-open');
        })

        /* ===================
         Search Toggle
         ===================== */
        $('.h-btn-search').on('click', function (e) {
            e.preventDefault();
            $('.ct-search-popup').removeClass('remove').toggleClass('open').find('.search-field').focus();
            $('.widget_shopping_cart').removeClass('open');
            $('.ct-hidden-sidebar').removeClass('open');
        });

        $('.h-btn-sidebar').on('click', function (e) {
            e.preventDefault();
            $('.ct-hidden-sidebar').removeClass('remove').toggleClass('open');
            $('.widget_shopping_cart').removeClass('open');
        });
        
        $(document).on('click','.ct-close',function(e){
            $(this).parent().addClass('remove').removeClass('open');
            $(this).parents('.ct-modal').addClass('remove').removeClass('open');
            $(this).parent('.ct-modal').addClass('remove').removeClass('open');
            $(this).parent('.ct-hidden-sidebar').addClass('remove').removeClass('open');
            $(this).parents('body').removeClass('ovhidden');
            e.preventDefault();
        });
        $(document).on('click', function (e) {
            if (e.target.className == 'ct-modal ct-search-popup open')
                $('.ct-search-popup').removeClass('open').addClass('remove');
            if (e.target.className == 'ct-hidden-sidebar open')
                $('.ct-hidden-sidebar').removeClass('open').addClass('remove');
        });
        $(document).on('keyup',function(evt) {
            if (evt.keyCode == 27) {
               $('.ct-modal').addClass('remove').removeClass('open');
               $('.ct-hidden-sidebar').removeClass('open');
            }
        });

        /* Video 16:9 */
        $('.entry-video iframe').each(function () {
            var v_width = $(this).width();

            v_width = v_width / (16 / 9);
            $(this).attr('height', v_width + 35);
        });
        $('.entry-video .wp-video').each(function () {
            var v_width = $(this).width();

            v_width = (v_width / (16 / 9)) + 32;
            $(this).css('height', v_width + 'px');
        });
        $('.entry-video-intro .button-video').each(function () {
            $(this).on('click', function () {
                $(this).parents('.entry-video-intro').addClass('offintro');
                $(this).parents('.entry-video').find('.wp-video').addClass('onvideo');
                $(this).parents('.entry-video').find('.mejs-overlay-button').trigger('click');
            });
        });
        /* Images Light Box - Gallery:True */
        $('.site-footer .gallery').each(function () {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });


        $('.images-light-box').each(function () {
            $(this).magnificPopup({
                delegate: 'a.light-box',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });

        $('.images-light-box-carousel').each(function () {
            $(this).magnificPopup({
                delegate: '.owl-item a.light-box',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });

        $('.image-light-box').each(function () {
            $(this).magnificPopup({
                delegate: 'a.light-box',
                type: 'image',
                gallery: {
                    enabled: false
                },
                mainClass: 'mfp-fade',
            });
        });

        /* Video Light Box */
        $('.ct-video-button, .btn-video, .btn-icon-popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false
        });

        /* =================
        WooCommerce
        =================== */
        $('#review_form').find("#comment").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", "Your review *");
            }
        });

        $('.widget_product_search .search-field').find("input[type='text']").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", "Search and Press Enter");
            }
        });

        $('.widget_newsletterwidget, .ct-newsletter, form.newsletter, .newsletter-footer').each(function () {
            var email_text = $(this).find('.tnp-field-email label').text();
            $(this).find('.tnp-field-email label').remove();
            $(this).find(".tnp-email").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", email_text);
                }
            });
            var firstname_text = $(this).find('.tnp-field-firstname label').text();
            $(this).find('.tnp-field-firstname label').remove();
            $(this).find(".tnp-firstname").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", firstname_text);
                }
            });
            var lastname_text = $(this).find('.tnp-field-lastname label').text();
            $(this).find('.tnp-field-lastname label').remove();
            $(this).find(".tnp-lastname").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", lastname_text);
                }
            });
        });
        $('.widget.woocommerce').each(function () {
            $(this).find('.widget-title').on('click', function () {
                $(this).toggleClass('opened');
                $(this).parent().find('.widget-content-inner').slideToggle();
            });
        });

        $('.site-menu-right .h-btn-cart, .mobile-menu-cart .h-btn-cart').on('click', function (e) {
            e.preventDefault();
            $(this).parents('#header-wrap').find('.widget_shopping_cart').toggleClass('open');
            $('.ct-hidden-sidebar').removeClass('open');
            $('.ct-search-popup').removeClass('open');
        });

        /* ====================
         Scroll To Top
         ====================== */
        $('.ct-scroll-top').on('click', function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        $('.ct-scroll-top i').on('click', function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        /* =================
        Add Class
        =================== */
        $('.wpcf7-select').parent().addClass('wpcf7-menu');
        /* =================
         Row & VC Column Animation
         =================== */
        $('.vc_row.wpb_row.vc_row-fluid').each(function () {
            var vctime = 100;
            var vc_inner = $(this).children().length;
            var _vci = vc_inner - 1;
            $(this).find('> .wpb_animate_when_almost_visible').each(function (index, obj) {
                $(this).css('animation-delay', vctime + 'ms');
                if (_vci === index) {
                    vctime = 100;
                    _vci = _vci + vc_inner;
                } else {
                    vctime = vctime + 100;
                }
            })
        });
        $('.animation-time').each(function () {
            var vctime = 20;
            var vc_inner = $(this).children().length;
            var _vci = vc_inner - 1;
            $(this).find('> .grid-item > .wpb_animate_when_almost_visible').each(function (index, obj) {
                $(this).css('animation-delay', vctime + 'ms');
                if (_vci === index) {
                    vctime = 20;
                    _vci = _vci + vc_inner;
                } else {
                    vctime = vctime + 30;
                }
            });
        });
        $('.ct-accordion').each(function () {
            $(document).on('click', '.card-header', function () {
                var _parent = $(this).parents('.grid-item');
                _parent.css('z-index', 9999);
                setTimeout(function () {
                    _parent.css('z-index', 1);
                }, 800);
                setTimeout(function () {
                    $('.filter-item.active').trigger('click');
                }, 400);
            });
        });

        /* =================
         The clicked item should be in center in owl carousel
         =================== */
        var $owl_item = $('.owl-active-click');
        $owl_item.children().each(function (index) {
            $(this).attr('data-position', index);
        });
        $(document).on('click', '.owl-active-click .owl-item > div', function () {
            $owl_item.trigger('to.owl.carousel', $(this).data('position'));
        });

        /* =================
         Multi Select
         =================== */
        $('select:not(.country_select):not(.state_select)').each(function () {
            $(this).niceSelect();
        });

        setTimeout(function () {
            $('.bookly-form select').each(function () {
                $(this).niceSelect();
            });
        }, 1400);
        /* =================
         Woocomerce
         =================== */
        
        $('.widget_products ul li').each(function () {
            var img_h = $(this).find('img').outerHeight();
            $(this).parents('.product_list_widget').find('li').css('min-height', img_h + 'px');
        });

        var author_text = $('#review_form .comment-form-author').find('label').text();
        $('#review_form .comment-form-author').find('label').remove();
        $('#review_form .comment-form-author').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", author_text);
            }
        });
        var email_text = $('#review_form .comment-form-email').find('label').text();
        $('#review_form .comment-form-email').find('label').remove();
        $('#review_form .comment-form-email').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", email_text);
            }
        });

        var bil_first_name = $('#customer_details #billing_first_name_field').find('label').text();
        $('#customer_details #billing_first_name_field').find('label').remove();
        $('#customer_details #billing_first_name_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_first_name);
            }
        });
        var ship_first_name = $('#customer_details #shipping_first_name_field').find('label').text();
        $('#customer_details #shipping_first_name_field').find('label').remove();
        $('#customer_details #shipping_first_name_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", ship_first_name);
            }
        });

        var bil_last_name = $('#customer_details #billing_last_name_field').find('label').text();
        $('#customer_details #billing_last_name_field').find('label').remove();
        $('#customer_details #billing_last_name_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_last_name);
            }
        });
        var ship_last_name = $('#customer_details #shipping_last_name_field').find('label').text();
        $('#customer_details #shipping_last_name_field').find('label').remove();
        $('#customer_details #shipping_last_name_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", ship_last_name);
            }
        });

        var bil_company_name = $('#customer_details #billing_company_field').find('label').text();
        $('#customer_details #billing_company_field').find('label').remove();
        $('#customer_details #billing_company_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_company_name);
            }
        });
        var ship_company_name = $('#customer_details #shipping_company_field').find('label').text();
        $('#customer_details #shipping_company_field').find('label').remove();
        $('#customer_details #shipping_company_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", ship_company_name);
            }
        });

        var bil_postcode_name = $('#customer_details #billing_postcode_field').find('label').text();
        $('#customer_details #billing_postcode_field').find('label').remove();
        $('#customer_details #billing_postcode_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_postcode_name);
            }
        });
        var ship_postcode_name = $('#customer_details #shipping_postcode_field').find('label').text();
        $('#customer_details #shipping_postcode_field').find('label').remove();
        $('#customer_details #shipping_postcode_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", ship_postcode_name);
            }
        });

        var bil_city_name = $('#customer_details #billing_city_field').find('label').text();
        $('#customer_details #billing_city_field').find('label').remove();
        $('#customer_details #billing_city_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_city_name);
            }
        });
        var ship_city_name = $('#customer_details #shipping_city_field').find('label').text();
        $('#customer_details #shipping_city_field').find('label').remove();
        $('#customer_details #shipping_city_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", ship_city_name);
            }
        });

        var bil_phone_name = $('#customer_details #billing_phone_field').find('label').text();
        $('#customer_details #billing_phone_field').find('label').remove();
        $('#customer_details #billing_phone_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_phone_name);
            }
        });
        var bil_email_name = $('#customer_details #billing_email_field').find('label').text();
        $('#customer_details #billing_email_field').find('label').remove();
        $('#customer_details #billing_email_field').find("input").each(function (ev) {
            if (!$(this).val()) {
                $(this).attr("placeholder", bil_email_name);
            }
        });

        /* =================
         One Page
         =================== */
        if( $('.primary-menu > li > a').hasClass('item-one-page') ) {
            $('.primary-menu').singlePageNav({
                currentClass: 'current',
                changeHash: false,
                scrollSpeed: 1200,
                scrollThreshold: 0.5,
                filter: '.item-one-page',
                easing: 'swing',
            });
        }

        $('.primary-menu > li > .item-one-page').parent().removeClass('current-menu-item').removeClass('current_page_item');
        $('.primary-menu > li > .item-one-page').on('click', function (e) {
            var _link = $(this).attr('href');
            var _id_data = e.currentTarget.hash;
            if ($(_id_data).length !== 1) {
                window.location.href = _link;
            }
            return false;
        });

        if($('#header-wrap').hasClass('is-sticky')) {
            var offsetHeaderData = parseInt($('#header-wrap').attr('site-data-offset'));
            var offsetHeaderWrap = $('#header-wrap').outerHeight();
            if(typeof $('#header-wrap').attr('site-data-offset') !== 'undefined') {
                $('.item-one-page').parents('.site').find('.entry-content > .vc_row').attr('data-offset', offsetHeaderData);
            }
            $('.item-one-page').parents('.site').find('.entry-content > #section-home.vc_row').attr('data-offset', offsetHeaderWrap);
        }
        $('.el-btn-link').on('click', function(e) {
            var id_scroll = $(this).attr('href');
            var offsetScroll = $('#header-main').outerHeight();
            e.preventDefault();
            $("html, body").animate({ scrollTop: $(id_scroll).offset().top - offsetScroll }, 600);
        });

        /* =================
         Element
         =================== */
        $('.ctf-author-box-link').removeAttr('target');

        $('.entry-content > .vc_row').each(function () {
            var _ele_col = $(this).find(".ct-row-overlay.in-column"),
                _ele_row = $(this).find(".ct-row-overlay.in-row"),
                _col = _ele_col.parents(".vc_column-inner"),
                _row = _ele_row.parents(".wpb_column");

            _col.before(_ele_col.clone());
            _ele_col.remove();

            _row.before(_ele_row.clone());
            _ele_row.remove();

            var _el_text_below = $(this).find(".ct-row-text-below"),
                _row_text_below = _el_text_below.parents(".wpb_column");
            _row_text_below.before(_el_text_below.clone());
            _el_text_below.remove();

        });

        /* =================
         Login
         =================== */
        $('.btn-sign-up').on('click', function () {
            $(this).parents('.ct-modal-content').find('.ct-user-register').addClass('u-open').removeClass('u-close');
            $(this).parents('.ct-modal-content').find('.ct-user-login').addClass('u-close').removeClass('u-open');
        });
        $('.btn-sign-in').on('click', function () {
            $(this).parents('.ct-modal-content').find('.ct-user-login').addClass('u-open').removeClass('u-close');
            $(this).parents('.ct-modal-content').find('.ct-user-register').addClass('u-close').removeClass('u-open');
        });
        $('.btn-user').on('click', function () {
            $('.ct-user-popup').addClass('open').removeClass('remove');
        });

        /* ALL */
        $('.ct-content-scroll ').enscroll();
        setTimeout(function () {
            $('.team-holder').each(function () {
                $(this).find('.team-social-button').on('click', function () {
                    $(this).parent().addClass('show-social');
                });
            });
        }, 100);
        $('.wpcf7-textarea').parents('.input-filled').addClass('wpcf7-textarea-wrap');
        
        /* =================
         Move Angled & Overlay for Row VC
         =================== */
        $('.entry-content > .vc_row').each(function () {
            var _angled = $(this).find(".ct-angled-wrapper"),
                _row = _angled.parents(".wpb_column");
            _row.after(_angled.clone());
            _angled.remove();
        });

        $('img.wp-post-image').removeAttr('width').removeAttr('height').removeAttr('sizes');

        /* Same Height */
        $('.vc_row .col-same-height').matchHeight();
        $('#customer_login .woocommerce-form').matchHeight();

        /* Mobile Menu */
        $('.main-navigation li.menu-item-has-children > a').append('<span class="main-menu-toggle"></span>');
        $('.main-menu-toggle').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('submenu-open');
            $(this).parent().parent().find('> .sub-menu').slideToggle();
        });

        $(".pointer-open").on('click', function () {
            $(this).parent().toggleClass('open');
        })

        $('.scroll-to-content a').on('click', function(e) {
            var id_scroll = $(this).attr('href');
            e.preventDefault();
            $("html, body").animate({ scrollTop: $(id_scroll).offset().top - 0 }, 600);
        });

        $(".entry-social-share span").on('click', function () {
            $(this).toggleClass('opened');
        });

        $('.ct-pricing-layout1').each(function () {
            $(this).hover(function () {
                $(this).parents('.vc_row').find('.ct-pricing-layout1').removeClass('is-featured');
                $(this).addClass('is-featured');
            });
        });

        $('.ct-nav-carousel').parents('.vc_row').find('.ct-testimonial-layout3').addClass('nav-hide');
        $('.ct-nav-carousel .nav-prev').on('click', function(e) {
            $(this).parents('.vc_row').find('.ct-testimonial-layout3 .owl-nav .owl-prev').trigger('click');
        });
        $('.ct-nav-carousel .nav-next').on('click', function(e) {
            $(this).parents('.vc_row').find('.ct-testimonial-layout3 .owl-nav .owl-next').trigger('click');
        });

        /* =================
         One Page
         =================== */
        var current_page = $(location).attr('href');
        var prev_page = $.cookie('prev-page');
        $.cookie('prev-page', current_page, {
            expires: 30,
            path: '/'
        });
        if(typeof prev_page == undefined){
            prev_page = current_page;
        }

        $('a[href*="#"]:not([href="#"])').click(function() {
            var one_offsetScroll = $('#header-main').outerHeight();
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html,body').animate({
                  scrollTop: target.offset().top - one_offsetScroll
                }, 500);
                return false;
              }
            }
        });
        
    });

    /* =================
     Column Absolute
     =================== */
    function zinco_col_offset() {
        var w_vc_row_lg = ($('#content').width() - 1170) / 2;
        var w_vc_row_md = ($('#content').width() - 1500) / 2;
        if (window_width > 1200) {
            $('.col-offset-right > .vc_column-inner').css('padding-right', w_vc_row_lg + 'px');
            $('.col-offset-left > .vc_column-inner').css('padding-left', w_vc_row_lg + 'px');

            $('.rtl .col-offset-right > .vc_column-inner').css('padding-right', 0 + 'px');
            $('.rtl .col-offset-right > .vc_column-inner').css('padding-left', w_vc_row_lg + 'px');
            $('.rtl .col-offset-left > .vc_column-inner').css('padding-left', 0 + 'px');
            $('.rtl .col-offset-left > .vc_column-inner').css('padding-right', w_vc_row_lg + 'px');
            
            $('.col-offset-right > .col-offset-inner').css('padding-right', w_vc_row_lg + 'px');
            $('.col-offset-left > .col-offset-inner').css('padding-left', w_vc_row_lg + 'px');
        }
        if (window_width > 1560) {
            $('.col-offset-left-md > .vc_column-inner').css('padding-left', w_vc_row_md + 'px');
            $('.col-offset-right-md > .vc_column-inner').css('padding-right', w_vc_row_md + 'px');
        }
    }

    function zinco_header_sticky() {
        var offsetTop = $('#header-wrap').outerHeight();
        var h_header = $('.fixed-height').outerHeight();
        var offsetTopAnimation = offsetTop + 200;
        if($('#header-wrap').hasClass('is-sticky')) {
            if (scroll_top > offsetTopAnimation) {
                $('#header-main').addClass('h-fixed');
            } else {
                $('#header-main').removeClass('h-fixed');   
            }
        }
        if (window_width > 992) {
            $('.fixed-height').css({
                'height': h_header
            });
        }
    }

    /* ====================
     Scroll To Top
     ====================== */
    function zinco_scroll_to_top() {
        if (scroll_top < window_height) {
            $('.ct-scroll-top').addClass('off').removeClass('on');
        }
        if (scroll_top > window_height) {
            $('.ct-scroll-top').addClass('on').removeClass('off');
        }
    }

    function zinco_quantity_icon() {
        $('#content .quantity').append('<span class="quantity-icon"><i class="quantity-down zmdi zmdi-minus"></i><i class="quantity-up zmdi zmdi-plus"></i></span>');
        $('.quantity-up').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();
        });
        $('.quantity-down').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();
        });
        $('.woocommerce-cart-form .actions .button').removeAttr('disabled');
    }

    $( document ).ajaxComplete(function() {
       zinco_quantity_icon();
    });

})(jQuery);