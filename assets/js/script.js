$(function() {
	// dropdown menu with hover
	$("li.dropdown:has([data-toggle-hover])").bind({
		mouseenter: function (e) {
			if ($(window).width() > 767) {
				var $li = $(this);
				showTimeout = setTimeout(function () {
					$li.find("> ul.dropdown-menu", this).fadeIn("fast");
					$li.addClass("open");
				}, 0);
			}
		},
		mouseleave: function (e) {
			if ($(window).width() > 767) {
				clearTimeout(showTimeout);
				$(this).find("ul.dropdown-menu").hide();
				$(this).removeClass("open");
			}
		},
		click     : function (e) {
			clearTimeout(showTimeout);
		}
	});
	$(window).resize(function() {
		if ($(this).width() <= 767) {
			$(".navbar-nav li.dropdown").addClass("open").find(".dropdown-menu").show();
		}
		else {
			$(".navbar-nav li.dropdown").removeClass("open").find(".dropdown-menu").hide();
		}
	}).trigger("resize");
});