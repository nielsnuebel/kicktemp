$(function() {
	// dropdown menu with hover
	var header = $('#header').outerHeight();
	var showTimeout = null;
	$("li.dropdown:has([data-toggle-hover])").bind({
		mouseenter: function(e) {
			if ($(window).width() > 767) {
				var $li = $(this);
				showTimeout = setTimeout(function() {
					$li.find("> ul.dropdown-menu",this).fadeIn("fast");
					$li.addClass("open");
				}, 0);
			}
		},
		mouseleave: function(e) {
			if ($(window).width() > 767) {
				clearTimeout(showTimeout);
				$(this).find("ul.dropdown-menu").hide();
				$(this).removeClass("open");
			}
		},
		click: function(e) {
			clearTimeout(showTimeout);
		}
	});

	$(".check-list ul li").prepend("<span class=\"glyphicon glyphicon-ok\"></span>");

	$(window).resize(function() {
		if ($(this).width() <= 767) {
			$(".navbar-nav li.dropdown").addClass("open").find(".dropdown-menu").show();
		}
		else {
			$(".navbar-nav li.dropdown").removeClass("open").find(".dropdown-menu").hide();
		}
		header = $('#header').outerHeight();
	}).trigger("resize");


	// collapse mobile navigation on anchor click

	// $(".navbar-collapse a[href^=#]").on("click", function(e) {
	// 	$(this).closest(".navbar-collapse").animate({ height: "0px" }, 500).removeClass("in");
	// });
	// 

	$(document).on("scroll", function() {
		var p = $(window).scrollTop();
		if(p > header) {
			$("#header").addClass("fixed")
		}
		else{
			$("#header").removeClass("fixed")
		}
	}).trigger("scroll");

	$('.back-to-top').click(function(e) {
		$('html, body').animate({scrollTop: 0}, 400);
		e.preventDefault();
	});
});