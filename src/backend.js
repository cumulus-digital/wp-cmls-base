import './backend.scss';
import jQuery from 'jquery';
import 'classlist-polyfill';

let $j = jQuery.noConflict();
(function($, window, undefined) {
	if (typeof window.wp === 'undefined' || typeof window.wp.blocks === 'undefined') {
		return;
	}
	$(function () {

		// Make it clear if the post's title is hidden
		$(`
			<style id="acf_post_title_is_hidden">
				.edit-post-visual-editor__post-title-wrapper {
					background-color: var(--page_title-background_color);
					color: var(--page_title-title_color);
					text-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));
					margin-bottom: var(--page_title-margin_below_header);
					transition-property: opacity;
					transition-duration: .5s;
					opacity: 1;
				}
					.edit-post-visual-editor__post-title-wrapper textarea {
						text-shadow: inherit;
					}
				.has_alt_title::before {
					background: rgba(255, 255, 0, 0.6);
					color: #000;
					content: 'HAS ALT TITLE';
				}
				.post_title_is_hidden {
					background-color: rgba(0,0,0,0.1);
					opacity: 0.5;
					position: relative;
				}
					.post_title_is_hidden:hover,
					.post_title_is_hidden:focus {
						opacity: 1;
					}
				.post_title_is_hidden::before {
					content: '🤫 TITLE HIDDEN';
					background: rgba(0, 0, 0, 0.6);
					color: #fff;
					font-size: 0.6em;
					padding: .25em .5em;
					position: absolute;
					top: 0;
					left: 0;
				}
			</style>
		`).appendTo('body');
		let titleToggle = $('#acf-field_5f467c3c135f3');
		function toggleTitleOpacity(hideit) {
			let title = $('.edit-post-visual-editor__post-title-wrapper');
			if (hideit) {
				title.addClass('post_title_is_hidden');
				return;
			}
			title.removeClass('post_title_is_hidden');
		}
		titleToggle.on(`change.{window.THEME_PREFIX}`, function () {
			toggleTitleOpacity(this.checked);
		});
		$(window).on(`load.{window.THEME_PREFIX}`, function () {
			toggleTitleOpacity(titleToggle.is(':checked'));
		});

		// Show a notice if the post has an alt display title
		let altTitle = $('#acf-field_5f46f4d6962ca');
		function toggleAltTitle(showit) {
			if (showit) {
				window.wp.data.dispatch('core/notices').createNotice(
					'info',
					'👀 This post uses an alternate display title',
					{
						isDismissible: false,
						id: 'has-alt-title'
					}
				)
				return;
			}
			window.wp.data.dispatch('core/notices').removeNotice('has-alt-title');
		}
		altTitle.on(`change.{window.THEME_PREFIX}`, function () {
			toggleAltTitle($(this).val() && $(this).val().length);
		});
		$(window).on(`load.{window.THEME_PREFIX}`, function () {
			toggleAltTitle(altTitle && altTitle.val() && altTitle.val().length);
		});

		// Hide sticky toggle
		$(window).on(`load.{window.THEME_PREFIX}`, function () {
			// For Gutenberg
			$('.edit-post-post-status .components-panel__row').each(function () {
				if (this.innerText.indexOf('Stick to the top of the blog') > -1) {
					$(this).hide();
				}
			});
			// For classic editor
			$('#sticky-span').hide();
		});

		// Post title color should reflect ACF options
		const header_display_options = {
			'acf[field_6140e29b2c51a][field_6140e2cb5b633]': {
				'key': 'background_color',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]'
			},
			'acf[field_6140e29b2c51a][field_6140e3aa5b638]': {
				'key': 'title_color',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]'
			},
			'acf[field_6140e29b2c51a][field_6140e95fd3f2a]': {
				'key': 'margin_below_header',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e95fd3f2a]"]'
			},
			'acf[field_6140e29b2c51a][field_6140e3d15b639]': {
				'key': 'title_shadow_opacity',
				'acf': 'input[name="acf[field_6140e29b2c51a][field_6140e3d15b639]"]'
			}
		};
		function updateHeaderDisplayOption(key, val) {
			console.log('updating', key, val);
			$('.edit-post-visual-editor__post-title-wrapper').css('--page_title-' + key, val + (key.indexOf('margin') > -1 ? 'em' : ''));
		}
		for (var i in header_display_options) {
			$(header_display_options[i].acf).on(`change.{window.THEME_PREFIX}`, function () {
				let $this = $(this);
				updateHeaderDisplayOption(
					header_display_options[$this.attr('name')].key,
					$(this).val()
				);
			});
		}
		$(function () {
			for (var i in header_display_options) {
				let opt = $(header_display_options[i].acf);
				if (opt.length && opt.val()) {
					updateHeaderDisplayOption(header_display_options[i].key, opt.val());
				}
			}
		});


	});
}($j, window.self));

import './backend/blocks/index.js';