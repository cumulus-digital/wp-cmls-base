import jQuery from 'jquery';
import debounce from 'lodash/debounce';

let $j = jQuery.noConflict();

(function ($, window, undefined) {
	function whichTransitionEvent() {
		var t,
			el = document.createElement('fakeelement');

		var transitions = {
			transition: 'transitionend',
			OTransition: 'oTransitionEnd',
			MozTransition: 'transitionend',
			WebkitTransition: 'webkitTransitionEnd',
		};

		for (t in transitions) {
			if (el.style[t] !== undefined) {
				return transitions[t];
			}
		}
	}
	var transitionEnd = whichTransitionEvent();
	var menuIsOpen = false;

	function menuOpen() {
		$('#header_menu').one(transitionEnd, function (e) {
			$(this).addClass('is-open');
		});
		$('body').addClass('menu-active');
		$('body > header .hamburger').addClass('is-active').attr({
			'aria-label': 'Close menu',
			'aria-expanded': true,
		});
		menuIsOpen = true;
	}
	function menuClose() {
		$('#header_menu').removeClass('is-open');
		$('body').removeClass('menu-active');
		$('body > header .hamburger').removeClass('is-active').attr({
			'aria-label': 'Open menu',
			'aria-expanded': false,
		});
		menuIsOpen = false;
	}

	$('html').on(
		`click.{window.THEME_PREFIX} focusin.{window.THEME_PREFIX}`,
		debounce(
			function (e) {
				const context = {
					menu: $('body > header .menu-container *'),
					hamburger: $('body > header .hamburger'),
				};

				// Close menu if click is anywhere outside menu
				if (
					!(
						context.menu.is(e.target) ||
						context.menu.has(e.target).length
					)
				) {
					menuClose();
					return;
				}

				// Close menu if open and click is on hamburger
				if (
					(context.hamburger.is(e.target) ||
						context.hamburger.has(e.target).length) &&
					menuIsOpen
				) {
					menuClose();
					context.hamburger.blur();
					return;
				}

				menuOpen();
			},
			200,
			{ leading: true, trailing: false }
		)
	);
})($j, window.self);
