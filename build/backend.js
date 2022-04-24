/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/backend/editor/acf-title.js":
/*!********************************************!*\
  !*** ./src/js/backend/editor/acf-title.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/asyncToGenerator */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/regenerator */ "@babel/runtime/regenerator");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var colord__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! colord */ "./node_modules/colord/index.mjs");
/* harmony import */ var colord_plugins_a11y__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! colord/plugins/a11y */ "./node_modules/colord/plugins/a11y.mjs");



/**
 * Dynamically represent changes to the post title in ACF options
 */





(function ($, window, undefined) {
  var _window$wp;

  // Only operate in the editor
  if (!(window !== null && window !== void 0 && (_window$wp = window.wp) !== null && _window$wp !== void 0 && _window$wp.blocks)) {
    return;
  }

  (0,colord__WEBPACK_IMPORTED_MODULE_4__.extend)([colord_plugins_a11y__WEBPACK_IMPORTED_MODULE_5__["default"]]);

  function setupEditor() {
    function getContext(BOTH) {
      return $(window.document.body).add($('iframe[name="editor-canvas"]').contents().find('body'));
    } // Setup for our custom display options in ACF


    var $acfGroup = $('#acf-group_5f467bc4cb553');

    if ($acfGroup.length) {
      var sanitizeDisplayOption = function sanitizeDisplayOption(opt) {
        var _wp$api, _wp$api$models;

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
            if ((_wp$api = wp.api) !== null && _wp$api !== void 0 && (_wp$api$models = _wp$api.models) !== null && _wp$api$models !== void 0 && _wp$api$models.Media && opt.val && opt.val.toString().length) {
              var media = new wp.api.models.Media({
                id: opt.val
              });
              opt.val = media.fetch();
              return new Promise(function (resolve) {
                media.fetch().then(function (media) {
                  var _media$media_details, _media$media_details$, _media$media_details$2;

                  if ((_media$media_details = media.media_details) !== null && _media$media_details !== void 0 && (_media$media_details$ = _media$media_details.sizes) !== null && _media$media_details$ !== void 0 && (_media$media_details$2 = _media$media_details$.full) !== null && _media$media_details$2 !== void 0 && _media$media_details$2.source_url) {
                    opt.val = "url(\"".concat(media.media_details.sizes.full.source_url, "\")");
                  }

                  resolve(opt);
                });
              });
            }

            break;
        }

        return new Promise(function (resolve) {
          resolve(opt);
        });
      };

      var updateHeaderDisplay = /*#__PURE__*/function () {
        var _ref = (0,_babel_runtime_helpers_asyncToGenerator__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default().mark(function _callee() {
          var opts, i, opt, $input, triggersBackground, triggersContrastCheck, styles, textColor, bgColor, isReadable;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default().wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  opts = {};
                  _context.t0 = _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_1___default().keys(header_display_options);

                case 2:
                  if ((_context.t1 = _context.t0()).done) {
                    _context.next = 16;
                    break;
                  }

                  i = _context.t1.value;
                  opt = header_display_options[i];
                  $input = $(opt.acf);
                  opt.val = $input.val();
                  _context.next = 9;
                  return sanitizeDisplayOption(opt);

                case 9:
                  opt = _context.sent;

                  if (!(typeof opt.action === 'function')) {
                    _context.next = 13;
                    break;
                  }

                  opt.action(opt.val);
                  return _context.abrupt("continue", 2);

                case 13:
                  opts[i] = opt;
                  _context.next = 2;
                  break;

                case 16:
                  triggersBackground = [];
                  triggersContrastCheck = [];
                  styles = {};
                  Object.values(opts).forEach(function (opt) {
                    if (opt.val && opt.val.toString().length) {
                      if (opt.triggersHasBackground) {
                        triggersBackground.push(opt);
                      }

                      if (opt.triggersContextCheck) {
                        triggersContrastCheck.push(opt);
                      }
                    }

                    if (opt.action === 'setCssVar') {
                      styles["--page_title-".concat(opt.key)] = opt.val.toString();
                    }
                  });

                  if (triggersBackground.length) {
                    getContext().addClass('has-header-background');
                  } else {
                    getContext().removeClass('has-header-background');
                  }

                  if (triggersContrastCheck.length) {
                    textColor = opts['acf[field_6140e29b2c51a][field_6140e3aa5b638]'];
                    bgColor = opts['acf[field_6140e29b2c51a][field_6140e2cb5b633]'];
                    isReadable = (0,colord__WEBPACK_IMPORTED_MODULE_4__.colord)(textColor.val).isReadable(bgColor.val, {
                      level: 'AA',
                      size: 'large'
                    });

                    if (!isReadable) {
                      console.log('trigger notice');
                      wp.data.dispatch('core/notices').createWarningNotice("This header's color combination may be difficult to read!", {
                        id: 'cmls-a11y-warning',
                        isDismissible: false
                      });
                    } else {
                      wp.data.dispatch('core/notices').removeNotice('cmls-a11y-warning');
                    }
                  }

                  if (Object.keys(styles).length) {
                    getContext().css(styles);
                  }

                case 23:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee);
        }));

        return function updateHeaderDisplay() {
          return _ref.apply(this, arguments);
        };
      }();

      // ACF display option styles
      getContext().append("\n\t\t\t\t<style id=\"cmls-acf_post_title\">\n\t\t\t\t\t.edit-post-visual-editor__post-title-wrapper {\n\t\t\t\t\t\ttransition-property: opacity;\n\t\t\t\t\t\ttransition-duration: .5s;\n\t\t\t\t\t\topacity: 1;\n\t\t\t\t\t\tposition: relative;\n\t\t\t\t\t\tcolor: var(--page_title-title_color);\n\t\t\t\t\t}\n\t\t\t\t\t.has-header-background .edit-post-visual-editor__post-title-wrapper {\n\t\t\t\t\t\tbackground-image: var(--page_title-background_image);\n\t\t\t\t\t\tbackground-color: var(--page_title-background_color);\n\t\t\t\t\t\tbackground-position: var(--page_title-background_position);\n\t\t\t\t\t\tbackground-repeat: var(--page_title-background_repeat);\n\t\t\t\t\t\tbackground-size: var(--page_title-background_size);\n\t\t\t\t\t\tmargin-bottom: var(--page_title-margin_below_header);\n\t\t\t\t\t\tmargin-top: 0;\n\t\t\t\t\t\tpadding-top: calc(var(--page_title-padding, 2rem) + .25em);\n\t\t\t\t\t\tpadding-bottom: calc(var(--page_title-padding, 2rem) + .25em);\n\t\t\t\t\t}\n\t\t\t\t\t\t.has-header-background .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\t\t\t\t\t\t\ttext-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));\n\t\t\t\t\t\t}\n\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before,\n\t\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper::before {\n\t\t\t\t\t\tdisplay: inline-block;\n\t\t\t\t\t\t/*background: rgba(0, 0, 0, 0.75);*/\n\t\t\t\t\t\tcolor: #fff;\n\t\t\t\t\t\tfont-size: 1em;\n\t\t\t\t\t\tline-height: 1;\n\t\t\t\t\t\t/*text-shadow: 1px 1px 1px #000;*/\n\t\t\t\t\t\tpadding: .5rem;\n\t\t\t\t\t\topacity: 1;\n\t\t\t\t\t\tposition: absolute;\n\t\t\t\t\t\tleft: 0;\n\t\t\t\t\t\ttop: 0;\n\t\t\t\t\t}\n\t\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper::before {\n\t\t\t\t\t\tcontent: '\uD83E\uDD78';\n\t\t\t\t\t}\n\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before {\n\t\t\t\t\t\tcontent: '\uD83E\uDD2B';\n\t\t\t\t\t}\n\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input,\n\t\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\t\t\t\t\t\tbackground-color: rgba(0,0,0,0.07);\n\t\t\t\t\t\tposition: relative;\n\t\t\t\t\t\topacity: 0.5;\n\t\t\t\t\t}\n\t\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within,\n\t\t\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t\t\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t\t\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within {\n\t\t\t\t\t\t\topacity: 1;\n\t\t\t\t\t\t}\n\t\t\t\t</style>\n\t\t\t"); // ACF fields to actions

      var header_display_options = {
        '#acf-field_5f467c3c135f3': {
          key: 'title-hidden',
          type: 'checkbox',
          acf: '#acf-field_5f467c3c135f3',
          action: function action(checked) {
            if (checked) {
              getContext().addClass('has-hidden-post-title');
              window.wp.data.dispatch('core/notices').createNotice('info', "🤫 This post's title is hidden", {
                isDismissible: false,
                id: 'has-hidden-post-title'
              });
              return;
            }

            window.wp.data.dispatch('core/notices').removeNotice('has-hidden-post-title');
            getContext().removeClass('has-hidden-post-title');
          }
        },
        '#acf-field_5f46f4d6962ca': {
          key: 'title-alt',
          type: 'string',
          acf: '#acf-field_5f46f4d6962ca',
          action: function action(val) {
            if (val && val.toString().length) {
              getContext().addClass('has-alt-title');
              window.wp.data.dispatch('core/notices').createNotice('info', '🥸 This post uses an alternate display title', {
                isDismissible: false,
                id: 'has-alt-title'
              });
              return;
            }

            window.wp.data.dispatch('core/notices').removeNotice('has-alt-title');
            getContext().removeClass('has-alt-title');
          }
        },
        'acf[field_6140e29b2c51a][field_6140e2cb5b633]': {
          key: 'background_color',
          type: 'string',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]',
          action: 'setCssVar',
          triggersHasBackground: true,
          triggersContextCheck: true
        },
        'acf[field_6140e29b2c51a][field_6140e3aa5b638]': {
          key: 'title_color',
          type: 'string',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]',
          action: 'setCssVar',
          triggersContextCheck: true
        },
        'acf[field_6140e29b2c51a][field_6140e95fd3f2a]': {
          key: 'margin_below_header',
          type: 'em',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e95fd3f2a]"]',
          action: 'setCssVar'
        },
        'acf[field_6140e29b2c51a][field_6140e3d15b639]': {
          key: 'title_shadow_opacity',
          type: 'float',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3d15b639]"]',
          action: 'setCssVar'
        },
        'acf[field_6140e29b2c51a][field_6140e2ef5b634]': {
          key: 'background_image',
          type: 'file',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e2ef5b634]"]',
          action: 'setCssVar',
          triggersHasBackground: true
        },
        'acf[field_6140e29b2c51a][field_6140e31c5b635]': {
          key: 'background_size',
          type: 'string',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e31c5b635]"]',
          action: 'setCssVar'
        },
        'acf[field_6140e29b2c51a][field_6140e3455b636]': {
          key: 'background_position',
          type: 'string',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e3455b636]"]',
          action: 'setCssVar'
        },
        'acf[field_6140e29b2c51a][field_6140e38b5b637]': {
          key: 'background_repeat',
          type: 'string',
          acf: 'input[name="acf[field_6140e29b2c51a][field_6140e38b5b637]"]',
          action: 'setCssVar'
        },
        'acf[field_6140e29b2c51a][field_62648f5f80441]': {
          key: 'padding',
          type: 'rem',
          acf: 'input[name="acf[field_6140e29b2c51a][field_62648f5f80441]"]',
          action: 'setCssVar'
        }
      };
      $acfGroup.on("change.".concat(window.THEME_PREFIX, " keyup.").concat(window.THEME_PREFIX), Object.values(header_display_options).map(function (opt) {
        return opt.acf;
      }).join(','), (0,lodash__WEBPACK_IMPORTED_MODULE_3__.debounce)(updateHeaderDisplay, 200, {
        trailing: true
      }));
      updateHeaderDisplay();
      $(window).on('load', updateHeaderDisplay);
    }
  }

  if (window._wpLoadBlockEditor) {
    window._wpLoadBlockEditor.then(setupEditor);
  } else {
    $(setupEditor);
  }
})(jquery__WEBPACK_IMPORTED_MODULE_2___default().noConflict(), window.self);

