import './backend.scss';
import jQuery from 'jquery';
//import 'classlist-polyfill';
import { map, filter, debounce } from 'lodash';

let $j = jQuery.noConflict();

// Only act on block editor
(function($, window, undefined) {
	if (typeof window.wp === 'undefined' || typeof window.wp.blocks === 'undefined') {
		return;
	}
	$(function () {

		// Hide sticky toggle
		$(window).on(`load.${window.THEME_PREFIX}`, function () {
			// For Gutenberg
			$('.edit-post-post-status .components-panel__row:contains("Stick to")').hide();
			// For classic editor
			$('#sticky-span').hide();
		});

		const $wrapper = $('body');
		const $acfGroup = $('#acf-group_5f467bc4cb553');

		if (!$acfGroup.length) {
			return;
		}

		// Inject styles for post title alterations
		$(`
			<style id="cmls-acf_post_title">
				#sticky-span { display: none !important; }
				.edit-post-visual-editor__post-title-wrapper {
					transition-property: opacity;
					transition-duration: .5s;
					opacity: 1;
					position: relative;
					color: var(--page_title-title_color);
				}
				.has-header-background .edit-post-visual-editor__post-title-wrapper {
					background-image: var(--page_title-background_image);
					background-color: var(--page_title-background_color);
					background-position: var(--page_title-background_position);
					background-repeat: var(--page_title-background_repeat);
					background-size: var(--page_title-background_size);
					margin-bottom: var(--page_title-margin_below_header);
				}
					.has-header-background .edit-post-visual-editor__post-title-wrapper .editor-post-title__block {
						padding-top: 2em;
						padding-bottom: 2em;
					}
					.has-header-background .edit-post-visual-editor__post-title-wrapper textarea {
						text-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));
					}
				.has-alt-title .edit-post-visual-editor__post-title-wrapper::before {
					background: rgba(255, 255, 0, 0.6);
					color: #000;
					content: '🥸 ALT TITLE';
				}
				.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper {
					background-color: rgba(0,0,0,0.05);
					position: relative;
					opacity: 0.5;
				}
					.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper:hover,
					.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper:focus,
					.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper:focus-within {
						opacity: 1;
					}
				.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before {
					content: '🤫 TITLE HIDDEN';
					background: rgba(0, 0, 0, 0.75);
					color: #fff;
					font-size: 0.6em;
					line-height: 1;
					text-shadow: 1px 1px 1px #000;
					padding: .5em;
					position: absolute;
					top: 0;
					left: 0;
					opacity: 1;
				}
			</style>
		`).appendTo('body');

		// ACF fields to actions
		const header_display_options = {
			'#acf-field_5f467c3c135f3': {
				'key': 'title-hidden',
				'type': 'checkbox',
				'acf': '#acf-field_5f467c3c135f3',
				'action': (checked) => {
					if (checked) {
						$wrapper.addClass('has-hidden-post-title');
						return;
					}
					$wrapper.removeClass('has-hidden-post-title');
				}
			},
			'#acf-field_5f46f4d6962ca': {
				'key': 'title-alt',
				'type': 'string',
				'acf': '#acf-field_5f46f4d6962ca',
				'action': (val) => {
					if (val && val.toString().length) {
						window.wp.data.dispatch('core/notices').createNotice(
							'info',
							'🥸 This post uses an alternate display title',
							{
								isDismissible: false,
								id: 'has-alt-title'
							}
						)
						return;
					}
					window.wp.data.dispatch('core/notices').removeNotice('has-alt-title');
				}
			},
			'acf[field_6140e29b2c51a][field_6140e2cb5b633]': {
				'key': 'background_color',
				'type': 'string',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]',
				'action': 'setCssVar',
				'triggersHasBackground': true,
			},
			'acf[field_6140e29b2c51a][field_6140e3aa5b638]': {
				'key': 'title_color',
				'type': 'string',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]',
				'action': 'setCssVar',
			},
			'acf[field_6140e29b2c51a][field_6140e95fd3f2a]': {
				'key': 'margin_below_header',
				'type': 'em',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e95fd3f2a]"]',
				'action': 'setCssVar',
			},
			'acf[field_6140e29b2c51a][field_6140e3d15b639]': {
				'key': 'title_shadow_opacity',
				'type': 'float',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e3d15b639]"]',
				'action': 'setCssVar',
			},
			'acf[field_6140e29b2c51a][field_6140e2ef5b634]': {
				'key': 'background_image',
				'type': 'file',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e2ef5b634]"]',
				'action': 'setCssVar',
				'triggersHasBackground': true
			},
			'acf[field_6140e29b2c51a][field_6140e31c5b635]': {
				'key': 'background_size',
				'type': 'string',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e31c5b635]"]',
				'action': 'setCssVar',
			},
			'acf[field_6140e29b2c51a][field_6140e3455b636]': {
				'key': 'background_position',
				'type': 'string',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e3455b636]"]',
				'action': 'setCssVar',
			},
			'acf[field_6140e29b2c51a][field_6140e38b5b637]': {
				'key': 'background_repeat',
				'type': 'string',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e38b5b637]"]',
				'action': 'setCssVar',
			}
		};

		function sanitizeDisplayOption(opt) {
			switch (opt.type) {
				case 'checkbox':
					opt.val = $(opt.acf).is(':checked');
					break;
				case 'em':
					opt.val = parseFloat(opt.val) + 'em';
					break;
				case 'string':
					opt.val = $('<div>').text(opt.val).html();
					break;
				case 'integer':
				case 'int':
					opt.val = parseInt(opt.val);
					break;
				case 'float':
					opt.val = parseFloat(opt.val);
					break;
				case 'file':
					if (wp.api?.models?.Media && opt.val && opt.val.toString().length) {
						var media = new wp.api.models.Media({ id: opt.val });
						opt.val = media.fetch();
						return new Promise(resolve => {
							media.fetch().then(media => {
								if (media.media_details?.sizes?.full?.source_url) {
									opt.val = `url("${media.media_details.sizes.full.source_url}")`;
								}
								resolve(opt);
							});
						});
					}
					break;
			}

			return new Promise(resolve => {
				resolve(opt);
			});
		}

		async function updateHeaderDisplay() {
			var opts = {};
			for (var i in header_display_options) {
				let opt = header_display_options[i];
				let $input = $(opt.acf);
				opt.val = $input.val();

				opt = await sanitizeDisplayOption(opt);

				if (typeof opt.action === 'function') {
					opt.action(opt.val);
					continue;
				}
				opts[i] = opt;
			}

			var triggersBackground = filter(opts, (opt) => {
				if (opt.triggersHasBackground && opt.val && opt.val.toString().length) {
					return opt;
				}
			});
			if (triggersBackground.length) {
				$wrapper.addClass('has-header-background');
			} else {
				$wrapper.removeClass('has-header-background');
			}

			var styles = {};
			map(opts, (opt) => {
				if (opt.action === 'setCssVar') {
					styles[`--page_title-${opt.key}`] = opt.val.toString();
				}
			});
			if (Object.keys(styles).length) {
				$wrapper.css(styles);
			}
		}

		$acfGroup.on(
			`change.${window.THEME_PREFIX} keyup.${window.THEME_PREFIX}`,
			map(header_display_options, 'acf').join(','),
			debounce(updateHeaderDisplay, 200, { trailing: true })
		);
		updateHeaderDisplay();
		$(window).on('load', updateHeaderDisplay);


	});
}($j, window.self));

import './backend/blocks/index.js';