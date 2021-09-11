!function(){var t={241:function(){"document"in window.self&&((!("classList"in document.createElement("_"))||document.createElementNS&&!("classList"in document.createElementNS("http://www.w3.org/2000/svg","g")))&&function(t){"use strict";if("Element"in t){var e="classList",n=t.Element.prototype,r=Object,o=String.prototype.trim||function(){return this.replace(/^\s+|\s+$/g,"")},i=Array.prototype.indexOf||function(t){for(var e=0,n=this.length;e<n;e++)if(e in this&&this[e]===t)return e;return-1},a=function(t,e){this.name=t,this.code=DOMException[t],this.message=e},u=function(t,e){if(""===e)throw new a("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(e))throw new a("INVALID_CHARACTER_ERR","String contains an invalid character");return i.call(t,e)},s=function(t){for(var e=o.call(t.getAttribute("class")||""),n=e?e.split(/\s+/):[],r=0,i=n.length;r<i;r++)this.push(n[r]);this._updateClassName=function(){t.setAttribute("class",this.toString())}},c=s.prototype=[],l=function(){return new s(this)};if(a.prototype=Error.prototype,c.item=function(t){return this[t]||null},c.contains=function(t){return-1!==u(this,t+="")},c.add=function(){var t,e=arguments,n=0,r=e.length,o=!1;do{t=e[n]+"",-1===u(this,t)&&(this.push(t),o=!0)}while(++n<r);o&&this._updateClassName()},c.remove=function(){var t,e,n=arguments,r=0,o=n.length,i=!1;do{for(t=n[r]+"",e=u(this,t);-1!==e;)this.splice(e,1),i=!0,e=u(this,t)}while(++r<o);i&&this._updateClassName()},c.toggle=function(t,e){t+="";var n=this.contains(t),r=n?!0!==e&&"remove":!1!==e&&"add";return r&&this[r](t),!0===e||!1===e?e:!n},c.toString=function(){return this.join(" ")},r.defineProperty){var f={get:l,enumerable:!0,configurable:!0};try{r.defineProperty(n,e,f)}catch(t){void 0!==t.number&&-2146823252!==t.number||(f.enumerable=!1,r.defineProperty(n,e,f))}}else r.prototype.__defineGetter__&&n.__defineGetter__(e,l)}}(window.self),function(){"use strict";var t=document.createElement("_");if(t.classList.add("c1","c2"),!t.classList.contains("c2")){var e=function(t){var e=DOMTokenList.prototype[t];DOMTokenList.prototype[t]=function(t){var n,r=arguments.length;for(n=0;n<r;n++)t=arguments[n],e.call(this,t)}};e("add"),e("remove")}if(t.classList.toggle("c3",!1),t.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(t,e){return 1 in arguments&&!this.contains(t)==!e?e:n.call(this,t)}}t=null}())},705:function(t,e,n){var r=n(639).Symbol;t.exports=r},239:function(t,e,n){var r=n(705),o=n(607),i=n(333),a=r?r.toStringTag:void 0;t.exports=function(t){return null==t?void 0===t?"[object Undefined]":"[object Null]":a&&a in Object(t)?o(t):i(t)}},561:function(t,e,n){var r=n(990),o=/^\s+/;t.exports=function(t){return t?t.slice(0,r(t)+1).replace(o,""):t}},957:function(t,e,n){var r="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g;t.exports=r},607:function(t,e,n){var r=n(705),o=Object.prototype,i=o.hasOwnProperty,a=o.toString,u=r?r.toStringTag:void 0;t.exports=function(t){var e=i.call(t,u),n=t[u];try{t[u]=void 0;var r=!0}catch(t){}var o=a.call(t);return r&&(e?t[u]=n:delete t[u]),o}},333:function(t){var e=Object.prototype.toString;t.exports=function(t){return e.call(t)}},639:function(t,e,n){var r=n(957),o="object"==typeof self&&self&&self.Object===Object&&self,i=r||o||Function("return this")();t.exports=i},990:function(t){var e=/\s/;t.exports=function(t){for(var n=t.length;n--&&e.test(t.charAt(n)););return n}},279:function(t,e,n){var r=n(218),o=n(771),i=n(841),a=Math.max,u=Math.min;t.exports=function(t,e,n){var s,c,l,f,d,h,m=0,v=!1,p=!1,g=!0;if("function"!=typeof t)throw new TypeError("Expected a function");function y(e){var n=s,r=c;return s=c=void 0,m=e,f=t.apply(r,n)}function b(t){return m=t,d=setTimeout(E,e),v?y(t):f}function w(t){var n=t-h;return void 0===h||n>=e||n<0||p&&t-m>=l}function E(){var t=o();if(w(t))return T(t);d=setTimeout(E,function(t){var n=e-(t-h);return p?u(n,l-(t-m)):n}(t))}function T(t){return d=void 0,g&&s?y(t):(s=c=void 0,f)}function x(){var t=o(),n=w(t);if(s=arguments,c=this,h=t,n){if(void 0===d)return b(h);if(p)return clearTimeout(d),d=setTimeout(E,e),y(h)}return void 0===d&&(d=setTimeout(E,e)),f}return e=i(e)||0,r(n)&&(v=!!n.leading,l=(p="maxWait"in n)?a(i(n.maxWait)||0,e):l,g="trailing"in n?!!n.trailing:g),x.cancel=function(){void 0!==d&&clearTimeout(d),m=0,s=h=c=d=void 0},x.flush=function(){return void 0===d?f:T(o())},x}},218:function(t){t.exports=function(t){var e=typeof t;return null!=t&&("object"==e||"function"==e)}},5:function(t){t.exports=function(t){return null!=t&&"object"==typeof t}},448:function(t,e,n){var r=n(239),o=n(5);t.exports=function(t){return"symbol"==typeof t||o(t)&&"[object Symbol]"==r(t)}},771:function(t,e,n){var r=n(639);t.exports=function(){return r.Date.now()}},493:function(t,e,n){var r=n(279),o=n(218);t.exports=function(t,e,n){var i=!0,a=!0;if("function"!=typeof t)throw new TypeError("Expected a function");return o(n)&&(i="leading"in n?!!n.leading:i,a="trailing"in n?!!n.trailing:a),r(t,e,{leading:i,maxWait:e,trailing:a})}},841:function(t,e,n){var r=n(561),o=n(218),i=n(448),a=/^[-+]0x[0-9a-f]+$/i,u=/^0b[01]+$/i,s=/^0o[0-7]+$/i,c=parseInt;t.exports=function(t){if("number"==typeof t)return t;if(i(t))return NaN;if(o(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=o(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=r(t);var n=u.test(t);return n||s.test(t)?c(t.slice(2),n?2:8):a.test(t)?NaN:+t}}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,{a:e}),e},n.d=function(t,e){for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"==typeof window)return window}}(),n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},function(){"use strict";var t=n(493),e=n.n(t),r=(n(241),window.jQuery),o=n.n(r);!function(t,n,r){function o(r,o,i,a){Array.isArray(r)||(r=[{event:r,throttleTime:i}]),r.forEach((function(r){var i=o;r.throttleTime&&(i=e()(o,r.throttleTime)),t(n).on(r.event+".cmlsBase",i)})),a&&o()}var i;function a(){var t=document.documentElement,e=(document.querySelector("body > .masthead").getBoundingClientRect(),n.innerHeight/100);i||(i=getComputedStyle(document.documentElement).getPropertyValue("--"+n.THEME_PREFIX+"-masthead-height")),e>12?t.style.setProperty("--"+n.THEME_PREFIX+"-masthead-height","90px"):e<8.3?t.style.setProperty("--"+n.THEME_PREFIX+"-masthead-height","65px"):t.style.setProperty("--"+n.THEME_PREFIX+"-masthead-height",i)}o([{event:"scroll",throttleTime:100},{event:"resize",throttleTime:1e3},{event:"DOMContentLoaded"},{event:"load"}],(function(){var t=document.querySelector("body > main"),e=document.querySelector("body > .masthead"),n=t.getBoundingClientRect(),r=e.getBoundingClientRect(),o=document.body.classList.contains("under-masthead");n.top+r.bottom+10<r.top+r.bottom?o||document.body.classList.add("under-masthead"):o&&document.body.classList.remove("under-masthead")}),null,!0),o([{event:"resize",throttleTime:1e3},{event:"DOMContentLoaded"},{event:"load"}],a,null,!0),setInterval(a,3e3)}(o().noConflict(),window);var i=n(279),a=n.n(i);!function(t,e,n){var r=function(){var t,e=document.createElement("fakeelement"),n={transition:"transitionend",OTransition:"oTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(t in n)if(void 0!==e.style[t])return n[t]}(),o=!1;function i(){t("#header_menu").removeClass("is-open"),t("body").removeClass("menu-active"),t("body > header .hamburger").removeClass("is-active").attr({"aria-label":"Open menu","aria-expanded":!1}),o=!1}t("html").on("click.{window.THEME_PREFIX} focusin.{window.THEME_PREFIX}",a()((function(e){var n={menu:t("body > header .menu-container *"),hamburger:t("body > header .hamburger")};if(n.menu.is(e.target)||n.menu.has(e.target).length)return(n.hamburger.is(e.target)||n.hamburger.has(e.target).length)&&o?(i(),void n.hamburger.blur()):(t("#header_menu").one(r,(function(e){t(this).addClass("is-open")})),t("body").addClass("menu-active"),t("body > header .hamburger").addClass("is-active").attr({"aria-label":"Close menu","aria-expanded":!0}),void(o=!0));i()}),200,{leading:!0,trailing:!1}))}(o().noConflict(),window.self),document.querySelector("html").className.replace("no-js","js");var u=function(){var t=.01*window.innerHeight;document.documentElement.style.setProperty("--vh","".concat(t,"px"))};window.addEventListener("load",u),window.addEventListener("resize",e()(u,100))}()}();