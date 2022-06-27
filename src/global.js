window.THEME_PREFIX = 'cmls_base';

// Polyfill for CSS Vars
// DEPRECATED 2022-06-27. Threshold for browser support concluded.
/*
window.self.document.addEventListener( 'DOMContentLoaded', function () {
	if ( window.self.document.body.className.indexOf( 'logged-in' ) > -1 ) {
		console.log(
			'Note: child theme CSS links should be added to the array window.additionalCssIncludes so vars may be ponyfilled!'
		);
	}
} );
function setupCssVarsPonyfill() {
	var cssIncludes = [
		'link#' + window.THEME_PREFIX + '_customizer_vars-css',
		'style#' + window.THEME_PREFIX + '_customizer_vars-inline-css',
		'link#' + window.THEME_PREFIX + '_style-css',
	];
	if ( window.self.additionalCssIncludes ) {
		cssIncludes = cssIncludes.concat( window.additionalCssIncludes );
	}
	window.self.cssVars( {
		include: cssIncludes.join( ',' ),
		rootElement: document.querySelector( 'head' ),
	} );
}
if (!window.self.CSS || !window.self.CSS.supports('color', 'var(--fake-var)')) {
	window.self.document.addEventListener('DOMContentLoaded', function () {
		var cssScr = document.createElement('script');
		cssScr.type = 'text/javascript';
		cssScr.src = 'https://cdn.jsdelivr.net/npm/css-vars-ponyfill@2';
		cssScr.onreadystatechange = setupCssVarsPonyfill;
		cssScr.onload = setupCssVarsPonyfill;

		window.self.document
			.getElementsByTagName('head')[0]
			.appendChild(cssScr);
	});
}
*/
