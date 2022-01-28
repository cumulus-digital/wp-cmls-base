!function(){"use strict";var t={};function e(t,e,n,a,i,o,r){try{var c=t[o](r),l=c.value}catch(t){return void n(t)}c.done?e(l):Promise.resolve(l).then(a,i)}function n(t){return function(){var n=this,a=arguments;return new Promise((function(i,o){var r=t.apply(n,a);function c(t){e(r,i,o,c,l,"next",t)}function l(t){e(r,i,o,c,l,"throw",t)}c(void 0)}))}}t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,{a:n}),n},t.d=function(e,n){for(var a in n)t.o(n,a)&&!t.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:n[a]})},t.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)};var a,i,o=window.regeneratorRuntime,r=t.n(o),c=window.jQuery,l=t.n(c),s=window.lodash,d=window.wp.element;a=wp.blocks.registerBlockType,i={backgroundColor:"#DDD",borderRadius:"3px",boxShadow:"0 1px 2px RGBA(0,0,0,0.3)",color:"#888",padding:"8px",textAlign:"center",fontWeight:300},a("cumulus-gutenberg/anchor",{title:"Anchor",icon:{src:"admin-links",foreground:"#3399cc"},category:"layout",supports:{anchor:!0},edit:function(t){var e=t.attributes.anchor;return(0,d.createElement)("div",{style:i,title:"Anchor"},"🔗︎",e&&(0,d.createElement)("em",null,e))},save:function(){return(0,d.createElement)("div",{class:"cmls-anchor"})}});var p=wp.hooks.addFilter,u=wp.compose,f=u.createHigherOrderComponent,_=(u.compose,wp.components),b=(_.PanelBody,_.TextControl),g=wp.blockEditor.InspectorAdvancedControls,h=wp.data,m=(h.withSelect,h.useSelect,["core/post-terms"]);p("editor.BlockEdit","cmls/block-extentions/post-types",f((function(t){return function(e){var n=e.attributes,a=e.setAttributes,i=e.isSelected;if(!m.includes(e.name))return(0,d.createElement)(t,e);var o=n.term;return(0,d.createElement)(d.Fragment,null,(0,d.createElement)(t,e),i&&(0,d.createElement)(g,null,(0,d.createElement)(b,{label:"Term Type",value:o,onChange:function(t){return a({term:t})},help:(0,d.createElement)(d.Fragment,null,(0,d.createElement)("strong",null,"Value must be the ",(0,d.createElement)("em",null,"internal slug")," of the term."),'Allows selecting term types other than the built-in tags and categories."')})))}}),"withTaxTypeSelector")),function(t,e,a){void 0!==e.wp&&void 0!==e.wp.blocks&&t((function(){t(e).on("load.".concat(e.THEME_PREFIX),(function(){t('.edit-post-post-status .components-panel__row:contains("Stick to")').hide(),t("#sticky-span").hide()}));var a=t("body"),i=t("#acf-group_5f467bc4cb553");if(i.length){t("\n\t\t\t<style id=\"cmls-acf_post_title\">\n\t\t\t\t#sticky-span { display: none !important; }\n\t\t\t\t.edit-post-visual-editor__post-title-wrapper {\n\t\t\t\t\ttransition-property: opacity;\n\t\t\t\t\ttransition-duration: .5s;\n\t\t\t\t\topacity: 1;\n\t\t\t\t\tposition: relative;\n\t\t\t\t\tcolor: var(--page_title-title_color);\n\t\t\t\t}\n\t\t\t\t.has-header-background .edit-post-visual-editor__post-title-wrapper {\n\t\t\t\t\tbackground-image: var(--page_title-background_image);\n\t\t\t\t\tbackground-color: var(--page_title-background_color);\n\t\t\t\t\tbackground-position: var(--page_title-background_position);\n\t\t\t\t\tbackground-repeat: var(--page_title-background_repeat);\n\t\t\t\t\tbackground-size: var(--page_title-background_size);\n\t\t\t\t\tmargin-bottom: var(--page_title-margin_below_header);\n\t\t\t\t\tmargin-top: 0;\n\t\t\t\t\tpadding-top: 3em;\n\t\t\t\t\tpadding-bottom: 3em;\n\t\t\t\t}\n\t\t\t\t\t.has-header-background .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\t\t\t\t\t\ttext-shadow: 0.05em 0.05em 0.15em rgba(0, 0, 0, var(--page_title-title_shadow_opacity));\n\t\t\t\t\t}\n\t\t\t\t.has-alt-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input::before {\n\t\t\t\t\tbackground: rgba(255, 255, 0, 0.6);\n\t\t\t\t\tcolor: #000;\n\t\t\t\t\tcontent: '🥸 ALT TITLE';\n\t\t\t\t\tfont-size: 0.6rem;\n\t\t\t\t\tposition: absolute;\n\t\t\t\t\tleft: 0;\n\t\t\t\t\tbottom: 100%;\n\t\t\t\t}\n\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input {\n\t\t\t\t\tbackground-color: rgba(0,0,0,0.05);\n\t\t\t\t\tposition: relative;\n\t\t\t\t\topacity: 0.5;\n\t\t\t\t}\n\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:hover,\n\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus,\n\t\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input:focus-within {\n\t\t\t\t\t\topacity: 1;\n\t\t\t\t\t}\n\t\t\t\t.has-hidden-post-title .edit-post-visual-editor__post-title-wrapper .editor-post-title__input::before {\n\t\t\t\t\tdisplay: inline-block;\n\t\t\t\t\tcontent: '🤫 TITLE HIDDEN';\n\t\t\t\t\tbackground: rgba(0, 0, 0, 0.75);\n\t\t\t\t\tcolor: #fff;\n\t\t\t\t\tfont-size: 0.6rem;\n\t\t\t\t\tline-height: 1;\n\t\t\t\t\ttext-shadow: 1px 1px 1px #000;\n\t\t\t\t\tpadding: .5rem;\n\t\t\t\t\topacity: 1;\n\t\t\t\t\tposition: absolute;\n\t\t\t\t\tleft: 0;\n\t\t\t\t\tbottom: 100%;\n\t\t\t\t}\n\t\t\t</style>\n\t\t").appendTo("body");var o={"#acf-field_5f467c3c135f3":{key:"title-hidden",type:"checkbox",acf:"#acf-field_5f467c3c135f3",action:function(t){t?a.addClass("has-hidden-post-title"):a.removeClass("has-hidden-post-title")}},"#acf-field_5f46f4d6962ca":{key:"title-alt",type:"string",acf:"#acf-field_5f46f4d6962ca",action:function(t){t&&t.toString().length?e.wp.data.dispatch("core/notices").createNotice("info","🥸 This post uses an alternate display title",{isDismissible:!1,id:"has-alt-title"}):e.wp.data.dispatch("core/notices").removeNotice("has-alt-title")}},"acf[field_6140e29b2c51a][field_6140e2cb5b633]":{key:"background_color",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e2cb5b633]"]',action:"setCssVar",triggersHasBackground:!0},"acf[field_6140e29b2c51a][field_6140e3aa5b638]":{key:"title_color",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e3aa5b638]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e95fd3f2a]":{key:"margin_below_header",type:"em",acf:'input[name="acf[field_6140e29b2c51a][field_6140e95fd3f2a]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e3d15b639]":{key:"title_shadow_opacity",type:"float",acf:'input[name="acf[field_6140e29b2c51a][field_6140e3d15b639]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e2ef5b634]":{key:"background_image",type:"file",acf:'input[name="acf[field_6140e29b2c51a][field_6140e2ef5b634]"]',action:"setCssVar",triggersHasBackground:!0},"acf[field_6140e29b2c51a][field_6140e31c5b635]":{key:"background_size",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e31c5b635]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e3455b636]":{key:"background_position",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e3455b636]"]',action:"setCssVar"},"acf[field_6140e29b2c51a][field_6140e38b5b637]":{key:"background_repeat",type:"string",acf:'input[name="acf[field_6140e29b2c51a][field_6140e38b5b637]"]',action:"setCssVar"}};i.on("change.".concat(e.THEME_PREFIX," keyup.").concat(e.THEME_PREFIX),(0,s.map)(o,"acf").join(","),(0,s.debounce)(l,200,{trailing:!0})),l(),t(e).on("load",l)}function c(e){var n,a;switch(e.type){case"checkbox":e.val=t(e.acf).is(":checked");break;case"em":e.val=parseFloat(e.val)+"em";break;case"string":e.val=t("<div>").text(e.val).html();break;case"integer":case"int":e.val=parseInt(e.val);break;case"float":e.val=parseFloat(e.val);break;case"file":if(null!==(n=wp.api)&&void 0!==n&&null!==(a=n.models)&&void 0!==a&&a.Media&&e.val&&e.val.toString().length){var i=new wp.api.models.Media({id:e.val});return e.val=i.fetch(),new Promise((function(t){i.fetch().then((function(n){var a,i,o;null!==(a=n.media_details)&&void 0!==a&&null!==(i=a.sizes)&&void 0!==i&&null!==(o=i.full)&&void 0!==o&&o.source_url&&(e.val='url("'.concat(n.media_details.sizes.full.source_url,'")')),t(e)}))}))}}return new Promise((function(t){t(e)}))}function l(){return d.apply(this,arguments)}function d(){return(d=n(r().mark((function e(){var n,i,l,d,p,u;return r().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:n={},e.t0=r().keys(o);case 2:if((e.t1=e.t0()).done){e.next=16;break}return i=e.t1.value,d=t((l=o[i]).acf),l.val=d.val(),e.next=9,c(l);case 9:if("function"!=typeof(l=e.sent).action){e.next=13;break}return l.action(l.val),e.abrupt("continue",2);case 13:n[i]=l,e.next=2;break;case 16:p=(0,s.filter)(n,(function(t){if(t.triggersHasBackground&&t.val&&t.val.toString().length)return t})),p.length?a.addClass("has-header-background"):a.removeClass("has-header-background"),u={},(0,s.map)(n,(function(t){"setCssVar"===t.action&&(u["--page_title-".concat(t.key)]=t.val.toString())})),Object.keys(u).length&&a.css(u);case 21:case"end":return e.stop()}}),e)})))).apply(this,arguments)}}))}(l().noConflict(),window.self)}();