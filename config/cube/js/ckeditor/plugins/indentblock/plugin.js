/*
 Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
(function(){function h(b,c,a){if(!b.getCustomData("indent_processed")){var d=this.editor,f=this.isIndent;if(c){d=b.$.className.match(this.classNameRegex);a=0;d&&(d=d[1],a=CKEDITOR.tools.indexOf(c,d)+1);if(0>(a+=f?1:-1))return;a=Math.min(a,c.length);a=Math.max(a,0);b.$.className=CKEDITOR.tools.ltrim(b.$.className.replace(this.classNameRegex,""));0<a&&b.addClass(c[a-1])}else{var c=i(b,a),a=parseInt(b.getStyle(c),10),g=d.config.indentOffset||40;isNaN(a)&&(a=0);a+=(f?1:-1)*g;if(0>a)return;a=Math.max(a,
0);a=Math.ceil(a/g)*g;b.setStyle(c,a?a+(d.config.indentUnit||"px"):"");""===b.getAttribute("style")&&b.removeAttribute("style")}CKEDITOR.dom.element.setMarker(this.database,b,"indent_processed",1)}}function i(b,c){return"ltr"==(c||b.getComputedStyle("direction"))?"margin-left":"margin-right"}var j=CKEDITOR.dtd.$listItem,l=CKEDITOR.dtd.$list,f=CKEDITOR.TRISTATE_DISABLED,k=CKEDITOR.TRISTATE_OFF;CKEDITOR.plugins.add("indentblock",{requires:"indent",init:function(b){function c(b,c){a.specificDefinition.apply(this,
arguments);this.allowedContent={"div h1 h2 h3 h4 h5 h6 ol p pre ul":{propertiesOnly:!0,styles:!d?"margin-left,margin-right":null,classes:d||null}};this.enterBr&&(this.allowedContent.div=!0);this.requiredContent=(this.enterBr?"div":"p")+(d?"("+d.join(",")+")":"{margin-left}");this.jobs={20:{refresh:function(a,b){var e=b.block||b.blockLimit;if(e.is(j))e=e.getParent();else if(e.getAscendant(j))return f;if(!this.enterBr&&!this.getContext(b))return f;if(d){var c;c=d;var e=e.$.className.match(this.classNameRegex),
g=this.isIndent;c=e?g?e[1]!=c.slice(-1):true:g;return c?k:f}return this.isIndent?k:e?CKEDITOR[(parseInt(e.getStyle(i(e)),10)||0)<=0?"TRISTATE_DISABLED":"TRISTATE_OFF"]:f},exec:function(a){var b=a.getSelection(),b=b&&b.getRanges(1)[0],c;if(c=a.elementPath().contains(l))h.call(this,c,d);else{b=b.createIterator();a=a.config.enterMode;b.enforceRealBlocks=true;for(b.enlargeBr=a!=CKEDITOR.ENTER_BR;c=b.getNextParagraph(a==CKEDITOR.ENTER_P?"p":"div");)h.call(this,c,d)}return true}}}}var a=CKEDITOR.plugins.indent,
d=b.config.indentClasses;a.registerCommands(b,{indentblock:new c(b,"indentblock",!0),outdentblock:new c(b,"outdentblock")});CKEDITOR.tools.extend(c.prototype,a.specificDefinition.prototype,{context:{div:1,dl:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,ul:1,ol:1,p:1,pre:1,table:1},classNameRegex:d?RegExp("(?:^|\\s+)("+d.join("|")+")(?=$|\\s)"):null})}})})();