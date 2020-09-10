!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=23)}([function(t,e){!function(){t.exports=this.jQuery}()},,function(t,e){"document"in window.self&&((!("classList"in document.createElement("_"))||document.createElementNS&&!("classList"in document.createElementNS("http://www.w3.org/2000/svg","g")))&&function(t){"use strict";if("Element"in t){var e=t.Element.prototype,n=Object,r=String.prototype.trim||function(){return this.replace(/^\s+|\s+$/g,"")},o=Array.prototype.indexOf||function(t){for(var e=0,n=this.length;e<n;e++)if(e in this&&this[e]===t)return e;return-1},i=function(t,e){this.name=t,this.code=DOMException[t],this.message=e},a=function(t,e){if(""===e)throw new i("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(e))throw new i("INVALID_CHARACTER_ERR","String contains an invalid character");return o.call(t,e)},u=function(t){for(var e=r.call(t.getAttribute("class")||""),n=e?e.split(/\s+/):[],o=0,i=n.length;o<i;o++)this.push(n[o]);this._updateClassName=function(){t.setAttribute("class",this.toString())}},c=u.prototype=[],s=function(){return new u(this)};if(i.prototype=Error.prototype,c.item=function(t){return this[t]||null},c.contains=function(t){return-1!==a(this,t+="")},c.add=function(){var t,e=arguments,n=0,r=e.length,o=!1;do{t=e[n]+"",-1===a(this,t)&&(this.push(t),o=!0)}while(++n<r);o&&this._updateClassName()},c.remove=function(){var t,e,n=arguments,r=0,o=n.length,i=!1;do{for(t=n[r]+"",e=a(this,t);-1!==e;)this.splice(e,1),i=!0,e=a(this,t)}while(++r<o);i&&this._updateClassName()},c.toggle=function(t,e){t+="";var n=this.contains(t),r=n?!0!==e&&"remove":!1!==e&&"add";return r&&this[r](t),!0===e||!1===e?e:!n},c.toString=function(){return this.join(" ")},n.defineProperty){var l={get:s,enumerable:!0,configurable:!0};try{n.defineProperty(e,"classList",l)}catch(t){void 0!==t.number&&-2146823252!==t.number||(l.enumerable=!1,n.defineProperty(e,"classList",l))}}else n.prototype.__defineGetter__&&e.__defineGetter__("classList",s)}}(window.self),function(){"use strict";var t=document.createElement("_");if(t.classList.add("c1","c2"),!t.classList.contains("c2")){var e=function(t){var e=DOMTokenList.prototype[t];DOMTokenList.prototype[t]=function(t){var n,r=arguments.length;for(n=0;n<r;n++)t=arguments[n],e.call(this,t)}};e("add"),e("remove")}if(t.classList.toggle("c3",!1),t.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(t,e){return 1 in arguments&&!this.contains(t)==!e?e:n.call(this,t)}}t=null}())},function(t,e){t.exports=function(t){var e=typeof t;return null!=t&&("object"==e||"function"==e)}},function(t,e,n){var r=n(14),o="object"==typeof self&&self&&self.Object===Object&&self,i=r||o||Function("return this")();t.exports=i},function(t,e,n){var r=n(4).Symbol;t.exports=r},,,,function(t,e,n){},function(t,e,n){n(2);var r,o=n(11);function i(t,e,n,r){Array.isArray(t)||(t=[{event:t,throttleTime:n}]),t.forEach((function(t){cb=e,t.throttleTime&&(cb=o(e,t.throttleTime)),window.addEventListener(t.event,cb)})),r&&e()}function a(){var t=document.documentElement,e=(document.querySelector("body > .masthead").getBoundingClientRect(),window.innerHeight/100);r||(r=getComputedStyle(document.documentElement).getPropertyValue("--"+window.THEME_PREFIX+"-masthead-height")),e>12?t.style.setProperty("--"+window.THEME_PREFIX+"-masthead-height","90px"):e<8.3?t.style.setProperty("--"+window.THEME_PREFIX+"-masthead-height","65px"):t.style.setProperty("--"+window.THEME_PREFIX+"-masthead-height",r)}i([{event:"scroll",throttleTime:100},{event:"resize",throttleTime:1e3},{event:"DOMContentLoaded"},{event:"load"}],(function(){var t=document.querySelector("body > main"),e=document.querySelector("body > .masthead"),n=t.getBoundingClientRect(),r=e.getBoundingClientRect(),o=document.body.classList.contains("under-masthead");n.top+r.bottom+10<r.top+r.bottom?o||document.body.classList.add("under-masthead"):o&&document.body.classList.remove("under-masthead")}),null,!0),i([{event:"resize",throttleTime:1e3},{event:"DOMContentLoaded"},{event:"load"}],a,null,!0),setInterval(a,3e3)},function(t,e,n){var r=n(12),o=n(3);t.exports=function(t,e,n){var i=!0,a=!0;if("function"!=typeof t)throw new TypeError("Expected a function");return o(n)&&(i="leading"in n?!!n.leading:i,a="trailing"in n?!!n.trailing:a),r(t,e,{leading:i,maxWait:e,trailing:a})}},function(t,e,n){var r=n(3),o=n(13),i=n(16),a=Math.max,u=Math.min;t.exports=function(t,e,n){var c,s,l,f,d,p,m=0,h=!1,v=!1,y=!0;if("function"!=typeof t)throw new TypeError("Expected a function");function g(e){var n=c,r=s;return c=s=void 0,m=e,f=t.apply(r,n)}function b(t){return m=t,d=setTimeout(E,e),h?g(t):f}function w(t){var n=t-p;return void 0===p||n>=e||n<0||v&&t-m>=l}function E(){var t=o();if(w(t))return x(t);d=setTimeout(E,function(t){var n=e-(t-p);return v?u(n,l-(t-m)):n}(t))}function x(t){return d=void 0,y&&c?g(t):(c=s=void 0,f)}function T(){var t=o(),n=w(t);if(c=arguments,s=this,p=t,n){if(void 0===d)return b(p);if(v)return clearTimeout(d),d=setTimeout(E,e),g(p)}return void 0===d&&(d=setTimeout(E,e)),f}return e=i(e)||0,r(n)&&(h=!!n.leading,l=(v="maxWait"in n)?a(i(n.maxWait)||0,e):l,y="trailing"in n?!!n.trailing:y),T.cancel=function(){void 0!==d&&clearTimeout(d),m=0,c=p=s=d=void 0},T.flush=function(){return void 0===d?f:x(o())},T}},function(t,e,n){var r=n(4);t.exports=function(){return r.Date.now()}},function(t,e,n){(function(e){var n="object"==typeof e&&e&&e.Object===Object&&e;t.exports=n}).call(this,n(15))},function(t,e){var n;n=function(){return this}();try{n=n||new Function("return this")()}catch(t){"object"==typeof window&&(n=window)}t.exports=n},function(t,e,n){var r=n(3),o=n(17),i=/^\s+|\s+$/g,a=/^[-+]0x[0-9a-f]+$/i,u=/^0b[01]+$/i,c=/^0o[0-7]+$/i,s=parseInt;t.exports=function(t){if("number"==typeof t)return t;if(o(t))return NaN;if(r(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=r(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=t.replace(i,"");var n=u.test(t);return n||c.test(t)?s(t.slice(2),n?2:8):a.test(t)?NaN:+t}},function(t,e,n){var r=n(18),o=n(21);t.exports=function(t){return"symbol"==typeof t||o(t)&&"[object Symbol]"==r(t)}},function(t,e,n){var r=n(5),o=n(19),i=n(20),a=r?r.toStringTag:void 0;t.exports=function(t){return null==t?void 0===t?"[object Undefined]":"[object Null]":a&&a in Object(t)?o(t):i(t)}},function(t,e,n){var r=n(5),o=Object.prototype,i=o.hasOwnProperty,a=o.toString,u=r?r.toStringTag:void 0;t.exports=function(t){var e=i.call(t,u),n=t[u];try{t[u]=void 0;var r=!0}catch(t){}var o=a.call(t);return r&&(e?t[u]=n:delete t[u]),o}},function(t,e){var n=Object.prototype.toString;t.exports=function(t){return n.call(t)}},function(t,e){t.exports=function(t){return null!=t&&"object"==typeof t}},,function(t,e,n){"use strict";n.r(e);n(9),n(10);var r=n(0);!function(t,e,n){var r=function(){var t,e=document.createElement("fakeelement"),n={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in n)if(void 0!==e.style[t])return n[t]}(),o=!1;function i(){t("#header_menu").removeClass("is-open"),t("body").removeClass("menu-active"),t("body > header .hamburger").removeClass("is-active").attr({"aria-label":"Open menu","aria-expanded":!1}),o=!1}t("body > header .hamburger").click((function(e){if(e.stopPropagation(),o)return this.blur(),void i();this.focus(),t("#header_menu").one(r,(function(e){t(this).addClass("is-open")})),t("body").addClass("menu-active"),t("body > header .hamburger").addClass("is-active").attr({"aria-label":"Close menu","aria-expanded":!0}),o=!0})),t("html").click((function(t){o&&i()})),t("html").focusin((function(e){var n=t("body > header .hamburger, body > header .menu");n.is(e.target)||n.has(e.target).length||!o||i()}))}(n.n(r).a.noConflict(),window.self),document.querySelector("html").className.replace("no-js","js")}]);