/***/ }),

/***/ "./src/js/backend/editor/index.js":
/*!****************************************!*\
  !*** ./src/js/backend/editor/index.js ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _post_author_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./post-author.js */ "./src/js/backend/editor/post-author.js");
/* harmony import */ var _acf_title_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./acf-title.js */ "./src/js/backend/editor/acf-title.js");



(function () {
  var _window, _window$wp;

  // Only operate in the editor
  if (!((_window = window) !== null && _window !== void 0 && (_window$wp = _window.wp) !== null && _window$wp !== void 0 && _window$wp.blocks)) {
    return;
  } // Hide the sticky option, force it false


  var styles = document.createElement('style');
  styles.innerHTML = '#sticky-span { display: none !important; }';
  document.body.appendChild(styles);
  var isSticky = null;
  var _wp$data = wp.data,
      select = _wp$data.select,
      subscribe = _wp$data.subscribe;
  var waitForEditor = subscribe(function () {
    if (!select('core/editor').__unstableIsEditorReady()) {
      return;
    }

    isSticky = select('core/editor').getEditedPostAttribute('sticky');

    if (isSticky === undefined || isSticky === null) {
      return;
    }

    var stickyControl = Array.from(document.querySelectorAll('.edit-post-post-status .components-panel__row')).find(function (el) {
      return el.innerText === 'Stick to the top of the blog';
    });

    if (!stickyControl) {
      return;
    }

    waitForEditor();
    stickyControl.style.display = 'none';

    if (isSticky) {
      wp.data.dispatch('core/editor').editPost({
        sticky: false
      });
      wp.data.dispatch('core/editor').savePost();
    }
  });
})();

