(()=>{(function(){"use strict";function D(){return D=Object.assign||function(r){for(var e=1;e<arguments.length;e++){var i=arguments[e];for(var d in i)Object.prototype.hasOwnProperty.call(i,d)&&(r[d]=i[d])}return r},D.apply(this,arguments)}var ae=13,re=9,ie=8,se=89,B=90,oe=77,Y=57,G=219,U=222,Q=192,le=27,X=100,ue=3e3,de=typeof window!="undefined"&&navigator&&/Win/i.test(navigator.platform),M=typeof window!="undefined"&&navigator&&/(Mac|iPhone|iPod|iPad)/i.test(navigator.platform),ce={props:{lineNumbers:{type:Boolean,default:!1},autoStyleLineNumbers:{type:Boolean,default:!0},readonly:{type:Boolean,default:!1},value:{type:String,default:""},highlight:{type:Function,required:!0},tabSize:{type:Number,default:2},insertSpaces:{type:Boolean,default:!0},ignoreTabKey:{type:Boolean,default:!1},placeholder:{type:String,default:""}},data:function(){return{capture:!0,history:{stack:[],offset:-1},lineNumbersHeight:"20px",codeData:""}},watch:{value:{immediate:!0,handler:function(e){e?this.codeData=e:this.codeData=""}},content:{immediate:!0,handler:function(){var e=this;this.lineNumbers&&this.$nextTick(function(){e.setLineNumbersHeight()})}},lineNumbers:function(){var e=this;this.$nextTick(function(){e.styleLineNumbers(),e.setLineNumbersHeight()})}},computed:{isEmpty:function(){return this.codeData.length===0},content:function(){var e=this.highlight(this.codeData)+"<br />";return e},lineNumbersCount:function(){var e=this.codeData.split(/\r\n|\n/).length;return e}},mounted:function(){this._recordCurrentState(),this.styleLineNumbers()},methods:{setLineNumbersHeight:function(){this.lineNumbersHeight=getComputedStyle(this.$refs.pre).height},styleLineNumbers:function(){if(!(!this.lineNumbers||!this.autoStyleLineNumbers)){var e=this.$refs.pre,i=this.$el.querySelector(".prism-editor__line-numbers"),d=window.getComputedStyle(e);this.$nextTick(function(){var h="border-top-left-radius",b="border-bottom-left-radius";if(!!i){i.style[h]=d[h],i.style[b]=d[b],e.style[h]="0",e.style[b]="0";var p=["background-color","margin-top","padding-top","font-family","font-size","line-height"];p.forEach(function(a){i.style[a]=d[a]}),i.style["margin-bottom"]="-"+d["padding-top"]}})}},_recordCurrentState:function(){var e=this.$refs.textarea;if(!!e){var i=e.value,d=e.selectionStart,h=e.selectionEnd;this._recordChange({value:i,selectionStart:d,selectionEnd:h})}},_getLines:function(e,i){return e.substring(0,i).split(`
`)},_applyEdits:function(e){var i=this.$refs.textarea,d=this.history.stack[this.history.offset];d&&i&&(this.history.stack[this.history.offset]=D({},d,{selectionStart:i.selectionStart,selectionEnd:i.selectionEnd})),this._recordChange(e),this._updateInput(e)},_recordChange:function(e,i){i===void 0&&(i=!1);var d=this.history,h=d.stack,b=d.offset;if(h.length&&b>-1){this.history.stack=h.slice(0,b+1);var p=this.history.stack.length;if(p>X){var a=p-X;this.history.stack=h.slice(a,p),this.history.offset=Math.max(this.history.offset-a,0)}}var u=Date.now();if(i){var c=this.history.stack[this.history.offset];if(c&&u-c.timestamp<ue){var x,$,v=/[^a-z0-9]([a-z0-9]+)$/i,S=(x=this._getLines(c.value,c.selectionStart).pop())===null||x===void 0?void 0:x.match(v),F=($=this._getLines(e.value,e.selectionStart).pop())===null||$===void 0?void 0:$.match(v);if(S&&F&&F[1].startsWith(S[1])){this.history.stack[this.history.offset]=D({},e,{timestamp:u});return}}}this.history.stack.push(D({},e,{timestamp:u})),this.history.offset++},_updateInput:function(e){var i=this.$refs.textarea;!i||(i.value=e.value,i.selectionStart=e.selectionStart,i.selectionEnd=e.selectionEnd,this.$emit("input",e.value))},handleChange:function(e){var i=e.target,d=i.value,h=i.selectionStart,b=i.selectionEnd;this._recordChange({value:d,selectionStart:h,selectionEnd:b},!0),this.$emit("input",d)},_undoEdit:function(){var e=this.history,i=e.stack,d=e.offset,h=i[d-1];h&&(this._updateInput(h),this.history.offset=Math.max(d-1,0))},_redoEdit:function(){var e=this.history,i=e.stack,d=e.offset,h=i[d+1];h&&(this._updateInput(h),this.history.offset=Math.min(d+1,i.length-1))},handleKeyDown:function(e){var i=this.tabSize,d=this.insertSpaces,h=this.ignoreTabKey;if(!(this.$listeners.keydown&&(this.$emit("keydown",e),e.defaultPrevented))){e.keyCode===le&&(e.target.blur(),this.$emit("blur",e));var b=e.target,p=b.value,a=b.selectionStart,u=b.selectionEnd,c=(d?" ":"	").repeat(i);if(e.keyCode===re&&!h&&this.capture)if(e.preventDefault(),e.shiftKey){var x=this._getLines(p,a),$=x.length-1,v=this._getLines(p,u).length-1,S=p.split(`
`).map(function(k,K){return K>=$&&K<=v&&k.startsWith(c)?k.substring(c.length):k}).join(`
`);if(p!==S){var F=x[$];this._applyEdits({value:S,selectionStart:F.startsWith(c)?a-c.length:a,selectionEnd:u-(p.length-S.length)})}}else if(a!==u){var E=this._getLines(p,a),z=E.length-1,P=this._getLines(p,u).length-1,t=E[z];this._applyEdits({value:p.split(`
`).map(function(k,K){return K>=z&&K<=P?c+k:k}).join(`
`),selectionStart:/\S/.test(t)?a+c.length:a,selectionEnd:u+c.length*(P-z+1)})}else{var n=a+c.length;this._applyEdits({value:p.substring(0,a)+c+p.substring(u),selectionStart:n,selectionEnd:n})}else if(e.keyCode===ie){var s=a!==u,o=p.substring(0,a);if(o.endsWith(c)&&!s){e.preventDefault();var l=a-c.length;this._applyEdits({value:p.substring(0,a-c.length)+p.substring(u),selectionStart:l,selectionEnd:l})}}else if(e.keyCode===ae){if(a===u){var f=this._getLines(p,a).pop(),y=f==null?void 0:f.match(/^\s+/);if(y&&y[0]){e.preventDefault();var g=`
`+y[0],w=a+g.length;this._applyEdits({value:p.substring(0,a)+g+p.substring(u),selectionStart:w,selectionEnd:w})}}}else if(e.keyCode===Y||e.keyCode===G||e.keyCode===U||e.keyCode===Q){var m;e.keyCode===Y&&e.shiftKey?m=["(",")"]:e.keyCode===G?e.shiftKey?m=["{","}"]:m=["[","]"]:e.keyCode===U?e.shiftKey?m=['"','"']:m=["'","'"]:e.keyCode===Q&&!e.shiftKey&&(m=["`","`"]),a!==u&&m&&(e.preventDefault(),this._applyEdits({value:p.substring(0,a)+m[0]+p.substring(a,u)+m[1]+p.substring(u),selectionStart:a,selectionEnd:u+2}))}else(M?e.metaKey&&e.keyCode===B:e.ctrlKey&&e.keyCode===B)&&!e.shiftKey&&!e.altKey?(e.preventDefault(),this._undoEdit()):(M?e.metaKey&&e.keyCode===B&&e.shiftKey:de?e.ctrlKey&&e.keyCode===se:e.ctrlKey&&e.keyCode===B&&e.shiftKey)&&!e.altKey?(e.preventDefault(),this._redoEdit()):e.keyCode===oe&&e.ctrlKey&&(M?e.shiftKey:!0)&&(e.preventDefault(),this.capture=!this.capture)}}},render:function(e){var i=this,d=e("div",{attrs:{class:"prism-editor__line-width-calc",style:"height: 0px; visibility: hidden; pointer-events: none;"}},"999"),h=e("div",{staticClass:"prism-editor__line-numbers",style:{"min-height":this.lineNumbersHeight},attrs:{"aria-hidden":"true"}},[d,Array.from(Array(this.lineNumbersCount).keys()).map(function(u,c){return e("div",{attrs:{class:"prism-editor__line-number token comment"}},""+ ++c)})]),b=e("textarea",{ref:"textarea",on:{input:this.handleChange,keydown:this.handleKeyDown,click:function(c){i.$emit("click",c)},keyup:function(c){i.$emit("keyup",c)},focus:function(c){i.$emit("focus",c)},blur:function(c){i.$emit("blur",c)}},staticClass:"prism-editor__textarea",class:{"prism-editor__textarea--empty":this.isEmpty},attrs:{spellCheck:"false",autocapitalize:"off",autocomplete:"off",autocorrect:"off","data-gramm":"false",placeholder:this.placeholder,"data-testid":"textarea",readonly:this.readonly},domProps:{value:this.codeData}}),p=e("pre",{ref:"pre",staticClass:"prism-editor__editor",attrs:{"data-testid":"preview"},domProps:{innerHTML:this.content}}),a=e("div",{staticClass:"prism-editor__container"},[b,p]);return e("div",{staticClass:"prism-editor-wrapper"},[this.lineNumbers&&h,a])}},xe="",J=typeof globalThis!="undefined"?globalThis:typeof window!="undefined"?window:typeof global!="undefined"?global:typeof self!="undefined"?self:{},R={exports:{}};(function(r){var e=typeof window!="undefined"?window:typeof WorkerGlobalScope!="undefined"&&self instanceof WorkerGlobalScope?self:{};/**
 * Prism: Lightweight, robust, elegant syntax highlighting
 *
 * @license MIT <https://opensource.org/licenses/MIT>
 * @author Lea Verou <https://lea.verou.me>
 * @namespace
 * @public
 */var i=function(d){var h=/\blang(?:uage)?-([\w-]+)\b/i,b=0,p={},a={manual:d.Prism&&d.Prism.manual,disableWorkerMessageHandler:d.Prism&&d.Prism.disableWorkerMessageHandler,util:{encode:function t(n){return n instanceof u?new u(n.type,t(n.content),n.alias):Array.isArray(n)?n.map(t):n.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/\u00a0/g," ")},type:function(t){return Object.prototype.toString.call(t).slice(8,-1)},objId:function(t){return t.__id||Object.defineProperty(t,"__id",{value:++b}),t.__id},clone:function t(n,s){s=s||{};var o,l;switch(a.util.type(n)){case"Object":if(l=a.util.objId(n),s[l])return s[l];o={},s[l]=o;for(var f in n)n.hasOwnProperty(f)&&(o[f]=t(n[f],s));return o;case"Array":return l=a.util.objId(n),s[l]?s[l]:(o=[],s[l]=o,n.forEach(function(y,g){o[g]=t(y,s)}),o);default:return n}},getLanguage:function(t){for(;t&&!h.test(t.className);)t=t.parentElement;return t?(t.className.match(h)||[,"none"])[1].toLowerCase():"none"},currentScript:function(){if(typeof document=="undefined")return null;if("currentScript"in document&&1<2)return document.currentScript;try{throw new Error}catch(o){var t=(/at [^(\r\n]*\((.*):[^:]+:[^:]+\)$/i.exec(o.stack)||[])[1];if(t){var n=document.getElementsByTagName("script");for(var s in n)if(n[s].src==t)return n[s]}return null}},isActive:function(t,n,s){for(var o="no-"+n;t;){var l=t.classList;if(l.contains(n))return!0;if(l.contains(o))return!1;t=t.parentElement}return!!s}},languages:{plain:p,plaintext:p,text:p,txt:p,extend:function(t,n){var s=a.util.clone(a.languages[t]);for(var o in n)s[o]=n[o];return s},insertBefore:function(t,n,s,o){o=o||a.languages;var l=o[t],f={};for(var y in l)if(l.hasOwnProperty(y)){if(y==n)for(var g in s)s.hasOwnProperty(g)&&(f[g]=s[g]);s.hasOwnProperty(y)||(f[y]=l[y])}var w=o[t];return o[t]=f,a.languages.DFS(a.languages,function(m,k){k===w&&m!=t&&(this[m]=f)}),f},DFS:function t(n,s,o,l){l=l||{};var f=a.util.objId;for(var y in n)if(n.hasOwnProperty(y)){s.call(n,y,n[y],o||y);var g=n[y],w=a.util.type(g);w==="Object"&&!l[f(g)]?(l[f(g)]=!0,t(g,s,null,l)):w==="Array"&&!l[f(g)]&&(l[f(g)]=!0,t(g,s,y,l))}}},plugins:{},highlightAll:function(t,n){a.highlightAllUnder(document,t,n)},highlightAllUnder:function(t,n,s){var o={callback:s,container:t,selector:'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'};a.hooks.run("before-highlightall",o),o.elements=Array.prototype.slice.apply(o.container.querySelectorAll(o.selector)),a.hooks.run("before-all-elements-highlight",o);for(var l=0,f;f=o.elements[l++];)a.highlightElement(f,n===!0,o.callback)},highlightElement:function(t,n,s){var o=a.util.getLanguage(t),l=a.languages[o];t.className=t.className.replace(h,"").replace(/\s+/g," ")+" language-"+o;var f=t.parentElement;f&&f.nodeName.toLowerCase()==="pre"&&(f.className=f.className.replace(h,"").replace(/\s+/g," ")+" language-"+o);var y=t.textContent,g={element:t,language:o,grammar:l,code:y};function w(k){g.highlightedCode=k,a.hooks.run("before-insert",g),g.element.innerHTML=g.highlightedCode,a.hooks.run("after-highlight",g),a.hooks.run("complete",g),s&&s.call(g.element)}if(a.hooks.run("before-sanity-check",g),f=g.element.parentElement,f&&f.nodeName.toLowerCase()==="pre"&&!f.hasAttribute("tabindex")&&f.setAttribute("tabindex","0"),!g.code){a.hooks.run("complete",g),s&&s.call(g.element);return}if(a.hooks.run("before-highlight",g),!g.grammar){w(a.util.encode(g.code));return}if(n&&d.Worker){var m=new Worker(a.filename);m.onmessage=function(k){w(k.data)},m.postMessage(JSON.stringify({language:g.language,code:g.code,immediateClose:!0}))}else w(a.highlight(g.code,g.grammar,g.language))},highlight:function(t,n,s){var o={code:t,grammar:n,language:s};return a.hooks.run("before-tokenize",o),o.tokens=a.tokenize(o.code,o.grammar),a.hooks.run("after-tokenize",o),u.stringify(a.util.encode(o.tokens),o.language)},tokenize:function(t,n){var s=n.rest;if(s){for(var o in s)n[o]=s[o];delete n.rest}var l=new $;return v(l,l.head,t),x(t,l,n,l.head,0),F(l)},hooks:{all:{},add:function(t,n){var s=a.hooks.all;s[t]=s[t]||[],s[t].push(n)},run:function(t,n){var s=a.hooks.all[t];if(!(!s||!s.length))for(var o=0,l;l=s[o++];)l(n)}},Token:u};d.Prism=a;function u(t,n,s,o){this.type=t,this.content=n,this.alias=s,this.length=(o||"").length|0}u.stringify=function t(n,s){if(typeof n=="string")return n;if(Array.isArray(n)){var o="";return n.forEach(function(w){o+=t(w,s)}),o}var l={type:n.type,content:t(n.content,s),tag:"span",classes:["token",n.type],attributes:{},language:s},f=n.alias;f&&(Array.isArray(f)?Array.prototype.push.apply(l.classes,f):l.classes.push(f)),a.hooks.run("wrap",l);var y="";for(var g in l.attributes)y+=" "+g+'="'+(l.attributes[g]||"").replace(/"/g,"&quot;")+'"';return"<"+l.tag+' class="'+l.classes.join(" ")+'"'+y+">"+l.content+"</"+l.tag+">"};function c(t,n,s,o){t.lastIndex=n;var l=t.exec(s);if(l&&o&&l[1]){var f=l[1].length;l.index+=f,l[0]=l[0].slice(f)}return l}function x(t,n,s,o,l,f){for(var y in s)if(!(!s.hasOwnProperty(y)||!s[y])){var g=s[y];g=Array.isArray(g)?g:[g];for(var w=0;w<g.length;++w){if(f&&f.cause==y+","+w)return;var m=g[w],k=m.inside,K=!!m.lookbehind,ee=!!m.greedy,ve=m.alias;if(ee&&!m.pattern.global){var we=m.pattern.toString().match(/[imsuy]*$/)[0];m.pattern=RegExp(m.pattern.source,we+"g")}for(var te=m.pattern||m,_=o.next,C=l;_!==n.tail&&!(f&&C>=f.reach);C+=_.value.length,_=_.next){var T=_.value;if(n.length>t.length)return;if(!(T instanceof u)){var I=1,A;if(ee){if(A=c(te,C,t,K),!A)break;var j=A.index,_e=A.index+A[0].length,N=C;for(N+=_.value.length;j>=N;)_=_.next,N+=_.value.length;if(N-=_.value.length,C=N,_.value instanceof u)continue;for(var O=_;O!==n.tail&&(N<_e||typeof O.value=="string");O=O.next)I++,N+=O.value.length;I--,T=t.slice(C,N),A.index-=C}else if(A=c(te,0,T,K),!A)continue;var j=A.index,L=A[0],Z=T.slice(0,j),ne=T.slice(j+L.length),H=C+T.length;f&&H>f.reach&&(f.reach=H);var q=_.prev;Z&&(q=v(n,q,Z),C+=Z.length),S(n,q,I);var ke=new u(y,k?a.tokenize(L,k):L,ve,L);if(_=v(n,q,ke),ne&&v(n,_,ne),I>1){var W={cause:y+","+w,reach:H};x(t,n,s,_.prev,C,W),f&&W.reach>f.reach&&(f.reach=W.reach)}}}}}}function $(){var t={value:null,prev:null,next:null},n={value:null,prev:t,next:null};t.next=n,this.head=t,this.tail=n,this.length=0}function v(t,n,s){var o=n.next,l={value:s,prev:n,next:o};return n.next=l,o.prev=l,t.length++,l}function S(t,n,s){for(var o=n.next,l=0;l<s&&o!==t.tail;l++)o=o.next;n.next=o,o.prev=n,t.length-=l}function F(t){for(var n=[],s=t.head.next;s!==t.tail;)n.push(s.value),s=s.next;return n}if(!d.document)return d.addEventListener&&(a.disableWorkerMessageHandler||d.addEventListener("message",function(t){var n=JSON.parse(t.data),s=n.language,o=n.code,l=n.immediateClose;d.postMessage(a.highlight(o,a.languages[s],s)),l&&d.close()},!1)),a;var E=a.util.currentScript();E&&(a.filename=E.src,E.hasAttribute("data-manual")&&(a.manual=!0));function z(){a.manual||a.highlightAll()}if(!a.manual){var P=document.readyState;P==="loading"||P==="interactive"&&E&&E.defer?document.addEventListener("DOMContentLoaded",z):window.requestAnimationFrame?window.requestAnimationFrame(z):window.setTimeout(z,16)}return a}(e);r.exports&&(r.exports=i),typeof J!="undefined"&&(J.Prism=i)})(R),function(r){function e(i,d){return"___"+i.toUpperCase()+d+"___"}Object.defineProperties(r.languages["markup-templating"]={},{buildPlaceholders:{value:function(i,d,h,b){if(i.language===d){var p=i.tokenStack=[];i.code=i.code.replace(h,function(a){if(typeof b=="function"&&!b(a))return a;for(var u=p.length,c;i.code.indexOf(c=e(d,u))!==-1;)++u;return p[u]=a,c}),i.grammar=r.languages.markup}}},tokenizePlaceholders:{value:function(i,d){if(i.language!==d||!i.tokenStack)return;i.grammar=r.languages[d];var h=0,b=Object.keys(i.tokenStack);function p(a){for(var u=0;u<a.length&&!(h>=b.length);u++){var c=a[u];if(typeof c=="string"||c.content&&typeof c.content=="string"){var x=b[h],$=i.tokenStack[x],v=typeof c=="string"?c:c.content,S=e(d,x),F=v.indexOf(S);if(F>-1){++h;var E=v.substring(0,F),z=new r.Token(d,r.tokenize($,i.grammar),"language-"+d,$),P=v.substring(F+S.length),t=[];E&&t.push.apply(t,p([E])),t.push(z),P&&t.push.apply(t,p([P])),typeof c=="string"?a.splice.apply(a,[u,1].concat(t)):c.content=t}}else c.content&&p(c.content)}return a}p(i.tokens)}}})}(Prism),Prism.languages.clike={comment:[{pattern:/(^|[^\\])\/\*[\s\S]*?(?:\*\/|$)/,lookbehind:!0,greedy:!0},{pattern:/(^|[^\\:])\/\/.*/,lookbehind:!0,greedy:!0}],string:{pattern:/(["'])(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,greedy:!0},"class-name":{pattern:/(\b(?:class|interface|extends|implements|trait|instanceof|new)\s+|\bcatch\s+\()[\w.\\]+/i,lookbehind:!0,inside:{punctuation:/[.\\]/}},keyword:/\b(?:if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/,boolean:/\b(?:true|false)\b/,function:/\b\w+(?=\()/,number:/\b0x[\da-f]+\b|(?:\b\d+(?:\.\d*)?|\B\.\d+)(?:e[+-]?\d+)?/i,operator:/[<>]=?|[!=]=?=?|--?|\+\+?|&&?|\|\|?|[?*/~^%]/,punctuation:/[{}[\];(),.:]/},function(r){var e=/(?:"(?:\\(?:\r\n|[\s\S])|[^"\\\r\n])*"|'(?:\\(?:\r\n|[\s\S])|[^'\\\r\n])*')/;r.languages.css={comment:/\/\*[\s\S]*?\*\//,atrule:{pattern:/@[\w-](?:[^;{\s]|\s+(?![\s{]))*(?:;|(?=\s*\{))/,inside:{rule:/^@[\w-]+/,"selector-function-argument":{pattern:/(\bselector\s*\(\s*(?![\s)]))(?:[^()\s]|\s+(?![\s)])|\((?:[^()]|\([^()]*\))*\))+(?=\s*\))/,lookbehind:!0,alias:"selector"},keyword:{pattern:/(^|[^\w-])(?:and|not|only|or)(?![\w-])/,lookbehind:!0}}},url:{pattern:RegExp("\\burl\\((?:"+e.source+"|"+/(?:[^\\\r\n()"']|\\[\s\S])*/.source+")\\)","i"),greedy:!0,inside:{function:/^url/i,punctuation:/^\(|\)$/,string:{pattern:RegExp("^"+e.source+"$"),alias:"url"}}},selector:{pattern:RegExp(`(^|[{}\\s])[^{}\\s](?:[^{};"'\\s]|\\s+(?![\\s{])|`+e.source+")*(?=\\s*\\{)"),lookbehind:!0},string:{pattern:e,greedy:!0},property:{pattern:/(^|[^-\w\xA0-\uFFFF])(?!\s)[-_a-z\xA0-\uFFFF](?:(?!\s)[-\w\xA0-\uFFFF])*(?=\s*:)/i,lookbehind:!0},important:/!important\b/i,function:{pattern:/(^|[^-a-z0-9])[-a-z0-9]+(?=\()/i,lookbehind:!0},punctuation:/[(){};:,]/},r.languages.css.atrule.inside.rest=r.languages.css;var i=r.languages.markup;i&&(i.tag.addInlined("style","css"),i.tag.addAttribute("style","css"))}(Prism),Prism.languages.javascript=Prism.languages.extend("clike",{"class-name":[Prism.languages.clike["class-name"],{pattern:/(^|[^$\w\xA0-\uFFFF])(?!\s)[_$A-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\.(?:prototype|constructor))/,lookbehind:!0}],keyword:[{pattern:/((?:^|\})\s*)catch\b/,lookbehind:!0},{pattern:/(^|[^.]|\.\.\.\s*)\b(?:as|assert(?=\s*\{)|async(?=\s*(?:function\b|\(|[$\w\xA0-\uFFFF]|$))|await|break|case|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally(?=\s*(?:\{|$))|for|from(?=\s*(?:['"]|$))|function|(?:get|set)(?=\s*(?:[#\[$\w\xA0-\uFFFF]|$))|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)\b/,lookbehind:!0}],function:/#?(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*(?:\.\s*(?:apply|bind|call)\s*)?\()/,number:/\b(?:(?:0[xX](?:[\dA-Fa-f](?:_[\dA-Fa-f])?)+|0[bB](?:[01](?:_[01])?)+|0[oO](?:[0-7](?:_[0-7])?)+)n?|(?:\d(?:_\d)?)+n|NaN|Infinity)\b|(?:\b(?:\d(?:_\d)?)+\.?(?:\d(?:_\d)?)*|\B\.(?:\d(?:_\d)?)+)(?:[Ee][+-]?(?:\d(?:_\d)?)+)?/,operator:/--|\+\+|\*\*=?|=>|&&=?|\|\|=?|[!=]==|<<=?|>>>?=?|[-+*/%&|^!=<>]=?|\.{3}|\?\?=?|\?\.?|[~:]/}),Prism.languages.javascript["class-name"][0].pattern=/(\b(?:class|interface|extends|implements|instanceof|new)\s+)[\w.\\]+/,Prism.languages.insertBefore("javascript","keyword",{regex:{pattern:/((?:^|[^$\w\xA0-\uFFFF."'\])\s]|\b(?:return|yield))\s*)\/(?:\[(?:[^\]\\\r\n]|\\.)*\]|\\.|[^/\\\[\r\n])+\/[dgimyus]{0,7}(?=(?:\s|\/\*(?:[^*]|\*(?!\/))*\*\/)*(?:$|[\r\n,.;:})\]]|\/\/))/,lookbehind:!0,greedy:!0,inside:{"regex-source":{pattern:/^(\/)[\s\S]+(?=\/[a-z]*$)/,lookbehind:!0,alias:"language-regex",inside:Prism.languages.regex},"regex-delimiter":/^\/|\/$/,"regex-flags":/^[a-z]+$/}},"function-variable":{pattern:/#?(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*[=:]\s*(?:async\s*)?(?:\bfunction\b|(?:\((?:[^()]|\([^()]*\))*\)|(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*)\s*=>))/,alias:"function"},parameter:[{pattern:/(function(?:\s+(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*)?\s*\(\s*)(?!\s)(?:[^()\s]|\s+(?![\s)])|\([^()]*\))+(?=\s*\))/,lookbehind:!0,inside:Prism.languages.javascript},{pattern:/(^|[^$\w\xA0-\uFFFF])(?!\s)[_$a-z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*=>)/i,lookbehind:!0,inside:Prism.languages.javascript},{pattern:/(\(\s*)(?!\s)(?:[^()\s]|\s+(?![\s)])|\([^()]*\))+(?=\s*\)\s*=>)/,lookbehind:!0,inside:Prism.languages.javascript},{pattern:/((?:\b|\s|^)(?!(?:as|async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)(?![$\w\xA0-\uFFFF]))(?:(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*\s*)\(\s*|\]\s*\(\s*)(?!\s)(?:[^()\s]|\s+(?![\s)])|\([^()]*\))+(?=\s*\)\s*\{)/,lookbehind:!0,inside:Prism.languages.javascript}],constant:/\b[A-Z](?:[A-Z_]|\dx?)*\b/}),Prism.languages.insertBefore("javascript","string",{hashbang:{pattern:/^#!.*/,greedy:!0,alias:"comment"},"template-string":{pattern:/`(?:\\[\s\S]|\$\{(?:[^{}]|\{(?:[^{}]|\{[^}]*\})*\})+\}|(?!\$\{)[^\\`])*`/,greedy:!0,inside:{"template-punctuation":{pattern:/^`|`$/,alias:"string"},interpolation:{pattern:/((?:^|[^\\])(?:\\{2})*)\$\{(?:[^{}]|\{(?:[^{}]|\{[^}]*\})*\})+\}/,lookbehind:!0,inside:{"interpolation-punctuation":{pattern:/^\$\{|\}$/,alias:"punctuation"},rest:Prism.languages.javascript}},string:/[\s\S]+/}}}),Prism.languages.markup&&(Prism.languages.markup.tag.addInlined("script","javascript"),Prism.languages.markup.tag.addAttribute(/on(?:abort|blur|change|click|composition(?:end|start|update)|dblclick|error|focus(?:in|out)?|key(?:down|up)|load|mouse(?:down|enter|leave|move|out|over|up)|reset|resize|scroll|select|slotchange|submit|unload|wheel)/.source,"javascript")),Prism.languages.js=Prism.languages.javascript,Prism.languages.json={property:{pattern:/(^|[^\\])"(?:\\.|[^\\"\r\n])*"(?=\s*:)/,lookbehind:!0,greedy:!0},string:{pattern:/(^|[^\\])"(?:\\.|[^\\"\r\n])*"(?!\s*:)/,lookbehind:!0,greedy:!0},comment:{pattern:/\/\/.*|\/\*[\s\S]*?(?:\*\/|$)/,greedy:!0},number:/-?\b\d+(?:\.\d+)?(?:e[+-]?\d+)?\b/i,punctuation:/[{}[\],]/,operator:/:/,boolean:/\b(?:true|false)\b/,null:{pattern:/\bnull\b/,alias:"keyword"}},Prism.languages.webmanifest=Prism.languages.json,Prism.languages.less=Prism.languages.extend("css",{comment:[/\/\*[\s\S]*?\*\//,{pattern:/(^|[^\\])\/\/.*/,lookbehind:!0}],atrule:{pattern:/@[\w-](?:\((?:[^(){}]|\([^(){}]*\))*\)|[^(){};\s]|\s+(?!\s))*?(?=\s*\{)/,inside:{punctuation:/[:()]/}},selector:{pattern:/(?:@\{[\w-]+\}|[^{};\s@])(?:@\{[\w-]+\}|\((?:[^(){}]|\([^(){}]*\))*\)|[^(){};@\s]|\s+(?!\s))*?(?=\s*\{)/,inside:{variable:/@+[\w-]+/}},property:/(?:@\{[\w-]+\}|[\w-])+(?:\+_?)?(?=\s*:)/i,operator:/[+\-*\/]/}),Prism.languages.insertBefore("less","property",{variable:[{pattern:/@[\w-]+\s*:/,inside:{punctuation:/:/}},/@@?[\w-]+/],"mixin-usage":{pattern:/([{;]\s*)[.#](?!\d)[\w-].*?(?=[(;])/,lookbehind:!0,alias:"function"}}),function(r){var e=/\/\*[\s\S]*?\*\/|\/\/.*|#(?!\[).*/,i=[{pattern:/\b(?:false|true)\b/i,alias:"boolean"},{pattern:/(::\s*)\b[a-z_]\w*\b(?!\s*\()/i,greedy:!0,lookbehind:!0},{pattern:/(\b(?:case|const)\s+)\b[a-z_]\w*(?=\s*[;=])/i,greedy:!0,lookbehind:!0},/\b(?:null)\b/i,/\b[A-Z_][A-Z0-9_]*\b(?!\s*\()/],d=/\b0b[01]+(?:_[01]+)*\b|\b0o[0-7]+(?:_[0-7]+)*\b|\b0x[\da-f]+(?:_[\da-f]+)*\b|(?:\b\d+(?:_\d+)*\.?(?:\d+(?:_\d+)*)?|\B\.\d+)(?:e[+-]?\d+)?/i,h=/<?=>|\?\?=?|\.{3}|\??->|[!=]=?=?|::|\*\*=?|--|\+\+|&&|\|\||<<|>>|[?~]|[/^|%*&<>.+-]=?/,b=/[{}\[\](),:;]/;r.languages.php={delimiter:{pattern:/\?>$|^<\?(?:php(?=\s)|=)?/i,alias:"important"},comment:e,variable:/\$+(?:\w+\b|(?=\{))/i,package:{pattern:/(namespace\s+|use\s+(?:function\s+)?)(?:\\?\b[a-z_]\w*)+\b(?!\\)/i,lookbehind:!0,inside:{punctuation:/\\/}},"class-name-definition":{pattern:/(\b(?:class|enum|interface|trait)\s+)\b[a-z_]\w*(?!\\)\b/i,lookbehind:!0,alias:"class-name"},"function-definition":{pattern:/(\bfunction\s+)[a-z_]\w*(?=\s*\()/i,lookbehind:!0,alias:"function"},keyword:[{pattern:/(\(\s*)\b(?:bool|boolean|int|integer|float|string|object|array)\b(?=\s*\))/i,alias:"type-casting",greedy:!0,lookbehind:!0},{pattern:/([(,?]\s*)\b(?:bool|int|float|string|object|array(?!\s*\()|mixed|self|static|callable|iterable|(?:null|false)(?=\s*\|))\b(?=\s*\$)/i,alias:"type-hint",greedy:!0,lookbehind:!0},{pattern:/([(,?]\s*[\w|]\|\s*)(?:null|false)\b(?=\s*\$)/i,alias:"type-hint",greedy:!0,lookbehind:!0},{pattern:/(\)\s*:\s*(?:\?\s*)?)\b(?:bool|int|float|string|object|void|array(?!\s*\()|mixed|self|static|callable|iterable|(?:null|false)(?=\s*\|))\b/i,alias:"return-type",greedy:!0,lookbehind:!0},{pattern:/(\)\s*:\s*(?:\?\s*)?[\w|]\|\s*)(?:null|false)\b/i,alias:"return-type",greedy:!0,lookbehind:!0},{pattern:/\b(?:bool|int|float|string|object|void|array(?!\s*\()|mixed|iterable|(?:null|false)(?=\s*\|))\b/i,alias:"type-declaration",greedy:!0},{pattern:/(\|\s*)(?:null|false)\b/i,alias:"type-declaration",greedy:!0,lookbehind:!0},{pattern:/\b(?:parent|self|static)(?=\s*::)/i,alias:"static-context",greedy:!0},{pattern:/(\byield\s+)from\b/i,lookbehind:!0},/\bclass\b/i,{pattern:/((?:^|[^\s>:]|(?:^|[^-])>|(?:^|[^:]):)\s*)\b(?:__halt_compiler|abstract|and|array|as|break|callable|case|catch|clone|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|enum|eval|exit|extends|final|finally|fn|for|foreach|function|global|goto|if|implements|include|include_once|instanceof|insteadof|interface|isset|list|namespace|match|new|or|parent|print|private|protected|public|require|require_once|return|self|static|switch|throw|trait|try|unset|use|var|while|xor|yield)\b/i,lookbehind:!0}],"argument-name":{pattern:/([(,]\s+)\b[a-z_]\w*(?=\s*:(?!:))/i,lookbehind:!0},"class-name":[{pattern:/(\b(?:extends|implements|instanceof|new(?!\s+self|\s+static))\s+|\bcatch\s*\()\b[a-z_]\w*(?!\\)\b/i,greedy:!0,lookbehind:!0},{pattern:/(\|\s*)\b[a-z_]\w*(?!\\)\b/i,greedy:!0,lookbehind:!0},{pattern:/\b[a-z_]\w*(?!\\)\b(?=\s*\|)/i,greedy:!0},{pattern:/(\|\s*)(?:\\?\b[a-z_]\w*)+\b/i,alias:"class-name-fully-qualified",greedy:!0,lookbehind:!0,inside:{punctuation:/\\/}},{pattern:/(?:\\?\b[a-z_]\w*)+\b(?=\s*\|)/i,alias:"class-name-fully-qualified",greedy:!0,inside:{punctuation:/\\/}},{pattern:/(\b(?:extends|implements|instanceof|new(?!\s+self\b|\s+static\b))\s+|\bcatch\s*\()(?:\\?\b[a-z_]\w*)+\b(?!\\)/i,alias:"class-name-fully-qualified",greedy:!0,lookbehind:!0,inside:{punctuation:/\\/}},{pattern:/\b[a-z_]\w*(?=\s*\$)/i,alias:"type-declaration",greedy:!0},{pattern:/(?:\\?\b[a-z_]\w*)+(?=\s*\$)/i,alias:["class-name-fully-qualified","type-declaration"],greedy:!0,inside:{punctuation:/\\/}},{pattern:/\b[a-z_]\w*(?=\s*::)/i,alias:"static-context",greedy:!0},{pattern:/(?:\\?\b[a-z_]\w*)+(?=\s*::)/i,alias:["class-name-fully-qualified","static-context"],greedy:!0,inside:{punctuation:/\\/}},{pattern:/([(,?]\s*)[a-z_]\w*(?=\s*\$)/i,alias:"type-hint",greedy:!0,lookbehind:!0},{pattern:/([(,?]\s*)(?:\\?\b[a-z_]\w*)+(?=\s*\$)/i,alias:["class-name-fully-qualified","type-hint"],greedy:!0,lookbehind:!0,inside:{punctuation:/\\/}},{pattern:/(\)\s*:\s*(?:\?\s*)?)\b[a-z_]\w*(?!\\)\b/i,alias:"return-type",greedy:!0,lookbehind:!0},{pattern:/(\)\s*:\s*(?:\?\s*)?)(?:\\?\b[a-z_]\w*)+\b(?!\\)/i,alias:["class-name-fully-qualified","return-type"],greedy:!0,lookbehind:!0,inside:{punctuation:/\\/}}],constant:i,function:{pattern:/(^|[^\\\w])\\?[a-z_](?:[\w\\]*\w)?(?=\s*\()/i,lookbehind:!0,inside:{punctuation:/\\/}},property:{pattern:/(->\s*)\w+/,lookbehind:!0},number:d,operator:h,punctuation:b};var p={pattern:/\{\$(?:\{(?:\{[^{}]+\}|[^{}]+)\}|[^{}])+\}|(^|[^\\{])\$+(?:\w+(?:\[[^\r\n\[\]]+\]|->\w+)?)/,lookbehind:!0,inside:r.languages.php},a=[{pattern:/<<<'([^']+)'[\r\n](?:.*[\r\n])*?\1;/,alias:"nowdoc-string",greedy:!0,inside:{delimiter:{pattern:/^<<<'[^']+'|[a-z_]\w*;$/i,alias:"symbol",inside:{punctuation:/^<<<'?|[';]$/}}}},{pattern:/<<<(?:"([^"]+)"[\r\n](?:.*[\r\n])*?\1;|([a-z_]\w*)[\r\n](?:.*[\r\n])*?\2;)/i,alias:"heredoc-string",greedy:!0,inside:{delimiter:{pattern:/^<<<(?:"[^"]+"|[a-z_]\w*)|[a-z_]\w*;$/i,alias:"symbol",inside:{punctuation:/^<<<"?|[";]$/}},interpolation:p}},{pattern:/`(?:\\[\s\S]|[^\\`])*`/,alias:"backtick-quoted-string",greedy:!0},{pattern:/'(?:\\[\s\S]|[^\\'])*'/,alias:"single-quoted-string",greedy:!0},{pattern:/"(?:\\[\s\S]|[^\\"])*"/,alias:"double-quoted-string",greedy:!0,inside:{interpolation:p}}];r.languages.insertBefore("php","variable",{string:a,attribute:{pattern:/#\[(?:[^"'\/#]|\/(?![*/])|\/\/.*$|#(?!\[).*$|\/\*(?:[^*]|\*(?!\/))*\*\/|"(?:\\[\s\S]|[^\\"])*"|'(?:\\[\s\S]|[^\\'])*')+\](?=\s*[a-z$#])/im,greedy:!0,inside:{"attribute-content":{pattern:/^(#\[)[\s\S]+(?=\]$)/,lookbehind:!0,inside:{comment:e,string:a,"attribute-class-name":[{pattern:/([^:]|^)\b[a-z_]\w*(?!\\)\b/i,alias:"class-name",greedy:!0,lookbehind:!0},{pattern:/([^:]|^)(?:\\?\b[a-z_]\w*)+/i,alias:["class-name","class-name-fully-qualified"],greedy:!0,lookbehind:!0,inside:{punctuation:/\\/}}],constant:i,number:d,operator:h,punctuation:b}},delimiter:{pattern:/^#\[|\]$/,alias:"punctuation"}}}}),r.hooks.add("before-tokenize",function(u){if(!!/<\?/.test(u.code)){var c=/<\?(?:[^"'/#]|\/(?![*/])|("|')(?:\\[\s\S]|(?!\1)[^\\])*\1|(?:\/\/|#(?!\[))(?:[^?\n\r]|\?(?!>))*(?=$|\?>|[\r\n])|#\[|\/\*(?:[^*]|\*(?!\/))*(?:\*\/|$))*?(?:\?>|$)/gi;r.languages["markup-templating"].buildPlaceholders(u,"php",c)}}),r.hooks.add("after-tokenize",function(u){r.languages["markup-templating"].tokenizePlaceholders(u,"php")})}(Prism),Prism.languages.python={comment:{pattern:/(^|[^\\])#.*/,lookbehind:!0},"string-interpolation":{pattern:/(?:f|rf|fr)(?:("""|''')[\s\S]*?\1|("|')(?:\\.|(?!\2)[^\\\r\n])*\2)/i,greedy:!0,inside:{interpolation:{pattern:/((?:^|[^{])(?:\{\{)*)\{(?!\{)(?:[^{}]|\{(?!\{)(?:[^{}]|\{(?!\{)(?:[^{}])+\})+\})+\}/,lookbehind:!0,inside:{"format-spec":{pattern:/(:)[^:(){}]+(?=\}$)/,lookbehind:!0},"conversion-option":{pattern:/![sra](?=[:}]$)/,alias:"punctuation"},rest:null}},string:/[\s\S]+/}},"triple-quoted-string":{pattern:/(?:[rub]|rb|br)?("""|''')[\s\S]*?\1/i,greedy:!0,alias:"string"},string:{pattern:/(?:[rub]|rb|br)?("|')(?:\\.|(?!\1)[^\\\r\n])*\1/i,greedy:!0},function:{pattern:/((?:^|\s)def[ \t]+)[a-zA-Z_]\w*(?=\s*\()/g,lookbehind:!0},"class-name":{pattern:/(\bclass\s+)\w+/i,lookbehind:!0},decorator:{pattern:/(^[\t ]*)@\w+(?:\.\w+)*/im,lookbehind:!0,alias:["annotation","punctuation"],inside:{punctuation:/\./}},keyword:/\b(?:and|as|assert|async|await|break|class|continue|def|del|elif|else|except|exec|finally|for|from|global|if|import|in|is|lambda|nonlocal|not|or|pass|print|raise|return|try|while|with|yield)\b/,builtin:/\b(?:__import__|abs|all|any|apply|ascii|basestring|bin|bool|buffer|bytearray|bytes|callable|chr|classmethod|cmp|coerce|compile|complex|delattr|dict|dir|divmod|enumerate|eval|execfile|file|filter|float|format|frozenset|getattr|globals|hasattr|hash|help|hex|id|input|int|intern|isinstance|issubclass|iter|len|list|locals|long|map|max|memoryview|min|next|object|oct|open|ord|pow|property|range|raw_input|reduce|reload|repr|reversed|round|set|setattr|slice|sorted|staticmethod|str|sum|super|tuple|type|unichr|unicode|vars|xrange|zip)\b/,boolean:/\b(?:True|False|None)\b/,number:/\b0(?:b(?:_?[01])+|o(?:_?[0-7])+|x(?:_?[a-f0-9])+)\b|(?:\b\d+(?:_\d+)*(?:\.(?:\d+(?:_\d+)*)?)?|\B\.\d+(?:_\d+)*)(?:e[+-]?\d+(?:_\d+)*)?j?\b/i,operator:/[-+%=]=?|!=|\*\*?=?|\/\/?=?|<[<=>]?|>[=>]?|[&|^~]/,punctuation:/[{}[\];(),.:]/},Prism.languages.python["string-interpolation"].inside.interpolation.inside.rest=Prism.languages.python,Prism.languages.py=Prism.languages.python,function(r){r.languages.ruby=r.languages.extend("clike",{comment:[/#.*/,{pattern:/^=begin\s[\s\S]*?^=end/m,greedy:!0}],"class-name":{pattern:/(\b(?:class)\s+|\bcatch\s+\()[\w.\\]+/i,lookbehind:!0,inside:{punctuation:/[.\\]/}},keyword:/\b(?:alias|and|BEGIN|begin|break|case|class|def|define_method|defined|do|each|else|elsif|END|end|ensure|extend|for|if|in|include|module|new|next|nil|not|or|prepend|protected|private|public|raise|redo|require|rescue|retry|return|self|super|then|throw|undef|unless|until|when|while|yield)\b/});var e={pattern:/#\{[^}]+\}/,inside:{delimiter:{pattern:/^#\{|\}$/,alias:"tag"},rest:r.languages.ruby}};delete r.languages.ruby.function,r.languages.insertBefore("ruby","keyword",{regex:[{pattern:RegExp(/%r/.source+"(?:"+[/([^a-zA-Z0-9\s{(\[<])(?:(?!\1)[^\\]|\\[\s\S])*\1/.source,/\((?:[^()\\]|\\[\s\S])*\)/.source,/\{(?:[^#{}\\]|#(?:\{[^}]+\})?|\\[\s\S])*\}/.source,/\[(?:[^\[\]\\]|\\[\s\S])*\]/.source,/<(?:[^<>\\]|\\[\s\S])*>/.source].join("|")+")"+/[egimnosux]{0,6}/.source),greedy:!0,inside:{interpolation:e}},{pattern:/(^|[^/])\/(?!\/)(?:\[[^\r\n\]]+\]|\\.|[^[/\\\r\n])+\/[egimnosux]{0,6}(?=\s*(?:$|[\r\n,.;})#]))/,lookbehind:!0,greedy:!0,inside:{interpolation:e}}],variable:/[@$]+[a-zA-Z_]\w*(?:[?!]|\b)/,symbol:{pattern:/(^|[^:]):[a-zA-Z_]\w*(?:[?!]|\b)/,lookbehind:!0},"method-definition":{pattern:/(\bdef\s+)[\w.]+/,lookbehind:!0,inside:{function:/\w+$/,rest:r.languages.ruby}}}),r.languages.insertBefore("ruby","number",{builtin:/\b(?:Array|Bignum|Binding|Class|Continuation|Dir|Exception|FalseClass|File|Stat|Fixnum|Float|Hash|Integer|IO|MatchData|Method|Module|NilClass|Numeric|Object|Proc|Range|Regexp|String|Struct|TMS|Symbol|ThreadGroup|Thread|Time|TrueClass)\b/,constant:/\b[A-Z]\w*(?:[?!]|\b)/}),r.languages.ruby.string=[{pattern:RegExp(/%[qQiIwWxs]?/.source+"(?:"+[/([^a-zA-Z0-9\s{(\[<])(?:(?!\1)[^\\]|\\[\s\S])*\1/.source,/\((?:[^()\\]|\\[\s\S])*\)/.source,/\{(?:[^#{}\\]|#(?:\{[^}]+\})?|\\[\s\S])*\}/.source,/\[(?:[^\[\]\\]|\\[\s\S])*\]/.source,/<(?:[^<>\\]|\\[\s\S])*>/.source].join("|")+")"),greedy:!0,inside:{interpolation:e}},{pattern:/("|')(?:#\{[^}]+\}|#(?!\{)|\\(?:\r\n|[\s\S])|(?!\1)[^\\#\r\n])*\1/,greedy:!0,inside:{interpolation:e}},{pattern:/<<[-~]?([a-z_]\w*)[\r\n](?:.*[\r\n])*?[\t ]*\1/i,alias:"heredoc-string",greedy:!0,inside:{delimiter:{pattern:/^<<[-~]?[a-z_]\w*|[a-z_]\w*$/i,alias:"symbol",inside:{punctuation:/^<<[-~]?/}},interpolation:e}},{pattern:/<<[-~]?'([a-z_]\w*)'[\r\n](?:.*[\r\n])*?[\t ]*\1/i,alias:"heredoc-string",greedy:!0,inside:{delimiter:{pattern:/^<<[-~]?'[a-z_]\w*'|[a-z_]\w*$/i,alias:"symbol",inside:{punctuation:/^<<[-~]?'|'$/}}}}],r.languages.rb=r.languages.ruby}(Prism),Prism.languages.scss=Prism.languages.extend("css",{comment:{pattern:/(^|[^\\])(?:\/\*[\s\S]*?\*\/|\/\/.*)/,lookbehind:!0},atrule:{pattern:/@[\w-](?:\([^()]+\)|[^()\s]|\s+(?!\s))*?(?=\s+[{;])/,inside:{rule:/@[\w-]+/}},url:/(?:[-a-z]+-)?url(?=\()/i,selector:{pattern:/(?=\S)[^@;{}()]?(?:[^@;{}()\s]|\s+(?!\s)|#\{\$[-\w]+\})+(?=\s*\{(?:\}|\s|[^}][^:{}]*[:{][^}]))/m,inside:{parent:{pattern:/&/,alias:"important"},placeholder:/%[-\w]+/,variable:/\$[-\w]+|#\{\$[-\w]+\}/}},property:{pattern:/(?:[-\w]|\$[-\w]|#\{\$[-\w]+\})+(?=\s*:)/,inside:{variable:/\$[-\w]+|#\{\$[-\w]+\}/}}}),Prism.languages.insertBefore("scss","atrule",{keyword:[/@(?:if|else(?: if)?|forward|for|each|while|import|use|extend|debug|warn|mixin|include|function|return|content)\b/i,{pattern:/( )(?:from|through)(?= )/,lookbehind:!0}]}),Prism.languages.insertBefore("scss","important",{variable:/\$[-\w]+|#\{\$[-\w]+\}/}),Prism.languages.insertBefore("scss","function",{"module-modifier":{pattern:/\b(?:as|with|show|hide)\b/i,alias:"keyword"},placeholder:{pattern:/%[-\w]+/,alias:"selector"},statement:{pattern:/\B!(?:default|optional)\b/i,alias:"keyword"},boolean:/\b(?:true|false)\b/,null:{pattern:/\bnull\b/,alias:"keyword"},operator:{pattern:/(\s)(?:[-+*\/%]|[=!]=|<=?|>=?|and|or|not)(?=\s)/,lookbehind:!0}}),Prism.languages.scss.atrule.inside.rest=Prism.languages.scss,function(r){var e=/[*&][^\s[\]{},]+/,i=/!(?:<[\w\-%#;/?:@&=+$,.!~*'()[\]]+>|(?:[a-zA-Z\d-]*!)?[\w\-%#;/?:@&=+$.~*'()]+)?/,d="(?:"+i.source+"(?:[ 	]+"+e.source+")?|"+e.source+"(?:[ 	]+"+i.source+")?)",h=/(?:[^\s\x00-\x08\x0e-\x1f!"#%&'*,\-:>?@[\]`{|}\x7f-\x84\x86-\x9f\ud800-\udfff\ufffe\uffff]|[?:-]<PLAIN>)(?:[ \t]*(?:(?![#:])<PLAIN>|:<PLAIN>))*/.source.replace(/<PLAIN>/g,function(){return/[^\s\x00-\x08\x0e-\x1f,[\]{}\x7f-\x84\x86-\x9f\ud800-\udfff\ufffe\uffff]/.source}),b=/"(?:[^"\\\r\n]|\\.)*"|'(?:[^'\\\r\n]|\\.)*'/.source;function p(a,u){u=(u||"").replace(/m/g,"")+"m";var c=/([:\-,[{]\s*(?:\s<<prop>>[ \t]+)?)(?:<<value>>)(?=[ \t]*(?:$|,|\]|\}|(?:[\r\n]\s*)?#))/.source.replace(/<<prop>>/g,function(){return d}).replace(/<<value>>/g,function(){return a});return RegExp(c,u)}r.languages.yaml={scalar:{pattern:RegExp(/([\-:]\s*(?:\s<<prop>>[ \t]+)?[|>])[ \t]*(?:((?:\r?\n|\r)[ \t]+)\S[^\r\n]*(?:\2[^\r\n]+)*)/.source.replace(/<<prop>>/g,function(){return d})),lookbehind:!0,alias:"string"},comment:/#.*/,key:{pattern:RegExp(/((?:^|[:\-,[{\r\n?])[ \t]*(?:<<prop>>[ \t]+)?)<<key>>(?=\s*:\s)/.source.replace(/<<prop>>/g,function(){return d}).replace(/<<key>>/g,function(){return"(?:"+h+"|"+b+")"})),lookbehind:!0,greedy:!0,alias:"atrule"},directive:{pattern:/(^[ \t]*)%.+/m,lookbehind:!0,alias:"important"},datetime:{pattern:p(/\d{4}-\d\d?-\d\d?(?:[tT]|[ \t]+)\d\d?:\d{2}:\d{2}(?:\.\d*)?(?:[ \t]*(?:Z|[-+]\d\d?(?::\d{2})?))?|\d{4}-\d{2}-\d{2}|\d\d?:\d{2}(?::\d{2}(?:\.\d*)?)?/.source),lookbehind:!0,alias:"number"},boolean:{pattern:p(/true|false/.source,"i"),lookbehind:!0,alias:"important"},null:{pattern:p(/null|~/.source,"i"),lookbehind:!0,alias:"important"},string:{pattern:p(b),lookbehind:!0,greedy:!0},number:{pattern:p(/[+-]?(?:0x[\da-f]+|0o[0-7]+|(?:\d+(?:\.\d*)?|\.\d+)(?:e[+-]?\d+)?|\.inf|\.nan)/.source,"i"),lookbehind:!0},tag:i,important:e,punctuation:/---|[:[\]{}\-,|>?]|\.\.\./},r.languages.yml=r.languages.yaml}(Prism);var $e="",pe=function(){var r=this,e=r.$createElement,i=r._self._c||e;return i("k-field",r._b({staticClass:"k-code-editor-field",attrs:{input:r.uid}},"k-field",r.$props,!1),[i("prism-editor",{staticClass:"k-code-editor-input",attrs:{highlight:r.highlighter,"line-numbers":r.lineNumbers,"tab-size":r.tabSize,"insert-spaces":r.insertSpaces,"ignore-tab-key":r.ignoreTabKey,"data-size":r.size},on:{input:r.onCodeInput},model:{value:r.code,callback:function(d){r.code=d},expression:"code"}})],1)},fe=[],Se="";function ge(r,e,i,d,h,b,p,a){var u=typeof r=="function"?r.options:r;e&&(u.render=e,u.staticRenderFns=i,u._compiled=!0),d&&(u.functional=!0),b&&(u._scopeId="data-v-"+b);var c;if(p?(c=function(v){v=v||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext,!v&&typeof __VUE_SSR_CONTEXT__!="undefined"&&(v=__VUE_SSR_CONTEXT__),h&&h.call(this,v),v&&v._registeredComponents&&v._registeredComponents.add(p)},u._ssrRegister=c):h&&(c=a?function(){h.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:h),c)if(u.functional){u._injectStyles=c;var x=u.render;u.render=function(S,F){return c.call(F),x(S,F)}}else{var $=u.beforeCreate;u.beforeCreate=$?[].concat($,c):[c]}return{exports:r,options:u}}const he={components:{PrismEditor:ce},extends:"k-textarea-field",props:{size:String,language:String,lineNumbers:Boolean,tabSize:Number,insertSpaces:Boolean,ignoreTabKey:Boolean},data(){return{code:""}},mounted(){this.code=this.value},methods:{highlighter(){return R.exports.highlight(this.code,R.exports.languages[this.language])},onCodeInput(){this.$emit("input",this.code)}}},V={};var be=ge(he,pe,fe,!1,ye,null,null,null);function ye(r){for(let e in V)this[e]=V[e]}var me=function(){return be.exports}();window.panel.plugin("sylvainjule/code-editor",{fields:{"code-editor":me}})})();})();
