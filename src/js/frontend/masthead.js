import 'classlist-polyfill';
import throttle from 'lodash/throttle';
import jQuery from 'jquery';

let $j = jQuery.noConflict();

( function ( $, window, undefined ) {
	/**
	 * Add a bunch of events to the window object
	 * @param {array|string} events Events to add to the window object
	 * @param {function} callback Callback Function
	 * @param {number} throttleTime Time to throttle if adding a single event
	 * @param {boolean} immediateLaunch Immediately call callback function
	 */
	function windowListeners(
		events,
		callback,
		throttleTime,
		immediateLaunch
	) {
		if ( ! Array.isArray( events ) ) {
			events = [ { event: events, throttleTime: throttleTime } ];
		}
		events.forEach( function ( e ) {
			let cb = callback;
			if ( e.throttleTime ) {
				cb = throttle( callback, e.throttleTime );
			}
			$( window ).on( e.event + '.cmlsBase', cb );
			//window.addEventListener(e.event, cb);
		} );
		if ( immediateLaunch ) {
			callback();
		}
	}

	// Detect when content goes under masthead
	function detectBodyUnderMasthead() {
		let buffer = 10,
			main = document.querySelector( 'body > main' ),
			masthead = document.querySelector( 'body > .masthead' ),
			mainPos = main.getBoundingClientRect(),
			mastheadPos = masthead.getBoundingClientRect(),
			hasBeginUnderMastheadClass = document.body.classList.contains(
				'begin_under_masthead'
			),
			hasUnderMastheadClass =
				document.body.classList.contains( 'under-masthead' );
		if ( hasBeginUnderMastheadClass ) {
			buffer = mastheadPos.bottom * 2;
		}
		if (
			//mainPos.top + mastheadPos.bottom + buffer <
			//mastheadPos.top + mastheadPos.bottom
			mainPos.y + buffer <
			mastheadPos.bottom
		) {
			if ( ! hasUnderMastheadClass )
				document.body.classList.add( 'under-masthead' );
		} else if ( hasUnderMastheadClass ) {
			document.body.classList.remove( 'under-masthead' );
		}
	}
	windowListeners(
		[
			{ event: 'scroll', throttleTime: 200 },
			{ event: 'resize', throttleTime: 1000 },
			{ event: 'DOMContentLoaded' },
			{ event: 'load' },
		],
		detectBodyUnderMasthead,
		null,
		true
	);

	// Prevent masthead from getting too large or too small
	/*
	var originalMastheadHeight;
	function recalculateMastheadHeight() {
		let root = document.documentElement,
			masthead = document.querySelector( 'body > .masthead' ),
			mastheadPos = masthead.getBoundingClientRect(),
			vh = window.innerHeight / 100;

		if ( ! originalMastheadHeight ) {
			originalMastheadHeight = getComputedStyle(
				document.documentElement
			).getPropertyValue(
				'--' + window.THEME_PREFIX + '-masthead-height'
			);
		}

		if ( vh > 12 ) {
			root.style.setProperty(
				'--' + window.THEME_PREFIX + '-masthead-height',
				'90px'
			);
			return;
		}
		if ( vh < 8.3 ) {
			root.style.setProperty(
				'--' + window.THEME_PREFIX + '-masthead-height',
				'65px'
			);
			return;
		}
		root.style.setProperty(
			'--' + window.THEME_PREFIX + '-masthead-height',
			originalMastheadHeight
		);
	}
	windowListeners(
		[
			{ event: 'resize', throttleTime: 1000 },
			{ event: 'DOMContentLoaded' },
			{ event: 'load' },
		],
		recalculateMastheadHeight,
		null,
		true
	);
	setInterval( recalculateMastheadHeight, 3000 );
	*/
} )( $j, window );
