(function ($) {
    $(document).ready(function () {

        $.fn.ct_grid_refresh = function () {
            $('.ct-grid-masonry').each(function () {
                var iso = new Isotope(this, {
                    itemSelector: '.grid-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.grid-sizer',
                    },
                    containerStyle: null,
                    stagger: 30,
                    sortBy : 'name',
                });

                var filtersElem = $(this).parent().find('.grid-filter-wrap');
                filtersElem.on('click', function (event) {
                    var filterValue = event.target.getAttribute('data-filter');
                    iso.arrange({filter: filterValue});
                });

                var filterItem = $(this).parent().find('.filter-item');
                filterItem.on('click', function (e) {
                    filterItem.removeClass('active');
                    $(this).addClass('active');
                });

                var filtersSelect = $(this).parent().find('.select-filter-wrap');
                filtersSelect.change(function() {
                    var filters = $(this).val();
                    iso.arrange({filter: filters});
                });

                var orderSelect = $(this).parent().find('.select-order-wrap');
                orderSelect.change(function() {
                    var e_order = $(this).val();
                    if(e_order == 'asc') {
                        iso.arrange({sortAscending: false});
                    }
                    if(e_order == 'des') {
                        iso.arrange({sortAscending: true});
                    }
                });

            });
        };
        setTimeout(function(){
            $('.ct-grid-masonry').imagesLoaded(function(){
                $.fn.ct_grid_refresh();
            });
        }, 300);

        $(".ct-grid .filter-item").on('click', function () {
            $(this).parents('.ct-grid').addClass('filter-click');
        })

    });
})(jQuery);