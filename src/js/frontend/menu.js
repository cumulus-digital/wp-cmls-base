import jQuery from 'jquery';
import debounce from 'lodash/debounce';

let $j = jQuery.noConflict();

( function ( $, window, undefined ) {
	function whichTransitionEvent() {
		var t,
			el = document.createElement( 'fakeelement' );

		var transitions = {
			transition: 'transitionend',
			OTransition: 'oTransitionEnd',
			MozTransition: 'transitionend',
			WebkitTransition: 'webkitTransitionEnd',
		};

		for ( t in transitions ) {
			if ( el.style[ t ] !== undefined ) {
				return transitions[ t ];
			}
		}
	}
	var transitionEnd = whichTransitionEvent();
	var menuIsOpen = false;

	function menuOpen() {
		$( '#header_menu' ).one( transitionEnd, function ( e ) {
			$( this ).addClass( 'is-open' );
		} );
		$( 'body' ).addClass( 'menu-active' );
		$( 'body > header .hamburger' ).addClass( 'is-active' ).attr( {
			'aria-label': 'Close menu',
			'aria-expanded': true,
		} );
		$( window ).trigger( 'menu-open' );
		menuIsOpen = true;
	}
	function menuClose() {
		$( '#header_menu' ).removeClass( 'is-open' );
		$( 'body' ).removeClass( 'menu-active' );
		$( 'body > header .hamburger' )
			.removeClass( 'is-active' )
			.attr( {
				'aria-label': 'Open menu',
				'aria-expanded': false,
			} )
			.blur();
		$( window ).trigger( 'menu-close' );
		menuIsOpen = false;
	}

	$( 'html' ).on(
		`click.${ window.THEME_PREFIX }`,
		debounce(
			( e ) => {
				if ( ! e.target.matches( 'body > header *' ) && menuIsOpen ) {
					menuClose();
				} else if (
					e.target.matches(
						'.hamburger, .hamburger *, .menu-beforetext:not(:has(a)), .menu-beforetext *:not(a):not(:has(a))'
					)
				) {
					if ( menuIsOpen ) {
						menuClose();
					} else {
						menuOpen();
					}
				}
			},
			200,
			{ leading: true, trailing: false }
		)
	);
	$( 'html' ).on(
		`focusin.${ window.THEME_PREFIX }`,
		debounce(
			( e ) => {
				if (
					e.target.matches(
						'body > header .menu-container .menu *'
					) &&
					! menuIsOpen
				) {
					menuOpen();
				}
				if ( ! e.target.matches( 'body > header *' ) ) {
					menuClose();
				}
			},
			200,
			{ leading: true, trailing: false }
		)
	);

	// Close menu if escape key is pressed
	$( document ).on( `keydown.${ window.THEME_PREFIX }`, function ( e ) {
		if ( menuIsOpen && e.keyCode === 27 ) {
			menuClose();
		}
	} );
} )( $j, window.self );
