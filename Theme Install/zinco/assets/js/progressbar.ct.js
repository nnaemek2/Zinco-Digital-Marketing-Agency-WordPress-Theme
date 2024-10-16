jQuery(function($) {
	"use strict";
	$(".progress-bar").each(function(){
		$(this).waypoint(function() {
			$(this).progressbar();
		},{
			offset: '95%',
			triggerOnce: true
		});
	});
	
});