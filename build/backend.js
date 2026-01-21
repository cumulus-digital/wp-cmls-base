/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/colord/index.mjs":
/*!***************************************!*\
  !*** ./node_modules/colord/index.mjs ***!
  \***************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Colord: function() { return /* binding */ j; },
/* harmony export */   colord: function() { return /* binding */ w; },
/* harmony export */   extend: function() { return /* binding */ k; },
/* harmony export */   getFormat: function() { return /* binding */ I; },
/* harmony export */   random: function() { return /* binding */ E; }
/* harmony export */ });
var r={grad:.9,turn:360,rad:360/(2*Math.PI)},t=function(r){return"string"==typeof r?r.length>0:"number"==typeof r},n=function(r,t,n){return void 0===t&&(t=0),void 0===n&&(n=Math.pow(10,t)),Math.round(n*r)/n+0},e=function(r,t,n){return void 0===t&&(t=0),void 0===n&&(n=1),r>n?n:r>t?r:t},u=function(r){return(r=isFinite(r)?r%360:0)>0?r:r+360},a=function(r){return{r:e(r.r,0,255),g:e(r.g,0,255),b:e(r.b,0,255),a:e(r.a)}},o=function(r){return{r:n(r.r),g:n(r.g),b:n(r.b),a:n(r.a,3)}},i=/^#([0-9a-f]{3,8})$/i,s=function(r){var t=r.toString(16);return t.length<2?"0"+t:t},h=function(r){var t=r.r,n=r.g,e=r.b,u=r.a,a=Math.max(t,n,e),o=a-Math.min(t,n,e),i=o?a===t?(n-e)/o:a===n?2+(e-t)/o:4+(t-n)/o:0;return{h:60*(i<0?i+6:i),s:a?o/a*100:0,v:a/255*100,a:u}},b=function(r){var t=r.h,n=r.s,e=r.v,u=r.a;t=t/360*6,n/=100,e/=100;var a=Math.floor(t),o=e*(1-n),i=e*(1-(t-a)*n),s=e*(1-(1-t+a)*n),h=a%6;return{r:255*[e,i,o,o,s,e][h],g:255*[s,e,e,i,o,o][h],b:255*[o,o,s,e,e,i][h],a:u}},g=function(r){return{h:u(r.h),s:e(r.s,0,100),l:e(r.l,0,100),a:e(r.a)}},d=function(r){return{h:n(r.h),s:n(r.s),l:n(r.l),a:n(r.a,3)}},f=function(r){return b((n=(t=r).s,{h:t.h,s:(n*=((e=t.l)<50?e:100-e)/100)>0?2*n/(e+n)*100:0,v:e+n,a:t.a}));// removed by dead control flow
 var t, n, e; },c=function(r){return{h:(t=h(r)).h,s:(u=(200-(n=t.s))*(e=t.v)/100)>0&&u<200?n*e/100/(u<=100?u:200-u)*100:0,l:u/2,a:t.a};// removed by dead control flow
 var t, n, e, u; },l=/^hsla?\(\s*([+-]?\d*\.?\d+)(deg|rad|grad|turn)?\s*,\s*([+-]?\d*\.?\d+)%\s*,\s*([+-]?\d*\.?\d+)%\s*(?:,\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,p=/^hsla?\(\s*([+-]?\d*\.?\d+)(deg|rad|grad|turn)?\s+([+-]?\d*\.?\d+)%\s+([+-]?\d*\.?\d+)%\s*(?:\/\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,v=/^rgba?\(\s*([+-]?\d*\.?\d+)(%)?\s*,\s*([+-]?\d*\.?\d+)(%)?\s*,\s*([+-]?\d*\.?\d+)(%)?\s*(?:,\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,m=/^rgba?\(\s*([+-]?\d*\.?\d+)(%)?\s+([+-]?\d*\.?\d+)(%)?\s+([+-]?\d*\.?\d+)(%)?\s*(?:\/\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,y={string:[[function(r){var t=i.exec(r);return t?(r=t[1]).length<=4?{r:parseInt(r[0]+r[0],16),g:parseInt(r[1]+r[1],16),b:parseInt(r[2]+r[2],16),a:4===r.length?n(parseInt(r[3]+r[3],16)/255,2):1}:6===r.length||8===r.length?{r:parseInt(r.substr(0,2),16),g:parseInt(r.substr(2,2),16),b:parseInt(r.substr(4,2),16),a:8===r.length?n(parseInt(r.substr(6,2),16)/255,2):1}:null:null},"hex"],[function(r){var t=v.exec(r)||m.exec(r);return t?t[2]!==t[4]||t[4]!==t[6]?null:a({r:Number(t[1])/(t[2]?100/255:1),g:Number(t[3])/(t[4]?100/255:1),b:Number(t[5])/(t[6]?100/255:1),a:void 0===t[7]?1:Number(t[7])/(t[8]?100:1)}):null},"rgb"],[function(t){var n=l.exec(t)||p.exec(t);if(!n)return null;var e,u,a=g({h:(e=n[1],u=n[2],void 0===u&&(u="deg"),Number(e)*(r[u]||1)),s:Number(n[3]),l:Number(n[4]),a:void 0===n[5]?1:Number(n[5])/(n[6]?100:1)});return f(a)},"hsl"]],object:[[function(r){var n=r.r,e=r.g,u=r.b,o=r.a,i=void 0===o?1:o;return t(n)&&t(e)&&t(u)?a({r:Number(n),g:Number(e),b:Number(u),a:Number(i)}):null},"rgb"],[function(r){var n=r.h,e=r.s,u=r.l,a=r.a,o=void 0===a?1:a;if(!t(n)||!t(e)||!t(u))return null;var i=g({h:Number(n),s:Number(e),l:Number(u),a:Number(o)});return f(i)},"hsl"],[function(r){var n=r.h,a=r.s,o=r.v,i=r.a,s=void 0===i?1:i;if(!t(n)||!t(a)||!t(o))return null;var h=function(r){return{h:u(r.h),s:e(r.s,0,100),v:e(r.v,0,100),a:e(r.a)}}({h:Number(n),s:Number(a),v:Number(o),a:Number(s)});return b(h)},"hsv"]]},N=function(r,t){for(var n=0;n<t.length;n++){var e=t[n][0](r);if(e)return[e,t[n][1]]}return[null,void 0]},x=function(r){return"string"==typeof r?N(r.trim(),y.string):"object"==typeof r&&null!==r?N(r,y.object):[null,void 0]},I=function(r){return x(r)[1]},M=function(r,t){var n=c(r);return{h:n.h,s:e(n.s+100*t,0,100),l:n.l,a:n.a}},H=function(r){return(299*r.r+587*r.g+114*r.b)/1e3/255},$=function(r,t){var n=c(r);return{h:n.h,s:n.s,l:e(n.l+100*t,0,100),a:n.a}},j=function(){function r(r){this.parsed=x(r)[0],this.rgba=this.parsed||{r:0,g:0,b:0,a:1}}return r.prototype.isValid=function(){return null!==this.parsed},r.prototype.brightness=function(){return n(H(this.rgba),2)},r.prototype.isDark=function(){return H(this.rgba)<.5},r.prototype.isLight=function(){return H(this.rgba)>=.5},r.prototype.toHex=function(){return r=o(this.rgba),t=r.r,e=r.g,u=r.b,i=(a=r.a)<1?s(n(255*a)):"","#"+s(t)+s(e)+s(u)+i;// removed by dead control flow
 var r, t, e, u, a, i; },r.prototype.toRgb=function(){return o(this.rgba)},r.prototype.toRgbString=function(){return r=o(this.rgba),t=r.r,n=r.g,e=r.b,(u=r.a)<1?"rgba("+t+", "+n+", "+e+", "+u+")":"rgb("+t+", "+n+", "+e+")";// removed by dead control flow
 var r, t, n, e, u; },r.prototype.toHsl=function(){return d(c(this.rgba))},r.prototype.toHslString=function(){return r=d(c(this.rgba)),t=r.h,n=r.s,e=r.l,(u=r.a)<1?"hsla("+t+", "+n+"%, "+e+"%, "+u+")":"hsl("+t+", "+n+"%, "+e+"%)";// removed by dead control flow
 var r, t, n, e, u; },r.prototype.toHsv=function(){return r=h(this.rgba),{h:n(r.h),s:n(r.s),v:n(r.v),a:n(r.a,3)};// removed by dead control flow
 var r; },r.prototype.invert=function(){return w({r:255-(r=this.rgba).r,g:255-r.g,b:255-r.b,a:r.a});// removed by dead control flow
 var r; },r.prototype.saturate=function(r){return void 0===r&&(r=.1),w(M(this.rgba,r))},r.prototype.desaturate=function(r){return void 0===r&&(r=.1),w(M(this.rgba,-r))},r.prototype.grayscale=function(){return w(M(this.rgba,-1))},r.prototype.lighten=function(r){return void 0===r&&(r=.1),w($(this.rgba,r))},r.prototype.darken=function(r){return void 0===r&&(r=.1),w($(this.rgba,-r))},r.prototype.rotate=function(r){return void 0===r&&(r=15),this.hue(this.hue()+r)},r.prototype.alpha=function(r){return"number"==typeof r?w({r:(t=this.rgba).r,g:t.g,b:t.b,a:r}):n(this.rgba.a,3);// removed by dead control flow
 var t; },r.prototype.hue=function(r){var t=c(this.rgba);return"number"==typeof r?w({h:r,s:t.s,l:t.l,a:t.a}):n(t.h)},r.prototype.isEqual=function(r){return this.toHex()===w(r).toHex()},r}(),w=function(r){return r instanceof j?r:new j(r)},S=[],k=function(r){r.forEach(function(r){S.indexOf(r)<0&&(r(j,y),S.push(r))})},E=function(){return new j({r:255*Math.random(),g:255*Math.random(),b:255*Math.random()})};


/***/ }),

/***/ "./node_modules/colord/plugins/a11y.mjs":
/*!**********************************************!*\
  !*** ./node_modules/colord/plugins/a11y.mjs ***!
  \**********************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* export default binding */ __WEBPACK_DEFAULT_EXPORT__; }
/* harmony export */ });
var o=function(o){var t=o/255;return t<.04045?t/12.92:Math.pow((t+.055)/1.055,2.4)},t=function(t){return.2126*o(t.r)+.7152*o(t.g)+.0722*o(t.b)};/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__(o){o.prototype.luminance=function(){return o=t(this.rgba),void 0===(r=2)&&(r=0),void 0===n&&(n=Math.pow(10,r)),Math.round(n*o)/n+0;// removed by dead control flow
 var o, r, n; },o.prototype.contrast=function(r){void 0===r&&(r="#FFF");var n,a,i,e,v,u,d,c=r instanceof o?r:new o(r);return e=this.rgba,v=c.toRgb(),u=t(e),d=t(v),n=u>d?(u+.05)/(d+.05):(d+.05)/(u+.05),void 0===(a=2)&&(a=0),void 0===i&&(i=Math.pow(10,a)),Math.floor(i*n)/i+0},o.prototype.isReadable=function(o,t){return void 0===o&&(o="#FFF"),void 0===t&&(t={}),this.contrast(o)>=(e=void 0===(i=(r=t).size)?"normal":i,"AAA"===(a=void 0===(n=r.level)?"AA":n)&&"normal"===e?7:"AA"===a&&"large"===e?3:4.5);// removed by dead control flow
 var r, n, a, i, e; }}


/***/ }),

/***/ "./node_modules/colord/plugins/mix.mjs":
/*!*********************************************!*\
  !*** ./node_modules/colord/plugins/mix.mjs ***!
  \*********************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* export default binding */ __WEBPACK_DEFAULT_EXPORT__; }
