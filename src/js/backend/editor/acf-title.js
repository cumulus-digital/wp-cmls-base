/**
 * Dynamically represent changes to the post title in ACF options
 */
import jQuery from 'jquery';
import { debounce } from 'lodash';
import { colord, extend } from 'colord';
import a11yPlugin from 'colord/plugins/a11y';
import mixPlugin from 'colord/plugins/mix';

const { select, subscribe } = wp.data;

const $ = jQuery.noConflict();

window.acfWatchChanges = function ( config ) {
	const { group, acfFields, postTypeTest } = config;
	let firstRun = true;

	// Get editor-styles-wrapper in body and preview canvas
	this.getBasicContext = () => {
		return $( '.editor-styles-wrapper' ).add(
			$( 'iframe[name="editor-canvas"]' )
				.contents()
				.find( '.editor-styles-wrapper' )
		);
	};

	// Get a custom selector in top-level and preview convas
	this.$inContext = ( selector ) => {
		return $( selector ).add(
			$( 'iframe[name="editor-canvas"]' ).contents().find( selector )
		);
	};

	function sanitizeDisplayOption( opt ) {
		switch ( opt.type ) {
			case 'checkbox':
				opt.val = $( opt.acf ).is( ':checked' );
				break;
			case 'em':
				opt.val = parseFloat( opt.val ) + 'em';
				break;
			case 'rem':
				opt.val = parseFloat( opt.val ) + 'rem';
				break;
			case 'string':
				opt.val = $( '<div>' ).text( opt.val ).html();
				break;
			case 'integer':
			case 'int':
				opt.val = parseInt( opt.val );
				break;
			case 'float':
				opt.val = parseFloat( opt.val );
				break;
			case 'file':
				if (
					wp.api?.models?.Media &&
					opt.val &&
					opt.val.toString().length
				) {
					var media = new wp.api.models.Media( {
						id: opt.val,
					} );
					opt.val = media.fetch();
					return new Promise( ( resolve ) => {
						media.fetch().then( ( media ) => {
							if (
								media.media_details?.sizes?.full?.source_url
							) {
								opt.val = `url("${ media.media_details.sizes.full.source_url }")`;
							}
							resolve( opt );
						} );
					} );
				}
				break;
		}

		return new Promise( ( resolve ) => {
			resolve( opt );
		} );
	}

	function waitForEl( selector, jQ = false ) {
		return new Promise( ( resolve ) => {
			function check() {
				const el = jQ
					? $( selector )
					: document.querySelector( selector );
				if ( ( jQ && el.length ) || ( ! jQ && el ) ) {
					return el;
				}
				return false;
			}

			const el = check();
			if ( el ) return resolve( el );

			const wait = subscribe( () => {
				const el = check();
				if ( ! el ) return;
				resolve( el );
				wait();
			} );
		} );
	}

	function waitForAllEls( selectors, $context ) {
		return new Promise( ( resolve ) => {
			function check() {
				if ( ! Array.isArray( selectors ) ) {
					selectors = [ selectors ];
				}
				const found = $context.find( selectors.join( ',' ) );
				if ( ! found || found.length < selectors.length ) {
					return false;
				}
				return true;
			}

			if ( check() ) return resolve();

			const wait = subscribe( () => {
				if ( ! check ) return;
				resolve();
				wait();
			} );
		} );
	}

	function setupWatch() {
		// Wait for group
		waitForEl( group, true ).then( ( $acfGroup ) => {
			async function updateHeaderDisplay() {
				await waitForAllEls(
					Object.values( acfFields ).map( ( field ) => field.acf ),
					$( document.body )
				);

				var opts = [];
				for ( let field of Object.values( acfFields ) ) {
					//const field = acfFields[i];
					let $input = $( field.acf );
					field.val = $input.val();

					field = await sanitizeDisplayOption( field );

					if ( typeof field.action == 'function' ) {
						field.action( field.val );
						continue;
					}
					if (
						field.callback &&
						typeof field.callback == 'function'
					) {
						field.callback( field );
					}
					opts.push( field );
				}

				// Loop through each field and parse needs
				const triggersBackground = [],
					triggersContrastCheck = [],
					styles = {};
				opts.forEach( ( opt ) => {
					if (
						( firstRun && opt.val ) ||
						( opt.hasOwnProperty( 'oldVal' ) &&
							opt.val !== opt.oldVal )
					) {
						if ( opt.triggersHasBackground ) {
							triggersBackground.push( opt );
						}
						if ( opt.contrastCheck ) {
							triggersContrastCheck.push( opt );
						}
					}
					if ( opt.action === 'setCssVar' ) {
						styles[ `--page_title-${ opt.key }` ] =
							opt.val.toString();
					}
					opt.oldVal = opt.val;
				} );

				firstRun = false;

				if ( Object.keys( styles ).length ) {
					window.acfWatchChanges
						.$inContext( '.editor-styles-wrapper' )
						.css( styles );
				}

				// Handle any opts that trigger a header background
				if ( triggersBackground.length ) {
					const hasBackground = triggersBackground.filter(
						( opt ) => opt.val
					);
					if ( hasBackground ) {
						window.acfWatchChanges
							.$inContext( '.editor-styles-wrapper' )
							.addClass( 'has-header-background' );
					} else {
						window.acfWatchChanges
							.$inContext( '.editor-styles-wrapper' )
							.removeClass( 'has-header-background' );
					}
				}

				// Handle contrast checks
				if ( triggersContrastCheck.length ) {
					function checkContrast( thisOpt ) {
						// Must have an option to check against!
						const thatOpt =
							acfFields?.[ thisOpt.contrastCheck.against ];
						if ( ! thatOpt ) return;

						// we may need to compute styles, so let's wait until the
						// computeFrom elements are available
						waitForAllEls(
							[ thisOpt, thatOpt ].map(
								( opt ) => opt.contrastCheck.computeFrom
							),
							window.acfWatchChanges.$inContext( 'body' )
						).then( () => {
							const colors = {
								foreground: null,
								background: null,
							};
							for ( const opt of [ thisOpt, thatOpt ] ) {
								let color = opt.val;
								if ( ! opt.val ) {
									// computeFrom must always be in the editor
									const el = window.acfWatchChanges
										.$inContext( 'body' )
										.find( opt.contrastCheck.computeFrom )
										.get( 0 );
									color =
										getComputedStyle( el )[
											opt.contrastCheck.computeAttribute
										];
								}
								colors[
									opt.contrastCheck.position.toLowerCase()
								] = color;
							}

							if (
								! Object.values( colors ).filter( Boolean )
									.length
							) {
								// we've done everything we can to get these colors...
								return;
							}

							// Colors may have alpha!

							// First get actual content bg
							const contentBackground = window.acfWatchChanges
								.getBasicContext()
								.get( 0 );
							const contentBgColor = colord(
								getComputedStyle( contentBackground )
									.backgroundColor
							);

							colors.foreground = colord( colors.foreground );
							colors.background = colord( colors.background );

							// Mix each color with their background, weighted by
							// the foreground's alpha, to determine the actual
							// display color.
							const bgColor = colors.background.mix(
								contentBgColor,
								1 - colors.background.alpha()
							);
							const fgColor = colors.foreground.mix(
								bgColor,
								1 - colors.foreground.alpha()
							);

							// Now we can test if it's readable.
							const isReadable = colord( fgColor ).isReadable(
								colors.background,
								{ level: 'AA', size: 'large' }
							);

							if ( ! isReadable ) {
								wp.data
									.dispatch( 'core/notices' )
									.createWarningNotice(
										"<span style='font-size:1.15em'>🚨This page's header may be difficult to read!</span>",
										{
											id: 'cmls-a11y-warning',
											isDismissible: false,
											speak: true,
											__unstableHTML: true,
											actions: [
												{
													onClick: () => {
														window.open(
															'https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html',
															'_blank'
														);
													},
													label: 'WCAG 2.0 accessibility Guidelines, Level AA',
												},
											],
										}
									);
							} else {
								wp.data
									.dispatch( 'core/notices' )
									.removeNotice( 'cmls-a11y-warning' );
							}
						} );
					}

					triggersContrastCheck.forEach( checkContrast );
				}
			}

			$acfGroup.on(
				`change.${ window.THEME_PREFIX } keyup.${ window.THEME_PREFIX }`,
				Object.values( acfFields )
					.map( ( opt ) => opt.acf )
					.join( ',' ),
				debounce( updateHeaderDisplay, 200, { trailing: true } )
			);
			updateHeaderDisplay();
		} );
	}

	function init() {
		// Only operate in the block editor
		if ( ! window?.wp?.blocks ) {
			return;
		}

		const waitForData = subscribe( () => {
			if ( ! wp?.data?.select ) return;
			const currentPostType = wp.data
				.select( 'core/editor' )
				.getCurrentPostType();
			if ( ! currentPostType ) return;
			const postType = wp.data
				.select( 'core' )
				.getPostType( currentPostType );
			if ( ! postType ) return;

			if ( postTypeTest( postType ) ) {
				extend( [ a11yPlugin, mixPlugin ] );

				// ACF display option styles
				const editorCSS = require( './acf-title.css?raw' );
				$( function () {
					if ( ! document.querySelector( '#cmls-acf_post_title' ) ) {
						window.acfWatchChanges
							.$inContext( '.editor-styles-wrapper' )
							.prepend(
								`<style id="cmls-acf_post_title">${ editorCSS }</style>`
							);
					} else {
						console.warn(
							'Could not inject ACF display option styles'
						);
					}
				} );

				setupWatch();
			}
			waitForData();
		} );
	}

	$( () => {
		const waitForEditor = subscribe( () => {
			if ( ! select( 'core/editor' ).__unstableIsEditorReady() ) {
				return;
			}
			init();
			waitForEditor();
		} );
	} );
};
window.acfWatchChanges.getBasicContext = () => {
	return $( '.editor-styles-wrapper' ).add(
		$( 'iframe[name="editor-canvas"]' )
			.contents()
			.find( '.editor-styles-wrapper' )
	);
};
window.acfWatchChanges.$inContext = ( selector ) => {
	return $( selector ).add(
		$( 'iframe[name="editor-canvas"]' ).contents().find( selector )
	);
};

