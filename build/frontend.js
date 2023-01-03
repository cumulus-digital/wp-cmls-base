!function(){var t={241:function(){"document"in window.self&&((!("classList"in document.createElement("_"))||document.createElementNS&&!("classList"in document.createElementNS("http://www.w3.org/2000/svg","g")))&&function(t){"use strict";if("Element"in t){var e="classList",n="prototype",r=t.Element[n],o=Object,i=String[n].trim||function(){return this.replace(/^\s+|\s+$/g,"")},a=Array[n].indexOf||function(t){for(var e=0,n=this.length;e<n;e++)if(e in this&&this[e]===t)return e;return-1},c=function(t,e){this.name=t,this.code=DOMException[t],this.message=e},u=function(t,e){if(""===e)throw new c("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(e))throw new c("INVALID_CHARACTER_ERR","String contains an invalid character");return a.call(t,e)},s=function(t){for(var e=i.call(t.getAttribute("class")||""),n=e?e.split(/\s+/):[],r=0,o=n.length;r<o;r++)this.push(n[r]);this._updateClassName=function(){t.setAttribute("class",this.toString())}},l=s[n]=[],f=function(){return new s(this)};if(c[n]=Error[n],l.item=function(t){return this[t]||null},l.contains=function(t){return-1!==u(this,t+="")},l.add=function(){var t,e=arguments,n=0,r=e.length,o=!1;do{t=e[n]+"",-1===u(this,t)&&(this.push(t),o=!0)}while(++n<r);o&&this._updateClassName()},l.remove=function(){var t,e,n=arguments,r=0,o=n.length,i=!1;do{for(t=n[r]+"",e=u(this,t);-1!==e;)this.splice(e,1),i=!0,e=u(this,t)}while(++r<o);i&&this._updateClassName()},l.toggle=function(t,e){t+="";var n=this.contains(t),r=n?!0!==e&&"remove":!1!==e&&"add";return r&&this[r](t),!0===e||!1===e?e:!n},l.toString=function(){return this.join(" ")},o.defineProperty){var d={get:f,enumerable:!0,configurable:!0};try{o.defineProperty(r,e,d)}catch(t){void 0!==t.number&&-2146823252!==t.number||(d.enumerable=!1,o.defineProperty(r,e,d))}}else o[n].__defineGetter__&&r.__defineGetter__(e,f)}}(window.self),function(){"use strict";var t=document.createElement("_");if(t.classList.add("c1","c2"),!t.classList.contains("c2")){var e=function(t){var e=DOMTokenList.prototype[t];DOMTokenList.prototype[t]=function(t){var n,r=arguments.length;for(n=0;n<r;n++)t=arguments[n],e.call(this,t)}};e("add"),e("remove")}if(t.classList.toggle("c3",!1),t.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(t,e){return 1 in arguments&&!this.contains(t)==!e?e:n.call(this,t)}}t=null}())},705:function(t,e,n){var r=n(639).Symbol;t.exports=r},239:function(t,e,n){var r=n(705),o=n(607),i=n(333),a=r?r.toStringTag:void 0;t.exports=function(t){return null==t?void 0===t?"[object Undefined]":"[object Null]":a&&a in Object(t)?o(t):i(t)}},561:function(t,e,n){var r=n(990),o=/^\s+/;t.exports=function(t){return t?t.slice(0,r(t)+1).replace(o,""):t}},957:function(t,e,n){var r="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g;t.exports=r},607:function(t,e,n){var r=n(705),o=Object.prototype,i=o.hasOwnProperty,a=o.toString,c=r?r.toStringTag:void 0;t.exports=function(t){var e=i.call(t,c),n=t[c];try{t[c]=void 0;var r=!0}catch(t){}var o=a.call(t);return r&&(e?t[c]=n:delete t[c]),o}},333:function(t){var e=Object.prototype.toString;t.exports=function(t){return e.call(t)}},639:function(t,e,n){var r=n(957),o="object"==typeof self&&self&&self.Object===Object&&self,i=r||o||Function("return this")();t.exports=i},990:function(t){var e=/\s/;t.exports=function(t){for(var n=t.length;n--&&e.test(t.charAt(n)););return n}},279:function(t,e,n){var r=n(218),o=n(771),i=n(841),a=Math.max,c=Math.min;t.exports=function(t,e,n){var u,s,l,f,d,m,v=0,h=!1,p=!1,y=!0;if("function"!=typeof t)throw new TypeError("Expected a function");function b(e){var n=u,r=s;return u=s=void 0,v=e,f=t.apply(r,n)}function g(t){return v=t,d=setTimeout(E,e),h?b(t):f}function w(t){var n=t-m;return void 0===m||n>=e||n<0||p&&t-v>=l}function E(){var t=o();if(w(t))return x(t);d=setTimeout(E,function(t){var n=e-(t-m);return p?c(n,l-(t-v)):n}(t))}function x(t){return d=void 0,y&&u?b(t):(u=s=void 0,f)}function j(){var t=o(),n=w(t);if(u=arguments,s=this,m=t,n){if(void 0===d)return g(m);if(p)return clearTimeout(d),d=setTimeout(E,e),b(m)}return void 0===d&&(d=setTimeout(E,e)),f}return e=i(e)||0,r(n)&&(h=!!n.leading,l=(p="maxWait"in n)?a(i(n.maxWait)||0,e):l,y="trailing"in n?!!n.trailing:y),j.cancel=function(){void 0!==d&&clearTimeout(d),v=0,u=m=s=d=void 0},j.flush=function(){return void 0===d?f:x(o())},j}},218:function(t){t.exports=function(t){var e=typeof t;return null!=t&&("object"==e||"function"==e)}},5:function(t){t.exports=function(t){return null!=t&&"object"==typeof t}},448:function(t,e,n){var r=n(239),o=n(5);t.exports=function(t){return"symbol"==typeof t||o(t)&&"[object Symbol]"==r(t)}},771:function(t,e,n){var r=n(639);t.exports=function(){return r.Date.now()}},493:function(t,e,n){var r=n(279),o=n(218);t.exports=function(t,e,n){var i=!0,a=!0;if("function"!=typeof t)throw new TypeError("Expected a function");return o(n)&&(i="leading"in n?!!n.leading:i,a="trailing"in n?!!n.trailing:a),r(t,e,{leading:i,maxWait:e,trailing:a})}},841:function(t,e,n){var r=n(561),o=n(218),i=n(448),a=/^[-+]0x[0-9a-f]+$/i,c=/^0b[01]+$/i,u=/^0o[0-7]+$/i,s=parseInt;t.exports=function(t){if("number"==typeof t)return t;if(i(t))return NaN;if(o(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=o(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=r(t);var n=c.test(t);return n||u.test(t)?s(t.slice(2),n?2:8):a.test(t)?NaN:+t}}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,{a:e}),e},n.d=function(t,e){for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"==typeof window)return window}}(),n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},function(){"use strict";var t=n(493),e=n.n(t),r=(n(241),window.jQuery),o=n.n(r);!function(t,n,r){var o,i;o=[{event:"scroll",throttleTime:200},{event:"resize",throttleTime:1e3},{event:"DOMContentLoaded"},{event:"load"}],i=function(){var t=10,e=document.querySelector("body > main"),n=document.querySelector("body > .masthead"),r=e.getBoundingClientRect(),o=n.getBoundingClientRect(),i=document.body.classList.contains("begin_under_masthead"),a=document.body.classList.contains("under-masthead");i&&(t=2*o.bottom),r.y+t<o.bottom?a||document.body.classList.add("under-masthead"):a&&document.body.classList.remove("under-masthead")},Array.isArray(o)||(o=[{event:o,throttleTime:null}]),o.forEach((function(r){var o=i;r.throttleTime&&(o=e()(i,r.throttleTime)),t(n).on(r.event+".cmlsBase",o)})),i()}(o().noConflict(),window);var i=n(279),a=n.n(i);function c(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}function u(t){return u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},u(t)}function s(t){var e=function(t,e){if("object"!==u(t)||null===t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var r=n.call(t,"string");if("object"!==u(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(t)}(t);return"symbol"===u(e)?e:String(e)}function l(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,s(r.key),r)}}!function(t,e,n){var r=function(){var t,e=document.createElement("fakeelement"),n={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in n)if(void 0!==e.style[t])return n[t]}(),o=!1;function i(){t("#header_menu").removeClass("is-open"),t("body").removeClass("menu-active"),t("body > header .hamburger").removeClass("is-active").attr({"aria-label":"Open menu","aria-expanded":!1}),o=!1}t("html").on("click.".concat(e.THEME_PREFIX," focusin.").concat(e.THEME_PREFIX),a()((function(e){var n={menu:t("body > header .menu-container *"),hamburger:t("body > header .hamburger")};if(n.menu.is(e.target)||n.menu.has(e.target).length)return(n.hamburger.is(e.target)||n.hamburger.has(e.target).length)&&o?(i(),void n.hamburger.blur()):(t("#header_menu").one(r,(function(e){t(this).addClass("is-open")})),t("body").addClass("menu-active"),t("body > header .hamburger").addClass("is-active").attr({"aria-label":"Close menu","aria-expanded":!0}),void(o=!0));i()}),200,{leading:!0,trailing:!1}))}(o().noConflict(),window.self);var f=function(){function t(){var e,n,r;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),e=this,r={},(n=s(n="margins"))in e?Object.defineProperty(e,n,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[n]=r}var e,n;return e=t,(n=[{key:"setMargin",value:function(){var t,e=function(t){if(Array.isArray(t))return c(t)}(t=Object.values(this.margins))||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(t)||function(t,e){if(t){if("string"==typeof t)return c(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?c(t,e):void 0}}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}();e.length?window.document.documentElement.style.setProperty("--cmls_base-extra-scroll-margin-top","calc(".concat(e.join(" + "),")")):window.document.documentElement.style.removeProperty("--cmls_base-extra-scroll-margin-top")}},{key:"add",value:function(t,e){this.margins[t]=e,this.setMargin()}},{key:"remove",value:function(t){delete this.margins[t],this.setMargin()}}])&&l(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),t}();window.cmlsExtraScrollMargin=new f,document.querySelector("html").className.replace("no-js","js");var d=function(){var t=.01*window.innerHeight;document.documentElement.style.setProperty("--vh","".concat(t,"px"))};addEventListener("DOMContentLoaded",d),addEventListener("load",d),addEventListener("resize",e()(d,800)),addEventListener("load",(function(){var t,e,n=location.search.match(/(\??query\-(\d+)\-page)/);if(n&&(null===(t=location)||void 0===t||null===(e=t.hash)||void 0===e||!e.length)){var r=document.querySelector('[href*="'.concat(n[0],'"]'));if(r){var o=r.closest(".wp-block-query");o&&o.scrollIntoView({behavior:"smooth",block:"nearest"})}}}))}()}();