/* harmony export */ });
var t=function(t,a,n){return void 0===a&&(a=0),void 0===n&&(n=1),t>n?n:t>a?t:a},a=function(t){var a=t/255;return a<.04045?a/12.92:Math.pow((a+.055)/1.055,2.4)},n=function(t){return 255*(t>.0031308?1.055*Math.pow(t,1/2.4)-.055:12.92*t)},r=96.422,o=100,u=82.521,e=function(a){var r,o,u={x:.9555766*(r=a).x+-.0230393*r.y+.0631636*r.z,y:-.0282895*r.x+1.0099416*r.y+.0210077*r.z,z:.0122982*r.x+-.020483*r.y+1.3299098*r.z};return o={r:n(.032404542*u.x-.015371385*u.y-.004985314*u.z),g:n(-.00969266*u.x+.018760108*u.y+41556e-8*u.z),b:n(556434e-9*u.x-.002040259*u.y+.010572252*u.z),a:a.a},{r:t(o.r,0,255),g:t(o.g,0,255),b:t(o.b,0,255),a:t(o.a)}},i=function(n){var e=a(n.r),i=a(n.g),p=a(n.b);return function(a){return{x:t(a.x,0,r),y:t(a.y,0,o),z:t(a.z,0,u),a:t(a.a)}}(function(t){return{x:1.0478112*t.x+.0228866*t.y+-.050127*t.z,y:.0295424*t.x+.9904844*t.y+-.0170491*t.z,z:-.0092345*t.x+.0150436*t.y+.7521316*t.z,a:t.a}}({x:100*(.4124564*e+.3575761*i+.1804375*p),y:100*(.2126729*e+.7151522*i+.072175*p),z:100*(.0193339*e+.119192*i+.9503041*p),a:n.a}))},p=216/24389,h=24389/27,f=function(t){var a=i(t),n=a.x/r,e=a.y/o,f=a.z/u;return n=n>p?Math.cbrt(n):(h*n+16)/116,{l:116*(e=e>p?Math.cbrt(e):(h*e+16)/116)-16,a:500*(n-e),b:200*(e-(f=f>p?Math.cbrt(f):(h*f+16)/116)),alpha:a.a}},c=function(a,n,i){var c,y=f(a),x=f(n);return function(t){var a=(t.l+16)/116,n=t.a/500+a,i=a-t.b/200;return e({x:(Math.pow(n,3)>p?Math.pow(n,3):(116*n-16)/h)*r,y:(t.l>8?Math.pow((t.l+16)/116,3):t.l/h)*o,z:(Math.pow(i,3)>p?Math.pow(i,3):(116*i-16)/h)*u,a:t.alpha})}({l:t((c={l:y.l*(1-i)+x.l*i,a:y.a*(1-i)+x.a*i,b:y.b*(1-i)+x.b*i,alpha:y.alpha*(1-i)+x.alpha*i}).l,0,400),a:c.a,b:c.b,alpha:t(c.alpha)})};/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__(t){function a(t,a,n){void 0===n&&(n=5);for(var r=[],o=1/(n-1),u=0;u<=n-1;u++)r.push(t.mix(a,o*u));return r}t.prototype.mix=function(a,n){void 0===n&&(n=.5);var r=a instanceof t?a:new t(a),o=c(this.toRgb(),r.toRgb(),n);return new t(o)},t.prototype.tints=function(t){return a(this,"#fff",t)},t.prototype.shades=function(t){return a(this,"#000",t)},t.prototype.tones=function(t){return a(this,"#808080",t)}}


