import jQuery from 'jquery';

let $j = jQuery.noConflict();

(function($, window, undefined) {

	function whichTransitionEvent(){
		var t,
		el = document.createElement("fakeelement");

		var transitions = {
			"transition"      : "transitionend",
			"OTransition"     : "oTransitionEnd",
			"MozTransition"   : "transitionend",
			"WebkitTransition": "webkitTransitionEnd"
		}

		for (t in transitions){
			if (el.style[t] !== undefined){
				return transitions[t];
			}
		}
	}
	var transitionEnd = whichTransitionEvent();
	var menuOpenState = false;

	function menuOpen() {
		$('#header_menu').one(transitionEnd, function(e) {
			$(this).addClass('is-open');
		});
		$('body').addClass('menu-active');
		$('body > header .hamburger')
			.addClass('is-active')
			.attr({
				'aria-label': 'Close menu',
				'aria-expanded': true
			});
		menuOpenState = true;
	}
	function menuClose() {
		$('#header_menu').removeClass('is-open');
		$('body').removeClass('menu-active');
		$('body > header .hamburger')
			.removeClass('is-active')
			.attr({
				'aria-label': 'Open menu',
				'aria-expanded': false
			});
		menuOpenState = false;
	}

	$('.hamburger').click(function(e) {
		e.stopPropagation()
		if (menuOpenState) {
			menuClose();
			return;
		}
		menuOpen();
	});
	$('html').click(function(e) {
		if (menuOpenState) {
			menuClose();
		}
	});

}($j, window.self));