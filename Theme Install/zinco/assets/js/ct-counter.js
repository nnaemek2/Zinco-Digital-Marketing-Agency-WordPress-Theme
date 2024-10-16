jQuery(function($) {
	"use strict";
	$(".ct-counter-digit").each(
		function() {
			"use strict";
			var options = {
				useEasing : true,
				useGrouping : ($(this).attr('data-grouping')) == '1' ? true : false,
				separator : $(this).attr('data-separator'),
				decimal : '.'
			}
			var digit = $(this).attr("data-digit");
			var prefix = $(this).attr("data-prefix");
			var suffix = $(this).attr("data-suffix");
			if (prefix != undefined) {
				options.prefix = prefix;
			}
			if (suffix != undefined) {
				options.suffix = suffix;
			}
			var random = 0;
			if ($(this).attr("data-type") == 'random') {
				var random = Math.floor(Math.random() * digit * 2);
			}
			$(this).waypoint(
				function() {
					var count = new countUp($(this).attr("id"), random,
							digit, 0, 0, options);
					count.start();
				}, {
					offset : '95%',
					triggerOnce : true
				});
		});
});