/***/ }),

/***/ "./src/backend.scss":
/*!**************************!*\
  !*** ./src/backend.scss ***!
  \**************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/global.js":
/*!***********************!*\
  !*** ./src/global.js ***!
  \***********************/
/***/ (function() {

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

/***/ }),

/***/ "./src/js/backend/editor/acf-title.css?raw":
/*!*************************************************!*\
  !*** ./src/js/backend/editor/acf-title.css?raw ***!
  \*************************************************/
/***/ (function(module) {

"use strict";
module.exports = ":root .edit-post-visual-editor__post-title-wrapper {\n\ttransition-property: opacity;\n\ttransition-duration: .5s;\n\topacity: 1;\n\tposition: relative;\n\tcolor: var(--page_title-title_color);\n}\n:root .has-header-background .edit-post-visual-editor__post-title-wrapper {\n\tbackground-image: var(--page_title-background_image);\n\tbackground-color: var(--page_title-background_color);\n\tbackground-position: var(--page_title-background_position);\n\tbackground-repeat: var(--page_title-background_repeat);\n\tbackground-size: var(--page_title-background_size);\n\tmargin-bottom: var(--page_title-margin_below_header);\n\tmargin-top: 0;\n\tpadding-top: calc(var(--page_title-padding, 2rem) + .25em);\n\tpadding-bottom: calc(var(--page_title-padding, 2rem) + .25em);\n}\n\t:root .has-header-background .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\t\ttext-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));\n\t}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper,\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper {\n\tmargin-top: 1.5rem;\n}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before,\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper::before {\n\tdisplay: inline-block;\n\t/*background: rgba(0, 0, 0, 0.75);*/\n\tcolor: #fff;\n\tfont-size: 1em;\n\tline-height: 1;\n\t/*text-shadow: 1px 1px 1px #000;*/\n\tpadding: .5rem;\n\topacity: 1;\n\tposition: absolute;\n\tleft: 0;\n\ttop: 0;\n}\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper::before {\n\tcontent: '🥸';\n}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before {\n\tcontent: '🤫';\n}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input,\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\tbackground-color: rgba(0,0,0,0.07);\n\tposition: relative;\n\topacity: 0.5;\n}\n\t:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within,\n\t:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within {\n\t\topacity: 1;\n\t}";

/***/ }),