/***/ }),

/***/ "./src/js/backend/editor/post-author.js":
/*!**********************************************!*\
  !*** ./src/js/backend/editor/post-author.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);


/**
 * Injects an alt display author field near the post author in gutenberg
 */
(function () {
  var _window, _window$wp;

  // Only operate in the editor
  if (!((_window = window) !== null && _window !== void 0 && (_window$wp = _window.wp) !== null && _window$wp !== void 0 && _window$wp.blocks)) {
    return;
  }

  var registerPlugin = wp.plugins.registerPlugin;
  var PluginPostStatusInfo = wp.editPost.PluginPostStatusInfo;
  var TextControl = wp.components.TextControl;
  var _wp$data = wp.data,
      useSelect = _wp$data.useSelect,
      useDispatch = _wp$data.useDispatch;
  var useCallback = wp.element.useCallback;

  var PluginPostStatusInfoTest = function PluginPostStatusInfoTest() {
    var _useSelect = useSelect(function (select) {
      return {
        postType: select('core/editor').getCurrentPostType()
      };
    }),
        postType = _useSelect.postType;

    if (postType === 'post') {
      var _useSelect2 = useSelect(function (select) {
        return {
          acfMeta: select('core/editor').getEditedPostAttribute('acf')
        };
      }, []),
          acfMeta = _useSelect2.acfMeta;

      var _useDispatch = useDispatch('core/editor', [acfMeta['cmls-alt_author']]),
          editPost = _useDispatch.editPost;

      var onChange = useCallback(wp.compose.useDebounce(function (val) {
        // I think ACF's own metabox overwrites, so we'll do this there and in dispatch
        var field = document.getElementById('acf-field_613a67efc94aa');

        if (field) {
          field.value = val;
        }

        editPost({
          acf: {
            'cmls-alt_author': val
          }
        });
        wp.data.dispatch('core/editor').savePost();
      }, 600), [acfMeta['cmls-alt_author']]);
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(PluginPostStatusInfo, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(TextControl, {
        label: "Alt. Author Display Name",
        help: "Set an alternate name for the author of this post to display publicaly instead of the real author, e.g. for guest blogs.",
        value: acfMeta['cmls-alt_author'],
        onChange: onChange
      }));
    } else {
      return null;
    }
  };

  registerPlugin('post-status-info-test', {
    render: PluginPostStatusInfoTest
  });
})();

