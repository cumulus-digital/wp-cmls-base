!function(){var t={685:function(){window.THEME_PREFIX="cmls_base"},317:function(t){"use strict";t.exports=":root .edit-post-visual-editor__post-title-wrapper {\n\ttransition-property: opacity;\n\ttransition-duration: .5s;\n\topacity: 1;\n\tposition: relative;\n\tcolor: var(--page_title-title_color);\n}\n:root .has-header-background .edit-post-visual-editor__post-title-wrapper {\n\tbackground-image: var(--page_title-background_image);\n\tbackground-color: var(--page_title-background_color);\n\tbackground-position: var(--page_title-background_position);\n\tbackground-repeat: var(--page_title-background_repeat);\n\tbackground-size: var(--page_title-background_size);\n\tmargin-bottom: var(--page_title-margin_below_header);\n\tmargin-top: 0;\n\tpadding-top: calc(var(--page_title-padding, 2rem) + .25em);\n\tpadding-bottom: calc(var(--page_title-padding, 2rem) + .25em);\n}\n\t:root .has-header-background .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\t\ttext-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));\n\t}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper,\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper {\n\tmargin-top: 1.5rem;\n}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before,\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper::before {\n\tdisplay: inline-block;\n\t/*background: rgba(0, 0, 0, 0.75);*/\n\tcolor: #fff;\n\tfont-size: 1em;\n\tline-height: 1;\n\t/*text-shadow: 1px 1px 1px #000;*/\n\tpadding: .5rem;\n\topacity: 1;\n\tposition: absolute;\n\tleft: 0;\n\ttop: 0;\n}\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper::before {\n\tcontent: '🥸';\n}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper::before {\n\tcontent: '🤫';\n}\n:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input,\n:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\tbackground-color: rgba(0,0,0,0.07);\n\tposition: relative;\n\topacity: 0.5;\n}\n\t:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t:root .has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within,\n\t:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t:root .has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within {\n\t\topacity: 1;\n\t}"}},e={};function a(n){var r=e[n];if(void 0!==r)return r.exports;var o=e[n]={exports:{}};return t[n](o,o.exports,a),o.exports}a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,{a:e}),e},a.d=function(t,e){for(var n in e)a.o(e,n)&&!a.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:e[n]})},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},function(){"use strict";a(685);var t=window.wp.data;const e=()=>(0,t.select)("core/edit-post")?.isInserterOpened()||(0,t.select)("core/edit-site")?.isInserterOpened()||(0,t.select)("core/edit-widgets")?.isInserterOpened?.(),n=e=>(0,t.dispatch)("core/block-editor")?.registerInserterMediaCategory?.(e());document.addEventListener("DOMContentLoaded",(()=>{(async e=>new Promise((a=>{const n=(0,t.subscribe)((()=>{e()&&(n(),a())}))})))(e).then((()=>{n({name:"google_photos"}),n({name:"pexels_id"})}))}));var r=window.ReactJSXRuntime;(()=>{const t="field_613a67efc94aa";if(!window?.wp?.blocks||!window.acf||!window?.acf?.getField(t))return;const{registerPlugin:e}=wp.plugins,{PluginPostStatusInfo:a}=wp.editPost,{TextControl:n}=wp.components,{useSelect:o,useDispatch:i}=wp.data,{useCallback:s,useState:c}=wp.element,{debounce:l}=wp.compose,d=()=>{const{postType:e}=o((t=>({postType:t("core/editor").getCurrentPostType()})));if("post"!==e)return null;const[d,u]=c(o((t=>t("core/editor").getEditedPostAttribute("acf")["cmls-alt_author"]))),[p,f]=c(!1),{editPost:h}=i("core/editor",[d]),g=l((e=>{if(u(e),window.acf){const a=window.acf.getField(t);a.val()!==e&&(f(!0),a.val(e))}f(!1),h({acf:{"cmls-alt_author":e}})}),150,{trailing:!0}),b=s(g,[d]);if(window.acf){const e=window.acf.getField(t);e&&!e.get("watching_alt_author")&&(["change","keyup"].forEach((t=>{e.on(t,l((()=>{p||e.val()===d||g(e.val())}),150,{trailing:!0}))})),e.set("watching_alt_author",!0))}return(0,r.jsx)(a,{children:(0,r.jsx)(n,{label:"Alt. Author Display Name",help:"Set an alternate name for the author of this post to display publicaly instead of the real author, e.g. for guest blogs.",value:d,onChange:b})})};if(window.acf&&window.acf.getField(t)){const a=window.acf.getField(t);a.get("alt_author_registered")||(e("post-status-info-test",{render:d}),a.set("alt_author_registered",!0))}})();var o=window.jQuery,i=a.n(o),s=window.lodash,c={grad:.9,turn:360,rad:360/(2*Math.PI)},l=function(t){return"string"==typeof t?t.length>0:"number"==typeof t},d=function(t,e,a){return void 0===e&&(e=0),void 0===a&&(a=Math.pow(10,e)),Math.round(a*t)/a+0},u=function(t,e,a){return void 0===e&&(e=0),void 0===a&&(a=1),t>a?a:t>e?t:e},p=function(t){return(t=isFinite(t)?t%360:0)>0?t:t+360},f=function(t){return{r:u(t.r,0,255),g:u(t.g,0,255),b:u(t.b,0,255),a:u(t.a)}},h=function(t){return{r:d(t.r),g:d(t.g),b:d(t.b),a:d(t.a,3)}},g=/^#([0-9a-f]{3,8})$/i,b=function(t){var e=t.toString(16);return e.length<2?"0"+e:e},v=function(t){var e=t.r,a=t.g,n=t.b,r=t.a,o=Math.max(e,a,n),i=o-Math.min(e,a,n),s=i?o===e?(a-n)/i:o===a?2+(n-e)/i:4+(e-a)/i:0;return{h:60*(s<0?s+6:s),s:o?i/o*100:0,v:o/255*100,a:r}},w=function(t){var e=t.h,a=t.s,n=t.v,r=t.a;e=e/360*6,a/=100,n/=100;var o=Math.floor(e),i=n*(1-a),s=n*(1-(e-o)*a),c=n*(1-(1-e+o)*a),l=o%6;return{r:255*[n,s,i,i,c,n][l],g:255*[c,n,n,s,i,i][l],b:255*[i,i,c,n,n,s][l],a:r}},_=function(t){return{h:p(t.h),s:u(t.s,0,100),l:u(t.l,0,100),a:u(t.a)}},m=function(t){return{h:d(t.h),s:d(t.s),l:d(t.l),a:d(t.a,3)}},y=function(t){return w((a=(e=t).s,{h:e.h,s:(a*=((n=e.l)<50?n:100-n)/100)>0?2*a/(n+a)*100:0,v:n+a,a:e.a}));var e,a,n},k=function(t){return{h:(e=v(t)).h,s:(r=(200-(a=e.s))*(n=e.v)/100)>0&&r<200?a*n/100/(r<=100?r:200-r)*100:0,l:r/2,a:e.a};var e,a,n,r},C=/^hsla?\(\s*([+-]?\d*\.?\d+)(deg|rad|grad|turn)?\s*,\s*([+-]?\d*\.?\d+)%\s*,\s*([+-]?\d*\.?\d+)%\s*(?:,\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,x=/^hsla?\(\s*([+-]?\d*\.?\d+)(deg|rad|grad|turn)?\s+([+-]?\d*\.?\d+)%\s+([+-]?\d*\.?\d+)%\s*(?:\/\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,M=/^rgba?\(\s*([+-]?\d*\.?\d+)(%)?\s*,\s*([+-]?\d*\.?\d+)(%)?\s*,\s*([+-]?\d*\.?\d+)(%)?\s*(?:,\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,N=/^rgba?\(\s*([+-]?\d*\.?\d+)(%)?\s+([+-]?\d*\.?\d+)(%)?\s+([+-]?\d*\.?\d+)(%)?\s*(?:\/\s*([+-]?\d*\.?\d+)(%)?\s*)?\)$/i,A={string:[[function(t){var e=g.exec(t);return e?(t=e[1]).length<=4?{r:parseInt(t[0]+t[0],16),g:parseInt(t[1]+t[1],16),b:parseInt(t[2]+t[2],16),a:4===t.length?d(parseInt(t[3]+t[3],16)/255,2):1}:6===t.length||8===t.length?{r:parseInt(t.substr(0,2),16),g:parseInt(t.substr(2,2),16),b:parseInt(t.substr(4,2),16),a:8===t.length?d(parseInt(t.substr(6,2),16)/255,2):1}:null:null},"hex"],[function(t){var e=M.exec(t)||N.exec(t);return e?e[2]!==e[4]||e[4]!==e[6]?null:f({r:Number(e[1])/(e[2]?100/255:1),g:Number(e[3])/(e[4]?100/255:1),b:Number(e[5])/(e[6]?100/255:1),a:void 0===e[7]?1:Number(e[7])/(e[8]?100:1)}):null},"rgb"],[function(t){var e=C.exec(t)||x.exec(t);if(!e)return null;var a,n,r=_({h:(a=e[1],n=e[2],void 0===n&&(n="deg"),Number(a)*(c[n]||1)),s:Number(e[3]),l:Number(e[4]),a:void 0===e[5]?1:Number(e[5])/(e[6]?100:1)});return y(r)},"hsl"]],object:[[function(t){var e=t.r,a=t.g,n=t.b,r=t.a,o=void 0===r?1:r;return l(e)&&l(a)&&l(n)?f({r:Number(e),g:Number(a),b:Number(n),a:Number(o)}):null},"rgb"],[function(t){var e=t.h,a=t.s,n=t.l,r=t.a,o=void 0===r?1:r;if(!l(e)||!l(a)||!l(n))return null;var i=_({h:Number(e),s:Number(a),l:Number(n),a:Number(o)});return y(i)},"hsl"],[function(t){var e=t.h,a=t.s,n=t.v,r=t.a,o=void 0===r?1:r;if(!l(e)||!l(a)||!l(n))return null;var i=function(t){return{h:p(t.h),s:u(t.s,0,100),v:u(t.v,0,100),a:u(t.a)}}({h:Number(e),s:Number(a),v:Number(n),a:Number(o)});return w(i)},"hsv"]]},F=function(t,e){for(var a=0;a<e.length;a++){var n=e[a][0](t);if(n)return[n,e[a][1]]}return[null,void 0]},P=function(t,e){var a=k(t);return{h:a.h,s:u(a.s+100*e,0,100),l:a.l,a:a.a}},z=function(t){return(299*t.r+587*t.g+114*t.b)/1e3/255},I=function(t,e){var a=k(t);return{h:a.h,s:a.s,l:u(a.l+100*e,0,100),a:a.a}},E=function(){function t(t){this.parsed=function(t){return"string"==typeof t?F(t.trim(),A.string):"object"==typeof t&&null!==t?F(t,A.object):[null,void 0]}(t)[0],this.rgba=this.parsed||{r:0,g:0,b:0,a:1}}return t.prototype.isValid=function(){return null!==this.parsed},t.prototype.brightness=function(){return d(z(this.rgba),2)},t.prototype.isDark=function(){return z(this.rgba)<.5},t.prototype.isLight=function(){return z(this.rgba)>=.5},t.prototype.toHex=function(){return e=(t=h(this.rgba)).r,a=t.g,n=t.b,o=(r=t.a)<1?b(d(255*r)):"","#"+b(e)+b(a)+b(n)+o;var t,e,a,n,r,o},t.prototype.toRgb=function(){return h(this.rgba)},t.prototype.toRgbString=function(){return e=(t=h(this.rgba)).r,a=t.g,n=t.b,(r=t.a)<1?"rgba("+e+", "+a+", "+n+", "+r+")":"rgb("+e+", "+a+", "+n+")";var t,e,a,n,r},t.prototype.toHsl=function(){return m(k(this.rgba))},t.prototype.toHslString=function(){return e=(t=m(k(this.rgba))).h,a=t.s,n=t.l,(r=t.a)<1?"hsla("+e+", "+a+"%, "+n+"%, "+r+")":"hsl("+e+", "+a+"%, "+n+"%)";var t,e,a,n,r},t.prototype.toHsv=function(){return t=v(this.rgba),{h:d(t.h),s:d(t.s),v:d(t.v),a:d(t.a,3)};var t},t.prototype.invert=function(){return T({r:255-(t=this.rgba).r,g:255-t.g,b:255-t.b,a:t.a});var t},t.prototype.saturate=function(t){return void 0===t&&(t=.1),T(P(this.rgba,t))},t.prototype.desaturate=function(t){return void 0===t&&(t=.1),T(P(this.rgba,-t))},t.prototype.grayscale=function(){return T(P(this.rgba,-1))},t.prototype.lighten=function(t){return void 0===t&&(t=.1),T(I(this.rgba,t))},t.prototype.darken=function(t){return void 0===t&&(t=.1),T(I(this.rgba,-t))},t.prototype.rotate=function(t){return void 0===t&&(t=15),this.hue(this.hue()+t)},t.prototype.alpha=function(t){return"number"==typeof t?T({r:(e=this.rgba).r,g:e.g,b:e.b,a:t}):d(this.rgba.a,3);var e},t.prototype.hue=function(t){var e=k(this.rgba);return"number"==typeof t?T({h:t,s:e.s,l:e.l,a:e.a}):d(e.h)},t.prototype.isEqual=function(t){return this.toHex()===T(t).toHex()},t}(),T=function(t){return t instanceof E?t:new E(t)},W=[],$=function(t){var e=t/255;return e<.04045?e/12.92:Math.pow((e+.055)/1.055,2.4)},S=function(t){return.2126*$(t.r)+.7152*$(t.g)+.0722*$(t.b)};function j(t){t.prototype.luminance=function(){return t=S(this.rgba),void 0===(e=2)&&(e=0),void 0===a&&(a=Math.pow(10,e)),Math.round(a*t)/a+0;var t,e,a},t.prototype.contrast=function(e){void 0===e&&(e="#FFF");var a,n,r,o,i,s,c,l=e instanceof t?e:new t(e);return o=this.rgba,i=l.toRgb(),a=(s=S(o))>(c=S(i))?(s+.05)/(c+.05):(c+.05)/(s+.05),void 0===(n=2)&&(n=0),void 0===r&&(r=Math.pow(10,n)),Math.floor(r*a)/r+0},t.prototype.isReadable=function(t,e){return void 0===t&&(t="#FFF"),void 0===e&&(e={}),this.contrast(t)>=(i=void 0===(o=(a=e).size)?"normal":o,"AAA"===(r=void 0===(n=a.level)?"AA":n)&&"normal"===i?7:"AA"===r&&"large"===i?3:4.5);var a,n,r,o,i}}var H=function(t,e,a){return void 0===e&&(e=0),void 0===a&&(a=1),t>a?a:t>e?t:e},O=function(t){var e=t/255;return e<.04045?e/12.92:Math.pow((e+.055)/1.055,2.4)},R=function(t){return 255*(t>.0031308?1.055*Math.pow(t,1/2.4)-.055:12.92*t)},V=96.422,B=82.521,D=216/24389,L=24389/27,q=function(t){var e=function(t){var e=O(t.r),a=O(t.g),n=O(t.b);return function(t){return{x:H(t.x,0,V),y:H(t.y,0,100),z:H(t.z,0,B),a:H(t.a)}}(function(t){return{x:1.0478112*t.x+.0228866*t.y+-.050127*t.z,y:.0295424*t.x+.9904844*t.y+-.0170491*t.z,z:-.0092345*t.x+.0150436*t.y+.7521316*t.z,a:t.a}}({x:100*(.4124564*e+.3575761*a+.1804375*n),y:100*(.2126729*e+.7151522*a+.072175*n),z:100*(.0193339*e+.119192*a+.9503041*n),a:t.a}))}(t),a=e.x/V,n=e.y/100,r=e.z/B;return a=a>D?Math.cbrt(a):(L*a+16)/116,{l:116*(n=n>D?Math.cbrt(n):(L*n+16)/116)-16,a:500*(a-n),b:200*(n-(r=r>D?Math.cbrt(r):(L*r+16)/116)),alpha:e.a}};function X(t){function e(t,e,a){void 0===a&&(a=5);for(var n=[],r=1/(a-1),o=0;o<=a-1;o++)n.push(t.mix(e,r*o));return n}t.prototype.mix=function(e,a){void 0===a&&(a=.5);var n=e instanceof t?e:new t(e),r=function(t,e,a){var n,r=q(t),o=q(e);return function(t){var e=(t.l+16)/116,a=t.a/500+e,n=e-t.b/200;return function(t){var e,a,n=.9555766*(e=t).x+-.0230393*e.y+.0631636*e.z,r=-.0282895*e.x+1.0099416*e.y+.0210077*e.z,o=.0122982*e.x+-.020483*e.y+1.3299098*e.z;return a={r:R(.032404542*n-.015371385*r-.004985314*o),g:R(-.00969266*n+.018760108*r+41556e-8*o),b:R(556434e-9*n-.002040259*r+.010572252*o),a:t.a},{r:H(a.r,0,255),g:H(a.g,0,255),b:H(a.b,0,255),a:H(a.a)}}({x:(Math.pow(a,3)>D?Math.pow(a,3):(116*a-16)/L)*V,y:100*(t.l>8?Math.pow((t.l+16)/116,3):t.l/L),z:(Math.pow(n,3)>D?Math.pow(n,3):(116*n-16)/L)*B,a:t.alpha})}({l:H((n={l:r.l*(1-a)+o.l*a,a:r.a*(1-a)+o.a*a,b:r.b*(1-a)+o.b*a,alpha:r.alpha*(1-a)+o.alpha*a}).l,0,400),a:n.a,b:n.b,alpha:H(n.alpha)})}(this.toRgb(),n.toRgb(),a);return new t(r)},t.prototype.tints=function(t){return e(this,"#fff",t)},t.prototype.shades=function(t){return e(this,"#000",t)},t.prototype.tones=function(t){return e(this,"#808080",t)}}const{select:G,subscribe:J}=wp.data,Q=i().noConflict();window.acfWatchChanges=function(t){const{group:e,acfFields:n,postTypeTest:r}=t;let o=!0;function i(t){switch(t.type){case"checkbox":t.val=Q(t.acf).is(":checked");break;case"em":t.val=parseFloat(t.val)+"em";break;case"rem":t.val=parseFloat(t.val)+"rem";break;case"string":t.val=Q("<div>").text(t.val).html();break;case"integer":case"int":t.val=parseInt(t.val);break;case"float":t.val=parseFloat(t.val);break;case"file":if(wp.api?.models?.Media&&t.val&&t.val.toString().length){var e=new wp.api.models.Media({id:t.val});return t.val=e.fetch(),new Promise((a=>{e.fetch().then((e=>{e.media_details?.sizes?.full?.source_url&&(t.val=`url("${e.media_details.sizes.full.source_url}")`),a(t)}))}))}}return new Promise((e=>{e(t)}))}function c(t,e){return new Promise((a=>{function n(){Array.isArray(t)||(t=[t]);const a=e.find(t.join(","));return!(!a||a.length<t.length)}if(n())return a();const r=J((()=>{n&&(a(),r())}))}))}function l(){if(!window?.wp?.blocks)return;const t=J((()=>{if(!wp?.data?.select)return;const l=wp.data.select("core/editor").getCurrentPostType();if(!l)return;const d=wp.data.select("core").getPostType(l);if(d){if(r(d)){!function(t){t.forEach((function(t){W.indexOf(t)<0&&(t(E,A),W.push(t))}))}([j,X]);const t=a(317);document.querySelector("#cmls-acf_post_title")||window.acfWatchChanges.$inContext(".editor-styles-wrapper").prepend(`\n\t\t\t\t\t<style id="cmls-acf_post_title">${t}</style>\n\t\t\t\t`),function(t,e=!1){return new Promise((a=>{function n(){const a=e?Q(t):document.querySelector(t);return!!(e&&a.length||!e&&a)&&a}const r=n();if(r)return a(r);const o=J((()=>{const t=n();t&&(a(t),o())}))}))}(e,!0).then((t=>{async function e(){await c(Object.values(n).map((t=>t.acf)),Q(document.body));var t=[];for(let s of Object.values(n)){let l=Q(s.acf);s.val=l.val(),s=await i(s),"function"!=typeof s.action?(s.callback&&"function"==typeof s.callback&&s.callback(s),t.push(s)):s.action(s.val)}const e=[],a=[],r={};if(t.forEach((t=>{(o&&t.val||t.hasOwnProperty("oldVal")&&t.val!==t.oldVal)&&(t.triggersHasBackground&&e.push(t),t.contrastCheck&&a.push(t)),"setCssVar"===t.action&&(r[`--page_title-${t.key}`]=t.val.toString()),t.oldVal=t.val})),o=!1,Object.keys(r).length&&window.acfWatchChanges.$inContext(".editor-styles-wrapper").css(r),e.length&&(e.filter((t=>t.val))?window.acfWatchChanges.$inContext(".editor-styles-wrapper").addClass("has-header-background"):window.acfWatchChanges.$inContext(".editor-styles-wrapper").removeClass("has-header-background")),a.length){function d(t){const e=n?.[t.contrastCheck.against];e&&c([t,e].map((t=>t.contrastCheck.computeFrom)),window.acfWatchChanges.$inContext("body")).then((()=>{const a={foreground:null,background:null};for(const n of[t,e]){let t=n.val;if(!n.val){const e=window.acfWatchChanges.$inContext("body").find(n.contrastCheck.computeFrom).get(0);t=getComputedStyle(e)[n.contrastCheck.computeAttribute]}a[n.contrastCheck.position.toLowerCase()]=t}if(!Object.values(a).filter(Boolean).length)return;const n=window.acfWatchChanges.getBasicContext().get(0),r=T(getComputedStyle(n).backgroundColor);a.foreground=T(a.foreground),a.background=T(a.background);const o=a.background.mix(r,1-a.background.alpha()),i=a.foreground.mix(o,1-a.foreground.alpha());T(i).isReadable(a.background,{level:"AA",size:"large"})?wp.data.dispatch("core/notices").removeNotice("cmls-a11y-warning"):wp.data.dispatch("core/notices").createWarningNotice("<span style='font-size:1.15em'>🚨This page's header may be difficult to read!</span>",{id:"cmls-a11y-warning",isDismissible:!1,speak:!0,__unstableHTML:!0,actions:[{onClick:()=>{window.open("https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html","_blank")},label:"WCAG 2.0 accessibility Guidelines, Level AA"}]})}))}a.forEach(d)}}t.on(`change.${window.THEME_PREFIX} keyup.${window.THEME_PREFIX}`,Object.values(n).map((t=>t.acf)).join(","),(0,s.debounce)(e,200,{trailing:!0})),e()}))}t()}}))}this.getBasicContext=()=>Q(".editor-styles-wrapper").add(Q('iframe[name="editor-canvas"]').contents().find(".editor-styles-wrapper")),this.$inContext=t=>Q(t).add(Q('iframe[name="editor-canvas"]').contents().find(t)),Q((()=>{const t=J((()=>{G("core/editor").__unstableIsEditorReady()&&(l(),t())}))}))},window.acfWatchChanges.getBasicContext=()=>Q(".editor-styles-wrapper").add(Q('iframe[name="editor-canvas"]').contents().find(".editor-styles-wrapper")),window.acfWatchChanges.$inContext=t=>Q(t).add(Q('iframe[name="editor-canvas"]').contents().find(t)),new acfWatchChanges({postTypeTest:t=>t.hierarchical,group:"#acf-group_5f467bc4cb553",acfFields:{"#acf-field_5f467c3c135f3":{key:"title-hidden",type:"checkbox",acf:"#acf-field_5f467c3c135f3",action:t=>{if(t)return window.acfWatchChanges.getBasicContext().addClass("has-hidden-post-title"),void window.wp.data.dispatch("core/notices").createNotice("info","🤫 This post's title is hidden",{isDismissible:!1,id:"has-hidden-post-title"});window.wp.data.dispatch("core/notices").removeNotice("has-hidden-post-title"),window.acfWatchChanges.getBasicContext().removeClass("has-hidden-post-title")}},"#acf-field_5f46f4d6962ca":{key:"title-alt",type:"string",acf:"#acf-field_5f46f4d6962ca",action:t=>{if(t&&t.toString().length)return window.acfWatchChanges.getBasicContext().addClass("has-alt-title"),void window.wp.data.dispatch("core/notices").createNotice("info","🥸 This post uses an alternate display title",{isDismissible:!1,id:"has-alt-title"});window.wp.data.dispatch("core/notices").removeNotice("has-alt-title"),window.acfWatchChanges.getBasicContext().removeClass("has-alt-title")}},"acf[field_6140e29b2c51a][field_6140e2cb5b633]":{key:"background_color",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]',action:"setCssVar",triggersHasBackground:!0,contrastCheck:{against:"acf[field_6140e29b2c51a][field_6140e3aa5b638]",position:"background",computeFrom:".editor-styles-wrapper",computeAttribute:"backgroundColor"}},"acf[field_6140e29b2c51a][field_6140e3aa5b638]":{key:"title_color",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]',action:"setCssVar",contrastCheck:{against:"acf[field_6140e29b2c51a][field_6140e2cb5b633]",position:"foreground",computeFrom:".edit-post-visual-editor__post-title-wrapper",computeAttribute:"color"}},"acf[field_6140e29b2c51a][field_6140e95fd3f2a]":{key:"margin_below_header",type:"em",acf:'input[name="acf[field_6140e29b2c51a][field_6140e95fd3f2a]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e3d15b639]":{key:"title_shadow_opacity",type:"float",acf:'input[name="acf[field_6140e29b2c51a][field_6140e3d15b639]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e2ef5b634]":{key:"background_image",type:"file",acf:'input[name="acf[field_6140e29b2c51a][field_6140e2ef5b634]"]',action:"setCssVar",triggersHasBackground:!0},"acf[field_6140e29b2c51a][field_6140e31c5b635]":{key:"background_size",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e31c5b635]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e3455b636]":{key:"background_position",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e3455b636]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e38b5b637]":{key:"background_repeat",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e38b5b637]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_62648f5f80441]":{key:"padding",type:"rem",acf:'input[name="acf[field_6140e29b2c51a][field_62648f5f80441]"]',action:"setCssVar"}}}),(()=>{if(!window?.wp?.blocks)return;const t=document.createElement("style");t.innerHTML="\n\t\t.editor-post-panel__row:has(.editor-post-sticky__toggle-control),\n\t\t.editor-post-sticky__toggle-control,\n\t\t#sticky-span { display: none !important; }\n\t",document.body.appendChild(t);let e=null;const{select:a,subscribe:n}=wp.data,r=n((()=>{if(!a("core/editor").__unstableIsEditorReady())return;if(e=a("core/editor").getEditedPostAttribute("sticky"),null==e)return;const t=Array.from(document.querySelectorAll(".edit-post-post-status .components-panel__row")).find((t=>"Stick to the top of the blog"===t.innerText));t&&(r(),t.style.display="none",e&&(wp.data.dispatch("core/editor").editPost({sticky:!1}),wp.data.dispatch("core/editor").savePost()))}))})()}()}();