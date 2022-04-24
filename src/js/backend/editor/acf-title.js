/**
 * Dynamically represent changes to the post title in ACF options
 */

import jQuery from 'jquery';
import { debounce } from 'lodash';
import { colord, extend } from 'colord';
import a11yPlugin from 'colord/plugins/a11y';

(function ($, window, undefined) {
	// Only operate in the editor
	if (!window?.wp?.blocks) {
		return;
	}

	extend([a11yPlugin]);

	function setupEditor() {
		function getContext(BOTH) {
			return $(window.document.body).add(
				$('iframe[name="editor-canvas"]').contents().find('body')
			);
		}

		// Setup for our custom display options in ACF
		const $acfGroup = $('#acf-group_5f467bc4cb553');
		if ($acfGroup.length) {
			// ACF display option styles
			getContext().append(`
				<style id="cmls-acf_post_title">
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
						margin-top: 0;
						padding-top: calc(var(--page_title-padding, 2rem) + .25em);
						padding-bottom: calc(var(--page_title-padding, 2rem) + .25em);
					}
						.has-header-background .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {
							text-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));
						}
					.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before,
					.has-alt-title .edit-post-visual-editor__post-title-wrapper::before {
						display: inline-block;
						/*background: rgba(0, 0, 0, 0.75);*/
						color: #fff;
						font-size: 1em;
						line-height: 1;
						/*text-shadow: 1px 1px 1px #000;*/
						padding: .5rem;
						opacity: 1;
						position: absolute;
						left: 0;
						top: 0;
					}
					.has-alt-title .edit-post-visual-editor__post-title-wrapper::before {
						content: '🥸';
					}
					.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before {
						content: '🤫';
					}
					.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input,
					.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {
						background-color: rgba(0,0,0,0.07);
						position: relative;
						opacity: 0.5;
					}
						.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,
						.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,
						.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within,
						.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,
						.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,
						.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within {
							opacity: 1;
						}
				</style>
			`);

			// ACF fields to actions
			const header_display_options = {
				'#acf-field_5f467c3c135f3': {
					key: 'title-hidden',
					type: 'checkbox',
					acf: '#acf-field_5f467c3c135f3',
					action: (checked) => {
						if (checked) {
							getContext().addClass('has-hidden-post-title');
							window.wp.data
								.dispatch('core/notices')
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
							.dispatch('core/notices')
							.removeNotice('has-hidden-post-title');
						getContext().removeClass('has-hidden-post-title');
					},
				},
				'#acf-field_5f46f4d6962ca': {
					key: 'title-alt',
					type: 'string',
					acf: '#acf-field_5f46f4d6962ca',
					action: (val) => {
						if (val && val.toString().length) {
							getContext().addClass('has-alt-title');
							window.wp.data
								.dispatch('core/notices')
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
							.dispatch('core/notices')
							.removeNotice('has-alt-title');
						getContext().removeClass('has-alt-title');
					},
				},
				'acf[field_6140e29b2c51a][field_6140e2cb5b633]': {
					key: 'background_color',
					type: 'string',
					acf: 'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]',
					action: 'setCssVar',
					triggersHasBackground: true,
					triggersContextCheck: true,
				},
				'acf[field_6140e29b2c51a][field_6140e3aa5b638]': {
					key: 'title_color',
					type: 'string',
					acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]',
					action: 'setCssVar',
					triggersContextCheck: true,
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
			};

			function sanitizeDisplayOption(opt) {
				switch (opt.type) {
					case 'checkbox':
						opt.val = $(opt.acf).is(':checked');
						break;
					case 'em':
						opt.val = parseFloat(opt.val) + 'em';
						break;
					case 'rem':
						opt.val = parseFloat(opt.val) + 'rem';
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
						if (
							wp.api?.models?.Media &&
							opt.val &&
							opt.val.toString().length
						) {
							var media = new wp.api.models.Media({
								id: opt.val,
							});
							opt.val = media.fetch();
							return new Promise((resolve) => {
								media.fetch().then((media) => {
									if (
										media.media_details?.sizes?.full
											?.source_url
									) {
										opt.val = `url("${media.media_details.sizes.full.source_url}")`;
									}
									resolve(opt);
								});
							});
						}
						break;
				}

				return new Promise((resolve) => {
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

				const triggersBackground = [];
				const triggersContrastCheck = [];
				const styles = {};
				Object.values(opts).forEach((opt) => {
					if (opt.val && opt.val.toString().length) {
						if (opt.triggersHasBackground) {
							triggersBackground.push(opt);
						}
						if (opt.triggersContextCheck) {
							triggersContrastCheck.push(opt);
						}
					}
					if (opt.action === 'setCssVar') {
						styles[`--page_title-${opt.key}`] = opt.val.toString();
					}
				});

				if (triggersBackground.length) {
					getContext().addClass('has-header-background');
				} else {
					getContext().removeClass('has-header-background');
				}

				if (triggersContrastCheck.length) {
					const textColor =
						opts['acf[field_6140e29b2c51a][field_6140e3aa5b638]'];
					const bgColor =
						opts['acf[field_6140e29b2c51a][field_6140e2cb5b633]'];
					const isReadable = colord(textColor.val).isReadable(
						bgColor.val,
						{ level: 'AA', size: 'large' }
					);
					if (!isReadable) {
						console.log('trigger notice');
						wp.data
							.dispatch('core/notices')
							.createWarningNotice(
								"This header's color combination may be difficult to read!",
								{
									id: 'cmls-a11y-warning',
									isDismissible: false,
								}
							);
					} else {
						wp.data
							.dispatch('core/notices')
							.removeNotice('cmls-a11y-warning');
					}
				}

				if (Object.keys(styles).length) {
					getContext().css(styles);
				}
			}

			$acfGroup.on(
				`change.${window.THEME_PREFIX} keyup.${window.THEME_PREFIX}`,
				Object.values(header_display_options)
					.map((opt) => opt.acf)
					.join(','),
				debounce(updateHeaderDisplay, 200, { trailing: true })
			);
			updateHeaderDisplay();
			$(window).on('load', updateHeaderDisplay);
		}
	}

	if (window._wpLoadBlockEditor) {
		window._wpLoadBlockEditor.then(setupEditor);
	} else {
		$(setupEditor);
	}
})(jQuery.noConflict(), window.self);