/***/ }),

/***/ "./src/js/backend/index.js":
/*!*********************************!*\
  !*** ./src/js/backend/index.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _editor_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./editor/index.js */ "./src/js/backend/editor/index.js");


/***/ }),

/***/ "./src/backend.scss":
/*!**************************!*\
  !*** ./src/backend.scss ***!
  \**************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

module.exports = window["jQuery"];

/***/ }),

/***/ "lodash":
/*!*************************!*\
  !*** external "lodash" ***!
  \*************************/
/***/ (function(module) {

module.exports = window["lodash"];

/***/ }),

/***/ "@babel/runtime/regenerator":
/*!*************************************!*\
  !*** external "regeneratorRuntime" ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["regeneratorRuntime"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js ***!
  \*********************************************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ _asyncToGenerator; }
/* harmony export */ });
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }

  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}

function _asyncToGenerator(fn) {
  return function () {
    var self = this,
        args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);

      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }

      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }

      _next(undefined);
    });
  };
}

/***/ }),

/***/ "./node_modules/colord/index.mjs":
/*!***************************************!*\
  !*** ./node_modules/colord/index.mjs ***!
  \***************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Colord": function() { return /* binding */ j; },
/* harmony export */   "colord": function() { return /* binding */ w; },
/* harmony export */   "extend": function() { return /* binding */ k; },
/* harmony export */   "getFormat": function() { return /* binding */ I; },
/* harmony export */   "random": function() { return /* binding */ E; }
/* harmony export */ });
var r={grad:.9,turn:360,rad:360/(2*Math.PI)},t=function(r){return"string"==typeof r?r.length>0:"number"==typeof r},n=function(r,t,n){return void 0===t&&(t=0),void 0===n&&(n=Math.pow(10,t)),Math.round(n*r)/n+0},e=function(r,t,n){return void 0===t&&(t=0),void 0===n&&(n=1),r>n?n:r>t?r:t},u=function(r){return(r=isFinite(r)?r%360:0)>0?r:r+360},a=function(r){return{r:e(r.r,0,255),g:e(r.g,0,255),b:e(r.b,0,255),a:e(r.a)}},o=function(r){return{r:n(r.r),g:n(r.g),b:n(r.b),a:n(r.a,3)}},i=/^#([0-9a-f]{3,8})$/i,s=function(r){var t=r.toString(16);return t.length<2?"0"+t:t},h=function(r){var t=r.r,n=r.g,e=r.b,u=r.a,a=Math.max(t,n,e),o=a-Math.min(t,n,e),i=o?a===t?(n-e)/o:a===n?2+(e-t)/o:4+(t-n)/o:0;return{h:60*(i<0?i+6:i),s:a?o/a*100:0,v:a/255*100,a:u}},b=function(r){var t=r.h,n=r.s,e=r.v,u=r.a;t=t/360*6,n/=100,e/=100;var a=Math.floor(t),o=e*(1-n),i=e*(1-(t-a)*n),s=e*(1-(1-t+a)*n),h=a%6;return{r:255*[e,i,o,o,s,e][h],g:255*[s,e,e,i,o,o][h],b:255*[o,o,s,e,e,i][h],a:u}},g=function(r){return{h:u(r.h),s:e(r.s,0,100),l:e(r.l,0,100),a:e(r.a)}},d=function(r){return{h:n(r.h),s:n(r.s),l:n(r.l),a:n(r.a,3)}},f=function(r){return b((n=(t=r).s,{h:t.h,s:(n*=((e=t.l)<50?e:100-e)/100)>0?2*n/(e+n)*100:0,v:e+n,a:t.a}));var t,n,e},c=function(r){return{h:(t=h(r)).h,s:(u=(200-(n=t.s))*(e=t.v)/100)>0&&u<200?n*e/100/(u<=100?u:200-u)*100:0,l:u/2,a:t.a};var t,n,e,u},l=/^hsla?\(\s*([+-]?\d*\.?\d+)(deg|rad|grad|turn)?\s*,\s*([+-]?\d*\.?\d+)%\s*,\s*([+-]?\d*\.?\d+)%\s*(?:,\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,p=/^hsla?\(\s*([+-]?\d*\.?\d+)(deg|rad|grad|turn)?\s+([+-]?\d*\.?\d+)%\s+([+-]?\d*\.?\d+)%\s*(?:\/\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,v=/^rgba?\(\s*([+-]?\d*\.?\d+)(%)?\s*,\s*([+-]?\d*\.?\d+)(%)?\s*,\s*([+-]?\d*\.?\d+)(%)?\s*(?:,\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,m=/^rgba?\(\s*([+-]?\d*\.?\d+)(%)?\s+([+-]?\d*\.?\d+)(%)?\s+([+-]?\d*\.?\d+)(%)?\s*(?:\/\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,y={string:[[function(r){var t=i.exec(r);return t?(r=t[1]).length<=4?{r:parseInt(r[0]+r[0],16),g:parseInt(r[1]+r[1],16),b:parseInt(r[2]+r[2],16),a:4===r.length?n(parseInt(r[3]+r[3],16)/255,2):1}:6===r.length||8===r.length?{r:parseInt(r.substr(0,2),16),g:parseInt(r.substr(2,2),16),b:parseInt(r.substr(4,2),16),a:8===r.length?n(parseInt(r.substr(6,2),16)/255,2):1}:null:null},"hex"],[function(r){var t=v.exec(r)||m.exec(r);return t?t[2]!==t[4]||t[4]!==t[6]?null:a({r:Number(t[1])/(t[2]?100/255:1),g:Number(t[3])/(t[4]?100/255:1),b:Number(t[5])/(t[6]?100/255:1),a:void 0===t[7]?1:Number(t[7])/(t[8]?100:1)}):null},"rgb"],[function(t){var n=l.exec(t)||p.exec(t);if(!n)return null;var e,u,a=g({h:(e=n[1],u=n[2],void 0===u&&(u="deg"),Number(e)*(r[u]||1)),s:Number(n[3]),l:Number(n[4]),a:void 0===n[5]?1:Number(n[5])/(n[6]?100:1)});return f(a)},"hsl"]],object:[[function(r){var n=r.r,e=r.g,u=r.b,o=r.a,i=void 0===o?1:o;return t(n)&&t(e)&&t(u)?a({r:Number(n),g:Number(e),b:Number(u),a:Number(i)}):null},"rgb"],[function(r){var n=r.h,e=r.s,u=r.l,a=r.a,o=void 0===a?1:a;if(!t(n)||!t(e)||!t(u))return null;var i=g({h:Number(n),s:Number(e),l:Number(u),a:Number(o)});return f(i)},"hsl"],[function(r){var n=r.h,a=r.s,o=r.v,i=r.a,s=void 0===i?1:i;if(!t(n)||!t(a)||!t(o))return null;var h=function(r){return{h:u(r.h),s:e(r.s,0,100),v:e(r.v,0,100),a:e(r.a)}}({h:Number(n),s:Number(a),v:Number(o),a:Number(s)});return b(h)},"hsv"]]},N=function(r,t){for(var n=0;n<t.length;n++){var e=t[n][0](r);if(e)return[e,t[n][1]]}return[null,void 0]},x=function(r){return"string"==typeof r?N(r.trim(),y.string):"object"==typeof r&&null!==r?N(r,y.object):[null,void 0]},I=function(r){return x(r)[1]},M=function(r,t){var n=c(r);return{h:n.h,s:e(n.s+100*t,0,100),l:n.l,a:n.a}},H=function(r){return(299*r.r+587*r.g+114*r.b)/1e3/255},$=function(r,t){var n=c(r);return{h:n.h,s:n.s,l:e(n.l+100*t,0,100),a:n.a}},j=function(){function r(r){this.parsed=x(r)[0],this.rgba=this.parsed||{r:0,g:0,b:0,a:1}}return r.prototype.isValid=function(){return null!==this.parsed},r.prototype.brightness=function(){return n(H(this.rgba),2)},r.prototype.isDark=function(){return H(this.rgba)<.5},r.prototype.isLight=function(){return H(this.rgba)>=.5},r.prototype.toHex=function(){return r=o(this.rgba),t=r.r,e=r.g,u=r.b,i=(a=r.a)<1?s(n(255*a)):"","#"+s(t)+s(e)+s(u)+i;var r,t,e,u,a,i},r.prototype.toRgb=function(){return o(this.rgba)},r.prototype.toRgbString=function(){return r=o(this.rgba),t=r.r,n=r.g,e=r.b,(u=r.a)<1?"rgba("+t+", "+n+", "+e+", "+u+")":"rgb("+t+", "+n+", "+e+")";var r,t,n,e,u},r.prototype.toHsl=function(){return d(c(this.rgba))},r.prototype.toHslString=function(){return r=d(c(this.rgba)),t=r.h,n=r.s,e=r.l,(u=r.a)<1?"hsla("+t+", "+n+"%, "+e+"%, "+u+")":"hsl("+t+", "+n+"%, "+e+"%)";var r,t,n,e,u},r.prototype.toHsv=function(){return r=h(this.rgba),{h:n(r.h),s:n(r.s),v:n(r.v),a:n(r.a,3)};var r},r.prototype.invert=function(){return w({r:255-(r=this.rgba).r,g:255-r.g,b:255-r.b,a:r.a});var r},r.prototype.saturate=function(r){return void 0===r&&(r=.1),w(M(this.rgba,r))},r.prototype.desaturate=function(r){return void 0===r&&(r=.1),w(M(this.rgba,-r))},r.prototype.grayscale=function(){return w(M(this.rgba,-1))},r.prototype.lighten=function(r){return void 0===r&&(r=.1),w($(this.rgba,r))},r.prototype.darken=function(r){return void 0===r&&(r=.1),w($(this.rgba,-r))},r.prototype.rotate=function(r){return void 0===r&&(r=15),this.hue(this.hue()+r)},r.prototype.alpha=function(r){return"number"==typeof r?w({r:(t=this.rgba).r,g:t.g,b:t.b,a:r}):n(this.rgba.a,3);var t},r.prototype.hue=function(r){var t=c(this.rgba);return"number"==typeof r?w({h:r,s:t.s,l:t.l,a:t.a}):n(t.h)},r.prototype.isEqual=function(r){return this.toHex()===w(r).toHex()},r}(),w=function(r){return r instanceof j?r:new j(r)},S=[],k=function(r){r.forEach(function(r){S.indexOf(r)<0&&(r(j,y),S.push(r))})},E=function(){return new j({r:255*Math.random(),g:255*Math.random(),b:255*Math.random()})};


