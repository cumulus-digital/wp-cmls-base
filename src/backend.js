import './backend.scss';
import jQuery from 'jquery';
import 'classlist-polyfill';

let $j = jQuery.noConflict();
(function($, window, undefined) {
    if (typeof window.wp === 'undefined' || typeof window.wp.blocks === 'undefined') {
        return;
    }
    $(function(){

        // Make it clear if the post's title is hidden
        $(`
            <style id="acf_post_title_is_hidden">
                .edit-post-visual-editor__post-title-wrapper {
                    transition-property: background-color, opacity;
                    transition-duration: .5s;
                    opacity: 1;
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
        titleToggle.on('change', function() {
            toggleTitleOpacity(this.checked);
        });
        $(window).on('load', function() {
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
        altTitle.on('change', function() {
            toggleAltTitle($(this).val() && $(this).val().length);
        });
        $(window).on('load', function() {
            toggleAltTitle(altTitle && altTitle.val() && altTitle.val().length);
        });

        // Hide sticky toggle
        $(window).on('load', function () {
            // For Gutenberg
            $('.edit-post-post-status .components-panel__row').each(function () {
                if (this.innerText.indexOf('Stick to the top of the blog') > -1) {
                    $(this).hide();
                }
            });
            // For classic editor
            $('#sticky-span').hide();
        });
    });
}($j, window.self));

import './backend/blocks/anchor.js';