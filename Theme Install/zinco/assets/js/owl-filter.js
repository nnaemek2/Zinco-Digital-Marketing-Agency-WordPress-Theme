(function($) { "use strict";
    jQuery(document).ready(function ($) {

		$.fn.owlRemoveItem = function(num) {
			var owl_data = $(this).data('owl.carousel');

			owl_data._items = $.map(owl_data._items, function(data, index) {
				if(index != num) return data;
			})

			$(this).find('.owl-item').eq(num).remove();
		}

		$.fn.owlFilter = function(data, callback) {
			var owl = this,
				owl_data = $(owl).data('owl.carousel'),
				$elemCopy = $('<div>').css('display', 'none');

			/* check attr owl-clone exist */
			if(typeof($(owl).data('owlClone')) == 'undefined') {
				$(owl).find('.owl-item:not(.cloned)').clone().appendTo($elemCopy);
				$(owl).data('owlClone', $elemCopy);
			}else {
				$elemCopy = $(owl).data('owlClone');
			}

			/* clear content */
			owl.trigger('replace.owl.carousel', ['<div/>']);
			switch(data){
				case '*':
					$elemCopy.children().each(function() {
						owl.trigger('add.owl.carousel', [$(this).children().clone()]);
					})
					break;
				default:
					$elemCopy.find(data).each(function() {
						owl.trigger('add.owl.carousel', [$(this).clone()]);
					})
					break;
			}

			/* remove item empty when clear */
			owl.owlRemoveItem(0);
			owl.trigger('refresh.owl.carousel').trigger('to.owl.carousel', [0]);

			// callback
			if(callback) callback.call(this, owl);
		}
	});
})(jQuery);