/***/ }),

/***/ "./node_modules/colord/plugins/a11y.mjs":
/*!**********************************************!*\
  !*** ./node_modules/colord/plugins/a11y.mjs ***!
  \**********************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* export default binding */ __WEBPACK_DEFAULT_EXPORT__; }
/* harmony export */ });
var o=function(o){var t=o/255;return t<.04045?t/12.92:Math.pow((t+.055)/1.055,2.4)},t=function(t){return.2126*o(t.r)+.7152*o(t.g)+.0722*o(t.b)};/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__(o){o.prototype.luminance=function(){return o=t(this.rgba),void 0===(r=2)&&(r=0),void 0===n&&(n=Math.pow(10,r)),Math.round(n*o)/n+0;var o,r,n},o.prototype.contrast=function(r){void 0===r&&(r="#FFF");var n,a,i,e,v,u,d,c=r instanceof o?r:new o(r);return e=this.rgba,v=c.toRgb(),u=t(e),d=t(v),n=u>d?(u+.05)/(d+.05):(d+.05)/(u+.05),void 0===(a=2)&&(a=0),void 0===i&&(i=Math.pow(10,a)),Math.floor(i*n)/i+0},o.prototype.isReadable=function(o,t){return void 0===o&&(o="#FFF"),void 0===t&&(t={}),this.contrast(o)>=(e=void 0===(i=(r=t).size)?"normal":i,"AAA"===(a=void 0===(n=r.level)?"AA":n)&&"normal"===e?7:"AA"===a&&"large"===e?3:4.5);var r,n,a,i,e}}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!************************!*\
  !*** ./src/backend.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _backend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./backend.scss */ "./src/backend.scss");
/* harmony import */ var _js_backend_index_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/backend/index.js */ "./src/js/backend/index.js");


}();
/******/ })()
;
//# sourceMappingURL=backend.js.map