const CMLS_Base_ACF_Watcher = new acfWatchChanges( {
	postTypeTest: ( postType ) => postType.hierarchical,
	group: '#acf-group_5f467bc4cb553',
	acfFields: {
		'#acf-field_5f467c3c135f3': {
			key: 'title-hidden',
			type: 'checkbox',
			acf: '#acf-field_5f467c3c135f3',
			action: ( checked ) => {
				if ( checked ) {
					window.acfWatchChanges
						.getBasicContext()
						.addClass( 'has-hidden-post-title' );
					window.wp.data
						.dispatch( 'core/notices' )
						.createNotice(
							'info',
							"🤫 This post's title is hidden",
							{
								isDismissible: false,
								id: 'has-hidden-post-title',
							}
						);
					return;
				}
				window.wp.data
					.dispatch( 'core/notices' )
					.removeNotice( 'has-hidden-post-title' );
				window.acfWatchChanges
					.getBasicContext()
					.removeClass( 'has-hidden-post-title' );
			},
		},
		'#acf-field_5f46f4d6962ca': {
			key: 'title-alt',
			type: 'string',
			acf: '#acf-field_5f46f4d6962ca',
			action: ( val ) => {
				if ( val && val.toString().length ) {
					window.acfWatchChanges
						.getBasicContext()
						.addClass( 'has-alt-title' );
					window.wp.data
						.dispatch( 'core/notices' )
						.createNotice(
							'info',
							'🥸 This post uses an alternate display title',
							{
								isDismissible: false,
								id: 'has-alt-title',
							}
						);
					return;
				}
				window.wp.data
					.dispatch( 'core/notices' )
					.removeNotice( 'has-alt-title' );
				window.acfWatchChanges
					.getBasicContext()
					.removeClass( 'has-alt-title' );
			},
		},
		'acf[field_6140e29b2c51a][field_6140e2cb5b633]': {
			key: 'background_color',
			type: 'string',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]',
			action: 'setCssVar',
			triggersHasBackground: true,
			contrastCheck: {
				against: 'acf[field_6140e29b2c51a][field_6140e3aa5b638]',
				position: 'background',
				computeFrom: '.editor-styles-wrapper',
				computeAttribute: 'backgroundColor',
			},
		},
		'acf[field_6140e29b2c51a][field_6140e3aa5b638]': {
			key: 'title_color',
			type: 'string',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]',
			action: 'setCssVar',
			contrastCheck: {
				against: 'acf[field_6140e29b2c51a][field_6140e2cb5b633]',
				position: 'foreground',
				computeFrom: '.edit-post-visual-editor__post-title-wrapper',
				computeAttribute: 'color',
			},
		},
		'acf[field_6140e29b2c51a][field_6140e95fd3f2a]': {
			key: 'margin_below_header',
			type: 'em',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e95fd3f2a]"]',
			action: 'setCssVar',
		},
		'acf[field_6140e29b2c51a][field_6140e3d15b639]': {
			key: 'title_shadow_opacity',
			type: 'float',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3d15b639]"]',
			action: 'setCssVar',
		},
		'acf[field_6140e29b2c51a][field_6140e2ef5b634]': {
			key: 'background_image',
			type: 'file',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e2ef5b634]"]',
			action: 'setCssVar',
			triggersHasBackground: true,
		},
		'acf[field_6140e29b2c51a][field_6140e31c5b635]': {
			key: 'background_size',
			type: 'string',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e31c5b635]"]',
			action: 'setCssVar',
		},
		'acf[field_6140e29b2c51a][field_6140e3455b636]': {
			key: 'background_position',
			type: 'string',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3455b636]"]',
			action: 'setCssVar',
		},
		'acf[field_6140e29b2c51a][field_6140e38b5b637]': {
			key: 'background_repeat',
			type: 'string',
			acf: 'input[name="acf[field_6140e29b2c51a][field_6140e38b5b637]"]',
			action: 'setCssVar',
		},
		'acf[field_6140e29b2c51a][field_62648f5f80441]': {
			key: 'padding',
			type: 'rem',
			acf: 'input[name="acf[field_6140e29b2c51a][field_62648f5f80441]"]',
			action: 'setCssVar',
		},
	},
} );
