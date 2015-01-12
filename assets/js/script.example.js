jQuery('document').ready(function(){
});
jQuery(window).load(function(){
	jQuery('body').stickfooter();
});

jQuery(window).scroll(function() {
	var scroll = jQuery(window).scrollTop();

	if (scroll >= 89) {
		jQuery("#main-nav").addClass("scrollnav");
	} else {
		jQuery("#main-nav").removeClass("scrollnav");
	}
});


$.fn.stickfooter = function() {

	var el = $(this);
	var wrap = el.outerHeight();

	$(window).bind('resize.stickfooter', function() {
		check(wrap);
	});
	function check() {
		var footerouter = jQuery('footer').outerHeight();
		var contentheight = footerouter+20;
		jQuery('body').css('margin-bottom',(contentheight)+'px');
	}



	check(wrap);
};

$.fn.autoheight = function(options) {

	var el = $(this);
	var opt = $.extend({
		element: ".headertop",
		check: ".headertext"
	}, options );

	$(window).bind('resize.autoheight', function() {
		setheight()
	});

	function setheight() {
		var theheight = el.outerHeight();
		var elementheight = jQuery(opt.element).outerHeight();
		var checkheight = jQuery(opt.check).outerHeight();

		if(theheight > checkheight){
			jQuery(opt.element).css('height',(theheight)+'px');
		}
		else {
			jQuery(opt.element).css('height',(checkheight)+'px');
		}
	}


	setheight();
};