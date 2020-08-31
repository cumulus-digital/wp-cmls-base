!function(t){var e={};function n(i){if(e[i])return e[i].exports;var o=e[i]={i:i,l:!1,exports:{}};return t[i].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,i){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:i})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(i,o,function(e){return t[e]}.bind(null,o));return i},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=7)}([function(t,e){!function(){t.exports=this.jQuery}()},function(t,e){"document"in window.self&&((!("classList"in document.createElement("_"))||document.createElementNS&&!("classList"in document.createElementNS("http://www.w3.org/2000/svg","g")))&&function(t){"use strict";if("Element"in t){var e=t.Element.prototype,n=Object,i=String.prototype.trim||function(){return this.replace(/^\s+|\s+$/g,"")},o=Array.prototype.indexOf||function(t){for(var e=0,n=this.length;e<n;e++)if(e in this&&this[e]===t)return e;return-1},r=function(t,e){this.name=t,this.code=DOMException[t],this.message=e},s=function(t,e){if(""===e)throw new r("SYNTAX_ERR","An invalid or illegal string was specified");if(/\s/.test(e))throw new r("INVALID_CHARACTER_ERR","String contains an invalid character");return o.call(t,e)},a=function(t){for(var e=i.call(t.getAttribute("class")||""),n=e?e.split(/\s+/):[],o=0,r=n.length;o<r;o++)this.push(n[o]);this._updateClassName=function(){t.setAttribute("class",this.toString())}},c=a.prototype=[],l=function(){return new a(this)};if(r.prototype=Error.prototype,c.item=function(t){return this[t]||null},c.contains=function(t){return-1!==s(this,t+="")},c.add=function(){var t,e=arguments,n=0,i=e.length,o=!1;do{t=e[n]+"",-1===s(this,t)&&(this.push(t),o=!0)}while(++n<i);o&&this._updateClassName()},c.remove=function(){var t,e,n=arguments,i=0,o=n.length,r=!1;do{for(t=n[i]+"",e=s(this,t);-1!==e;)this.splice(e,1),r=!0,e=s(this,t)}while(++i<o);r&&this._updateClassName()},c.toggle=function(t,e){t+="";var n=this.contains(t),i=n?!0!==e&&"remove":!1!==e&&"add";return i&&this[i](t),!0===e||!1===e?e:!n},c.toString=function(){return this.join(" ")},n.defineProperty){var u={get:l,enumerable:!0,configurable:!0};try{n.defineProperty(e,"classList",u)}catch(t){void 0!==t.number&&-2146823252!==t.number||(u.enumerable=!1,n.defineProperty(e,"classList",u))}}else n.prototype.__defineGetter__&&e.__defineGetter__("classList",l)}}(window.self),function(){"use strict";var t=document.createElement("_");if(t.classList.add("c1","c2"),!t.classList.contains("c2")){var e=function(t){var e=DOMTokenList.prototype[t];DOMTokenList.prototype[t]=function(t){var n,i=arguments.length;for(n=0;n<i;n++)t=arguments[n],e.call(this,t)}};e("add"),e("remove")}if(t.classList.toggle("c3",!1),t.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(t,e){return 1 in arguments&&!this.contains(t)==!e?e:n.call(this,t)}}t=null}())},,,,,,function(t,e,n){"use strict";n.r(e);n(8);var i=n(0),o=n.n(i);n(1),function(t,e,n){void 0!==e.wp&&void 0!==e.wp.blocks&&t((function(){t("\n            <style id=\"acf_post_title_is_hidden\">\n                .edit-post-visual-editor__post-title-wrapper {\n                    transition-property: background-color, opacity;\n                    transition-duration: .5s;\n                    opacity: 1;\n                }\n                .has_alt_title::before {\n                    background: rgba(255, 255, 0, 0.6);\n                    color: #000;\n                    content: 'HAS ALT TITLE';\n                }\n                .post_title_is_hidden {\n                    background-color: rgba(0,0,0,0.1);\n                    opacity: 0.5;\n                    position: relative;\n                }\n                    .post_title_is_hidden:hover,\n                    .post_title_is_hidden:focus {\n                        opacity: 1;\n                    }\n                .post_title_is_hidden::before {\n                    content: '🤫 TITLE HIDDEN';\n                    background: rgba(0, 0, 0, 0.6);\n                    color: #fff;\n                    font-size: 0.6em;\n                    padding: .25em .5em;\n                    position: absolute;\n                    top: 0;\n                    left: 0;\n                }\n            </style>\n        ").appendTo("body");var n=t("#acf-field_5f467c3c135f3");function i(e){var n=t(".edit-post-visual-editor__post-title-wrapper");e?n.addClass("post_title_is_hidden"):n.removeClass("post_title_is_hidden")}n.change((function(){i(this.checked)})),t(e).load((function(){i(n.is(":checked"))}));var o=t("#acf-field_5f46f4d6962ca");function r(t){t?e.wp.data.dispatch("core/notices").createNotice("info","👀 This post uses an alternate display title",{isDismissible:!1,id:"has-alt-title"}):e.wp.data.dispatch("core/notices").removeNotice("has-alt-title")}o.change((function(){r(t(this).val().length)})),t(e).load((function(){r(o.val().length)}))}))}(o.a.noConflict(),window.self)},function(t,e,n){}]);