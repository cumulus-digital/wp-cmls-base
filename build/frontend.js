!function(){var t={124:function(t,e,n){var r=n(325);t.exports=function(){return r.Date.now()}},128:function(t,e,n){var r=n(800),o=/^\s+/;t.exports=function(t){return t?t.slice(0,r(t)+1).replace(o,""):t}},221:function(t,e,n){var r=n(805),o=n(124),i=n(374),a=Math.max,c=Math.min;t.exports=function(t,e,n){var s,u,l,d,f,m,v=0,g=!1,b=!1,p=!0;if("function"!=typeof t)throw new TypeError("Expected a function");function h(e){var n=s,r=u;return s=u=void 0,v=e,d=t.apply(r,n)}function y(t){var n=t-m;return void 0===m||n>=e||n<0||b&&t-v>=l}function w(){var t=o();if(y(t))return x(t);f=setTimeout(w,function(t){var n=e-(t-m);return b?c(n,l-(t-v)):n}(t))}function x(t){return f=void 0,p&&s?h(t):(s=u=void 0,d)}function E(){var t=o(),n=y(t);if(s=arguments,u=this,m=t,n){if(void 0===f)return function(t){return v=t,f=setTimeout(w,e),g?h(t):d}(m);if(b)return clearTimeout(f),f=setTimeout(w,e),h(m)}return void 0===f&&(f=setTimeout(w,e)),d}return e=i(e)||0,r(n)&&(g=!!n.leading,l=(b="maxWait"in n)?a(i(n.maxWait)||0,e):l,p="trailing"in n?!!n.trailing:p),E.cancel=function(){void 0!==f&&clearTimeout(f),v=0,s=m=u=f=void 0},E.flush=function(){return void 0===f?d:x(o())},E}},325:function(t,e,n){var r=n(840),o="object"==typeof self&&self&&self.Object===Object&&self,i=r||o||Function("return this")();t.exports=i},346:function(t){t.exports=function(t){return null!=t&&"object"==typeof t}},350:function(t,e,n){var r=n(221),o=n(805);t.exports=function(t,e,n){var i=!0,a=!0;if("function"!=typeof t)throw new TypeError("Expected a function");return o(n)&&(i="leading"in n?!!n.leading:i,a="trailing"in n?!!n.trailing:a),r(t,e,{leading:i,maxWait:e,trailing:a})}},374:function(t,e,n){var r=n(128),o=n(805),i=n(394),a=/^[-+]0x[0-9a-f]+$/i,c=/^0b[01]+$/i,s=/^0o[0-7]+$/i,u=parseInt;t.exports=function(t){if("number"==typeof t)return t;if(i(t))return NaN;if(o(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=o(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=r(t);var n=c.test(t);return n||s.test(t)?u(t.slice(2),n?2:8):a.test(t)?NaN:+t}},394:function(t,e,n){var r=n(552),o=n(346);t.exports=function(t){return"symbol"==typeof t||o(t)&&"[object Symbol]"==r(t)}},552:function(t,e,n){var r=n(873),o=n(659),i=n(969),a=r?r.toStringTag:void 0;t.exports=function(t){return null==t?void 0===t?"[object Undefined]":"[object Null]":a&&a in Object(t)?o(t):i(t)}},659:function(t,e,n){var r=n(873),o=Object.prototype,i=o.hasOwnProperty,a=o.toString,c=r?r.toStringTag:void 0;t.exports=function(t){var e=i.call(t,c),n=t[c];try{t[c]=void 0;var r=!0}catch(t){}var o=a.call(t);return r&&(e?t[c]=n:delete t[c]),o}},685:function(){window.THEME_PREFIX="cmls_base"},800:function(t){var e=/\s/;t.exports=function(t){for(var n=t.length;n--&&e.test(t.charAt(n)););return n}},805:function(t){t.exports=function(t){var e=typeof t;return null!=t&&("object"==e||"function"==e)}},840:function(t,e,n){var r="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g;t.exports=r},850:function(){window.cmlsExtraScrollMargin=new class{margins={};setMargin(){const t=[...Object.values(this.margins)];t.length?window.document.documentElement.style.setProperty("--cmls_base-extra-scroll-margin-top",`calc(${t.join(" + ")})`):window.document.documentElement.style.removeProperty("--cmls_base-extra-scroll-margin-top")}add(t,e){this.margins[t]=e,this.setMargin()}remove(t){delete this.margins[t],this.setMargin()}}},873:function(t,e,n){var r=n(325).Symbol;t.exports=r},969:function(t){var e=Object.prototype.toString;t.exports=function(t){return e.call(t)}}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,{a:e}),e},n.d=function(t,e){for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"==typeof window)return window}}(),n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},function(){"use strict";n(685);var t=n(350),e=n.n(t),r=window.jQuery,o=n.n(r);!function(t,n){function r(){let t=10,e=document.querySelector("body > main"),n=document.querySelector("body > .masthead"),r=e.getBoundingClientRect(),o=n.getBoundingClientRect(),i=document.body.classList.contains("begin_under_masthead"),a=document.body.classList.contains("under-masthead");i&&(t=2*o.bottom),r.y+t<o.bottom?a||document.body.classList.add("under-masthead"):a&&document.body.classList.remove("under-masthead")}var o,i;o=[{event:"scroll",throttleTime:200},{event:"resize",throttleTime:1e3},{place:document,event:"DOMContentLoaded"},{event:"load"}],i=r,Array.isArray(o)||(o=[{event:o,throttleTime:null}]),o.forEach((function(r){const o=r?.place||n;let a=i;r.throttleTime&&(a=e()(i,r.throttleTime)),t(o).on(r.event+".cmlsBase",a)})),i(),r()}(o().noConflict(),window);var i=n(221),a=n.n(i);!function(t,e){var n=function(){var t,e=document.createElement("fakeelement"),n={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in n)if(void 0!==e.style[t])return n[t]}(),r=!1;function o(){t("#header_menu").removeClass("is-open"),t("body").removeClass("menu-active"),t("body > header .hamburger").removeClass("is-active").attr({"aria-label":"Open menu","aria-expanded":!1}),r=!1}t("html").on(`click.${e.THEME_PREFIX} focusin.${e.THEME_PREFIX}`,a()((function(e){const i={menu:t("body > header .menu-container *"),hamburger:t("body > header .hamburger")};if(i.menu.is(e.target)||i.menu.has(e.target).length)return(i.hamburger.is(e.target)||i.hamburger.has(e.target).length)&&r?(o(),void i.hamburger.blur()):(t("#header_menu").one(n,(function(e){t(this).addClass("is-open")})),t("body").addClass("menu-active"),t("body > header .hamburger").addClass("is-active").attr({"aria-label":"Close menu","aria-expanded":!0}),void(r=!0));o()}),200,{leading:!0,trailing:!1}))}(o().noConflict(),window.self),n(850),o()((()=>{const t=document.querySelectorAll('iframe[src*="jotform.com"],iframe[data-src*="jotform.com"]');t?.length&&(t.forEach((t=>{function e(t){const e=window.location.search.substring(1);return t+(t.indexOf("?")>-1?"&":"?")+e}if(t.addEventListener("load",(function t(e){e.target.removeEventListener("load",t),e.target.addEventListener("load",(()=>window.parent.scrollTo(0,0)))}),{once:!0}),t.getAttribute("data-src")){const n=t.getAttribute("class");"OneTrust"in window&&n&&(n.includes("optanon-category")||t.getAttribute("data-ot-ignore"))?t.setAttribute("data-src",e(t.getAttribute("data-src"))):t.setAttribute("src",e(t.getAttribute("data-src")))}else t.getAttribute("src")&&t.setAttribute("src",e(t.getAttribute("src")))})),window.addEventListener("message",(t=>{if("object"==typeof t.data||"https://form.jotform.com"!==t?.origin)return void console.log(t.origin,"https://form.jotform.com"!==t.origin);const e=t.data.split(":");if(!e||e.length<2)return;const n=e=>{[...document.querySelectorAll('iframe[src*="jotform.com"],iframe[data-src*="jotform.com"]')].some((n=>{if(n.contentWindow==t.source)return e(n),!1}))};switch(e[0]){case"scrollIntoView":n((t=>{t.scrollIntoView({block:"center"})}));break;case"setHeight":parseInt(e[1])>0&&n((t=>{t.setAttribute("height",e[1]+"px")}));break;case"reloadPage":window.self.location.reload();break;case"loadScript":break;case"exitFullScreen":["exitFullscreen","mozCancelFullscreen","webkitExitFullscreen","msExitFullscreen"].some((t=>{if(window.document[t])return window.document[t](),!1}))}n((t=>{if(t?.contentWindow?.postMessage){var e={docurl:encodeURIComponent(document.URL),referrer:encodeURIComponent(document.referrer)};t.contentWindow.postMessage(JSON.stringify({type:"urls",value:e}))}}))}),!1))})),document.querySelector("html").className.replace("no-js","js");const c=()=>{const t=.01*window.innerHeight;document.documentElement.style.setProperty("--vh",`${t}px`)};document.addEventListener("DOMContentLoaded",c),addEventListener("load",c),addEventListener("resize",e()(c,800)),addEventListener("load",(()=>{let t=location.search.match(/(\??query\-(\d+)\-page)/);if(t&&!location?.hash?.length){let e=document.querySelector(`[href*="${t[0]}"]`);if(e){let t=e.closest(".wp-block-query");t&&t.scrollIntoView({behavior:"smooth",block:"nearest"})}}}))}()}();