/***/ "./src/js/backend/editor/acf-title.js":
/*!********************************************!*\
  !*** ./src/js/backend/editor/acf-title.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var colord__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! colord */ "./node_modules/colord/index.mjs");
/* harmony import */ var colord_plugins_a11y__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! colord/plugins/a11y */ "./node_modules/colord/plugins/a11y.mjs");
/* harmony import */ var colord_plugins_mix__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! colord/plugins/mix */ "./node_modules/colord/plugins/mix.mjs");
/**
 * Dynamically represent changes to the post title in ACF options
 */





const {
  select,
  subscribe
} = wp.data;
const $ = jquery__WEBPACK_IMPORTED_MODULE_0___default().noConflict();
window.acfWatchChanges = function (config) {
  const {
    group,
    acfFields,
    postTypeTest
  } = config;
  let firstRun = true;

  // Get editor-styles-wrapper in body and preview canvas
  this.getBasicContext = () => {
    return $('.editor-styles-wrapper').add($('iframe[name="editor-canvas"]').contents().find('.editor-styles-wrapper'));
  };

  // Get a custom selector in top-level and preview convas
  this.$inContext = selector => {
    return $(selector).add($('iframe[name="editor-canvas"]').contents().find(selector));
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
        if (wp.api?.models?.Media && opt.val && opt.val.toString().length) {
          var media = new wp.api.models.Media({
            id: opt.val
          });
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
  function waitForEl(selector, jQ = false) {
    return new Promise(resolve => {
      function check() {
        const el = jQ ? $(selector) : document.querySelector(selector);
        if (jQ && el.length || !jQ && el) {
          return el;
        }
        return false;
      }
      const el = check();
      if (el) return resolve(el);
      const wait = subscribe(() => {
        const el = check();
        if (!el) return;
        resolve(el);
        wait();
      });
    });
  }
  function waitForAllEls(selectors, $context) {
    return new Promise(resolve => {
      function check() {
        if (!Array.isArray(selectors)) {
          selectors = [selectors];
        }
        const found = $context.find(selectors.join(','));
        if (!found || found.length < selectors.length) {
          return false;
        }
        return true;
      }
      if (check()) return resolve();
      const wait = subscribe(() => {
        if (!check) return;
        resolve();
        wait();
      });
    });
  }
  function setupWatch() {
    // Wait for group
    waitForEl(group, true).then($acfGroup => {
      async function updateHeaderDisplay() {
        await waitForAllEls(Object.values(acfFields).map(field => field.acf), $(document.body));
        var opts = [];
        for (let field of Object.values(acfFields)) {
          //const field = acfFields[i];
          let $input = $(field.acf);
          field.val = $input.val();
          field = await sanitizeDisplayOption(field);
          if (typeof field.action == 'function') {
            field.action(field.val);
            continue;
          }
          if (field.callback && typeof field.callback == 'function') {
            field.callback(field);
          }
          opts.push(field);
        }

        // Loop through each field and parse needs
        const triggersBackground = [],
          triggersContrastCheck = [],
          styles = {};
        opts.forEach(opt => {
          if (firstRun && opt.val || opt.hasOwnProperty('oldVal') && opt.val !== opt.oldVal) {
            if (opt.triggersHasBackground) {
              triggersBackground.push(opt);
            }
            if (opt.contrastCheck) {
              triggersContrastCheck.push(opt);
            }
          }
          if (opt.action === 'setCssVar') {
            styles[`--page_title-${opt.key}`] = opt.val.toString();
          }
          opt.oldVal = opt.val;
        });
        firstRun = false;
        if (Object.keys(styles).length) {
          window.acfWatchChanges.$inContext('.editor-styles-wrapper').css(styles);
        }

        // Handle any opts that trigger a header background
        if (triggersBackground.length) {
          const hasBackground = triggersBackground.filter(opt => opt.val);
          if (hasBackground) {
            window.acfWatchChanges.$inContext('.editor-styles-wrapper').addClass('has-header-background');
          } else {
            window.acfWatchChanges.$inContext('.editor-styles-wrapper').removeClass('has-header-background');
          }
        }

        // Handle contrast checks
        if (triggersContrastCheck.length) {
          function checkContrast(thisOpt) {
            // Must have an option to check against!
            const thatOpt = acfFields?.[thisOpt.contrastCheck.against];
            if (!thatOpt) return;

            // we may need to compute styles, so let's wait until the
            // computeFrom elements are available
            waitForAllEls([thisOpt, thatOpt].map(opt => opt.contrastCheck.computeFrom), window.acfWatchChanges.$inContext('body')).then(() => {
              const colors = {
                foreground: null,
                background: null
              };
              for (const opt of [thisOpt, thatOpt]) {
                let color = opt.val;
                if (!opt.val) {
                  // computeFrom must always be in the editor
                  const el = window.acfWatchChanges.$inContext('body').find(opt.contrastCheck.computeFrom).get(0);
                  color = getComputedStyle(el)[opt.contrastCheck.computeAttribute];
                }
                colors[opt.contrastCheck.position.toLowerCase()] = color;
              }
              if (!Object.values(colors).filter(Boolean).length) {
                // we've done everything we can to get these colors...
                return;
              }

              // Colors may have alpha!

              // First get actual content bg
              const contentBackground = window.acfWatchChanges.getBasicContext().get(0);
              const contentBgColor = (0,colord__WEBPACK_IMPORTED_MODULE_2__.colord)(getComputedStyle(contentBackground).backgroundColor);
              colors.foreground = (0,colord__WEBPACK_IMPORTED_MODULE_2__.colord)(colors.foreground);
              colors.background = (0,colord__WEBPACK_IMPORTED_MODULE_2__.colord)(colors.background);

              // Mix each color with their background, weighted by
              // the foreground's alpha, to determine the actual
              // display color.
              const bgColor = colors.background.mix(contentBgColor, 1 - colors.background.alpha());
              const fgColor = colors.foreground.mix(bgColor, 1 - colors.foreground.alpha());

              // Now we can test if it's readable.
              const isReadable = (0,colord__WEBPACK_IMPORTED_MODULE_2__.colord)(fgColor).isReadable(colors.background, {
                level: 'AA',
                size: 'large'
              });
              if (!isReadable) {
                wp.data.dispatch('core/notices').createWarningNotice("<span style='font-size:1.15em'>🚨This page's header may be difficult to read!</span>", {
                  id: 'cmls-a11y-warning',
                  isDismissible: false,
                  speak: true,
                  __unstableHTML: true,
                  actions: [{
                    onClick: () => {
                      window.open('https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html', '_blank');
                    },
                    label: 'WCAG 2.0 accessibility Guidelines, Level AA'
                  }]
                });
              } else {
                wp.data.dispatch('core/notices').removeNotice('cmls-a11y-warning');
              }
            });
          }
          triggersContrastCheck.forEach(checkContrast);
        }
      }
      $acfGroup.on(`change.${window.THEME_PREFIX} keyup.${window.THEME_PREFIX}`, Object.values(acfFields).map(opt => opt.acf).join(','), (0,lodash__WEBPACK_IMPORTED_MODULE_1__.debounce)(updateHeaderDisplay, 200, {
        trailing: true
      }));
      updateHeaderDisplay();
    });
  }
  function init() {
    // Only operate in the block editor
    if (!window?.wp?.blocks) {
      return;
    }
    const waitForData = subscribe(() => {
      if (!wp?.data?.select) return;
      const currentPostType = wp.data.select('core/editor').getCurrentPostType();
      if (!currentPostType) return;
      const postType = wp.data.select('core').getPostType(currentPostType);
      if (!postType) return;
      if (postTypeTest(postType)) {
        (0,colord__WEBPACK_IMPORTED_MODULE_2__.extend)([colord_plugins_a11y__WEBPACK_IMPORTED_MODULE_3__["default"], colord_plugins_mix__WEBPACK_IMPORTED_MODULE_4__["default"]]);

        // ACF display option styles
        const editorCSS = __webpack_require__(/*! ./acf-title.css?raw */ "./src/js/backend/editor/acf-title.css?raw");
        $(function () {
          if (!document.querySelector('#cmls-acf_post_title')) {
            window.acfWatchChanges.$inContext('.editor-styles-wrapper').prepend(`<style id="cmls-acf_post_title">${editorCSS}</style>`);
          } else {
            console.warn('Could not inject ACF display option styles');
          }
        });
        setupWatch();
      }
      waitForData();
    });
  }
  $(() => {
    const waitForEditor = subscribe(() => {
      if (!select('core/editor').__unstableIsEditorReady()) {
        return;
      }
      init();
      waitForEditor();
    });
  });
};
window.acfWatchChanges.getBasicContext = () => {
  return $('.editor-styles-wrapper').add($('iframe[name="editor-canvas"]').contents().find('.editor-styles-wrapper'));
};
window.acfWatchChanges.$inContext = selector => {
  return $(selector).add($('iframe[name="editor-canvas"]').contents().find(selector));
};
const CMLS_Base_ACF_Watcher = new acfWatchChanges({
  postTypeTest: postType => postType.hierarchical,
  group: '#acf-group_5f467bc4cb553',
  acfFields: {
    '#acf-field_5f467c3c135f3': {
      key: 'title-hidden',
      type: 'checkbox',
      acf: '#acf-field_5f467c3c135f3',
      action: checked => {
        if (checked) {
          window.acfWatchChanges.getBasicContext().addClass('has-hidden-post-title');
          window.wp.data.dispatch('core/notices').createNotice('info', "🤫 This post's title is hidden", {
            isDismissible: false,
            id: 'has-hidden-post-title'
          });
          return;
        }
        window.wp.data.dispatch('core/notices').removeNotice('has-hidden-post-title');
        window.acfWatchChanges.getBasicContext().removeClass('has-hidden-post-title');
      }
    },
    '#acf-field_5f46f4d6962ca': {
      key: 'title-alt',
      type: 'string',
      acf: '#acf-field_5f46f4d6962ca',
      action: val => {
        if (val && val.toString().length) {
          window.acfWatchChanges.getBasicContext().addClass('has-alt-title');
          window.wp.data.dispatch('core/notices').createNotice('info', '🥸 This post uses an alternate display title', {
            isDismissible: false,
            id: 'has-alt-title'
          });
          return;
        }
        window.wp.data.dispatch('core/notices').removeNotice('has-alt-title');
        window.acfWatchChanges.getBasicContext().removeClass('has-alt-title');
      }
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
        computeAttribute: 'backgroundColor'
      }
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
        computeAttribute: 'color'
      }
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
  }
});

/***/ }),

/***/ "./src/js/backend/editor/disable-jetpack-external-media.js":
/*!*****************************************************************!*\
  !*** ./src/js/backend/editor/disable-jetpack-external-media.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   waitFor: function() { return /* binding */ waitFor; }
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);


const waitFor = async selector => new Promise(resolve => {
  const unsubscribe = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.subscribe)(() => {
    if (selector()) {
      unsubscribe();
      resolve();
    }
  });
});
const isInserterOpened = () => (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core/edit-post')?.isInserterOpened() || (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core/edit-site')?.isInserterOpened() || (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core/edit-widgets')?.isInserterOpened?.();
const registerInInserter = mediaCategoryProvider => (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.dispatch)('core/block-editor')?.registerInserterMediaCategory?.(mediaCategoryProvider());
document.addEventListener('DOMContentLoaded', () => {
  waitFor(isInserterOpened).then(() => {
    registerInInserter({
      name: 'google_photos'
    });
    registerInInserter({
      name: 'pexels_id'
    });
  });
});

/***/ }),

/***/ "./src/js/backend/editor/index.js":
/*!****************************************!*\
  !*** ./src/js/backend/editor/index.js ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _disable_jetpack_external_media_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./disable-jetpack-external-media.js */ "./src/js/backend/editor/disable-jetpack-external-media.js");
/* harmony import */ var _post_author_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./post-author.js */ "./src/js/backend/editor/post-author.js");
/* harmony import */ var _acf_title_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./acf-title.js */ "./src/js/backend/editor/acf-title.js");



(() => {
  // Only operate in the editor
  if (!window?.wp?.blocks) {
    return;
  }

  // Hide the sticky option, force it false
  const styles = document.createElement('style');
  styles.innerHTML = `
		.editor-post-panel__row:has(.editor-post-sticky__toggle-control),
		.editor-post-sticky__toggle-control,
		#sticky-span { display: none !important; }
	`;
  document.body.appendChild(styles);
  let isSticky = null;
  const {
    select,
    subscribe
  } = wp.data;
  const waitForEditor = subscribe(() => {
    if (!select('core/editor').__unstableIsEditorReady()) {
      return;
    }
    isSticky = select('core/editor').getEditedPostAttribute('sticky');
    if (isSticky === undefined || isSticky === null) {
      return;
    }
    const stickyControl = Array.from(document.querySelectorAll('.edit-post-post-status .components-panel__row')).find(el => el.innerText === 'Stick to the top of the blog');
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

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__);

/**
 * Injects an alt display author field near the post author in gutenberg
 */
(() => {
  const acfFieldId = 'field_613a67efc94aa';

  // Only operate in the editor
  if (!window?.wp?.blocks || !window.acf || !window?.acf?.getField(acfFieldId)) {
    return;
  }
  const {
    registerPlugin
  } = wp.plugins;
  const {
    PluginPostStatusInfo
  } = wp.editPost;
  const {
    TextControl
  } = wp.components;
  const {
    useSelect,
    useDispatch
  } = wp.data;
  const {
    useCallback,
    useState
  } = wp.element;
  const {
    debounce
  } = wp.compose;
  const altAuthorField = () => {
    const {
      postType
    } = useSelect(select => {
      return {
        postType: select('core/editor').getCurrentPostType()
      };
    });

    // Only operate on posts
    if (postType !== 'post') {
      return null;
    }

    // Fetch the initial value from ACF data
    const [altAuthor, setAltAuthor] = useState(useSelect(select => {
      const acfMeta = select('core/editor').getEditedPostAttribute('acf');
      return acfMeta['cmls-alt_author'];
    }));
    const [updatingACF, setUpdatingACF] = useState(false);
    const {
      editPost
    } = useDispatch('core/editor', [altAuthor]);

    // Update the ACF field and trigger an editPost
    // so the editor knows we've changed data
    const updateAltAuthor = debounce(val => {
      setAltAuthor(val);
      if (window.acf) {
        const field = window.acf.getField(acfFieldId);
        if (field.val() !== val) {
          setUpdatingACF(true);
          field.val(val);
        }
      }
      setUpdatingACF(false);
      editPost({
        acf: {
          'cmls-alt_author': val
        }
      });
    }, 150, {
      trailing: true
    });
    const onChange = useCallback(updateAltAuthor, [altAuthor]);

    // Watch the original ACF field for changes and reflect it in our state
    if (window.acf) {
      const acf = window.acf;
      const acfField = acf.getField(acfFieldId);
      if (acfField && !acfField.get('watching_alt_author')) {
        ['change', 'keyup'].forEach(ev => {
          acfField.on(ev, debounce(() => {
            if (updatingACF || acfField.val() === altAuthor) {
              return;
            }
            updateAltAuthor(acfField.val());
          }, 150, {
            trailing: true
          }));
        });
        acfField.set('watching_alt_author', true);
      }
    }
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(PluginPostStatusInfo, {
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)(TextControl, {
        label: "Alt. Author Display Name",
        help: "Set an alternate name for the author of this post to display publicaly instead of the real author, e.g. for guest blogs.",
        value: altAuthor,
        onChange: onChange
      })
    });
  };
  if (window.acf && window.acf.getField(acfFieldId)) {
    const field = window.acf.getField(acfFieldId);
    if (!field.get('alt_author_registered')) {
      registerPlugin('post-status-info-test', {
        render: altAuthorField
      });
      field.set('alt_author_registered', true);
    }
  }
})();

/***/ }),

/***/ "./src/js/backend/index.js":
/*!*********************************!*\
  !*** ./src/js/backend/index.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _editor_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./editor/index.js */ "./src/js/backend/editor/index.js");


/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ (function(module) {

"use strict";
module.exports = window["wp"]["data"];

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

"use strict";
module.exports = window["jQuery"];

/***/ }),

/***/ "lodash":
/*!*************************!*\
  !*** external "lodash" ***!
  \*************************/
/***/ (function(module) {

"use strict";
module.exports = window["lodash"];

/***/ }),

/***/ "react/jsx-runtime":
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
/***/ (function(module) {

"use strict";
module.exports = window["ReactJSXRuntime"];

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
/******/ 		// Check if module exists (development only)
/******/ 		if (__webpack_modules__[moduleId] === undefined) {
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
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
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
!function() {
"use strict";
/*!************************!*\
  !*** ./src/backend.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _backend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./backend.scss */ "./src/backend.scss");
/* harmony import */ var _global_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./global.js */ "./src/global.js");
/* harmony import */ var _global_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_global_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _js_backend_index_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/backend/index.js */ "./src/js/backend/index.js");



}();
/******/ })()
;
//# sourceMappingURL=backend.js.map