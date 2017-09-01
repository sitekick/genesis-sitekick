/*! modernizr 3.5.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-flexbox-placeholder-mq-setclasses !*/
!function(e,n,t){function r(e,n){return typeof e===n}function o(){var e,n,t,o,s,i,l;for(var a in S)if(S.hasOwnProperty(a)){if(e=[],n=S[a],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(o=r(n.fn,"function")?n.fn():n.fn,s=0;s<e.length;s++)i=e[s],l=i.split("."),1===l.length?Modernizr[l[0]]=o:(!Modernizr[l[0]]||Modernizr[l[0]]instanceof Boolean||(Modernizr[l[0]]=new Boolean(Modernizr[l[0]])),Modernizr[l[0]][l[1]]=o),C.push((o?"":"no-")+l.join("-"))}}function s(e){var n=x.className,t=Modernizr._config.classPrefix||"";if(_&&(n=n.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(r,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),_?x.className.baseVal=n:x.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):_?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function l(){var e=n.body;return e||(e=i(_?"svg":"body"),e.fake=!0),e}function a(e,t,r,o){var s,a,u,f,c="modernizr",d=i("div"),p=l();if(parseInt(r,10))for(;r--;)u=i("div"),u.id=o?o[r]:c+(r+1),d.appendChild(u);return s=i("style"),s.type="text/css",s.id="s"+c,(p.fake?p:d).appendChild(s),p.appendChild(d),s.styleSheet?s.styleSheet.cssText=e:s.appendChild(n.createTextNode(e)),d.id=c,p.fake&&(p.style.background="",p.style.overflow="hidden",f=x.style.overflow,x.style.overflow="hidden",x.appendChild(p)),a=t(d,e),p.fake?(p.parentNode.removeChild(p),x.style.overflow=f,x.offsetHeight):d.parentNode.removeChild(d),!!a}function u(e,n){return!!~(""+e).indexOf(n)}function f(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function c(e,n){return function(){return e.apply(n,arguments)}}function d(e,n,t){var o;for(var s in e)if(e[s]in n)return t===!1?e[s]:(o=n[e[s]],r(o,"function")?c(o,t||n):o);return!1}function p(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(n,t,r){var o;if("getComputedStyle"in e){o=getComputedStyle.call(e,n,t);var s=e.console;if(null!==o)r&&(o=o.getPropertyValue(r));else if(s){var i=s.error?"error":"log";s[i].call(s,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else o=!t&&n.currentStyle&&n.currentStyle[r];return o}function h(n,r){var o=n.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(p(n[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var s=[];o--;)s.push("("+p(n[o])+":"+r+")");return s=s.join(" or "),a("@supports ("+s+") { #modernizr { position: absolute; } }",function(e){return"absolute"==m(e,null,"position")})}return t}function v(e,n,o,s){function l(){c&&(delete T.style,delete T.modElem)}if(s=r(s,"undefined")?!1:s,!r(o,"undefined")){var a=h(e,o);if(!r(a,"undefined"))return a}for(var c,d,p,m,v,y=["modernizr","tspan","samp"];!T.style&&y.length;)c=!0,T.modElem=i(y.shift()),T.style=T.modElem.style;for(p=e.length,d=0;p>d;d++)if(m=e[d],v=T.style[m],u(m,"-")&&(m=f(m)),T.style[m]!==t){if(s||r(o,"undefined"))return l(),"pfx"==n?m:!0;try{T.style[m]=o}catch(g){}if(T.style[m]!=v)return l(),"pfx"==n?m:!0}return l(),!1}function y(e,n,t,o,s){var i=e.charAt(0).toUpperCase()+e.slice(1),l=(e+" "+P.join(i+" ")+i).split(" ");return r(n,"string")||r(n,"undefined")?v(l,n,o,s):(l=(e+" "+E.join(i+" ")+i).split(" "),d(l,n,t))}function g(e,n,r){return y(e,t,t,n,r)}var C=[],S=[],w={_version:"3.5.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){S.push({name:e,fn:n,options:t})},addAsyncTest:function(e){S.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=w,Modernizr=new Modernizr;var x=n.documentElement,_="svg"===x.nodeName.toLowerCase();Modernizr.addTest("placeholder","placeholder"in i("input")&&"placeholder"in i("textarea"));var b=function(){var n=e.matchMedia||e.msMatchMedia;return n?function(e){var t=n(e);return t&&t.matches||!1}:function(n){var t=!1;return a("@media "+n+" { #modernizr { position: absolute; } }",function(n){t="absolute"==(e.getComputedStyle?e.getComputedStyle(n,null):n.currentStyle).position}),t}}();w.mq=b;var z="Moz O ms Webkit",P=w._config.usePrefixes?z.split(" "):[];w._cssomPrefixes=P;var E=w._config.usePrefixes?z.toLowerCase().split(" "):[];w._domPrefixes=E;var N={elem:i("modernizr")};Modernizr._q.push(function(){delete N.elem});var T={style:N.elem.style};Modernizr._q.unshift(function(){delete T.style}),w.testAllProps=y,w.testAllProps=g,Modernizr.addTest("flexbox",g("flexBasis","1px",!0)),o(),s(C),delete w.addTest,delete w.addAsyncTest;for(var j=0;j<Modernizr._q.length;j++)Modernizr._q[j]();e.Modernizr=Modernizr}(window,document);
var resizeQuery = (function () {
	
		/* Version 2
			
			USAGE:
				
			var events = {
				'(max-width: 500px)' : function(){
					//do stuff when screen is first resized to a size smaller than 500px;
				},
				'(min-width: 800px)' : {}, // register the query only for comparison; may be needed for intended 'any' change usage
				'(min-width: 500px)' : function(){
					//do stuff when screen is first resized to a size larger than 500px;
				},
				'(any)' : function(){
					// Optional: do stuff when screen is first resized to a size different than the current media query bounds; 
					NOTE: Will only fire for changes between media queries described in the events object;
				}
			};
			
			var rq = resizeQuery(events);
			
			(object) events : contains objects keyed on a media query with a callback as value to invoke when a screen has been resized to match
			NOTE REGARDING MULTIPLE MATCHING QUERIES:
			The first matching query will be triggered; so order the queries appropriately when multiple queries can match i.e. 
			• min-width: 800px; min-width: 500px; NOT min-width: 500px; min-width: 800px;
			• max-width: 600px; max-width: 700px; NOT max-width: 700px; max-width: 600px; 
			
			var rq = resizeQuery(events, true);
			(boolean) init : check for a matching query on initialization of the script(true) or wait for resize to occur (falsey) 
				
		*/
		
		var mQueries,
			currentMQ;
		
		var monitorMQ = function (eventsobj, init) {
			
			mQueries = _defineQueries(eventsobj);
			currentMQ = _idQuery();
			
			//stores active media query to compare against when resizing
			var tmpMQ = currentMQ;
			//for initial size flag
			if(init === true){
				_fireCallback(eventsobj,currentMQ);
			}
			
			window.onresize = function() {
				var newMQ = _idQuery();
			
				if(newMQ != tmpMQ){
					_fireCallback(eventsobj,newMQ);
					
					if(eventsobj['(any)']){
						_fireCallback(eventsobj,'(any)');
					}
					
					tmpMQ = newMQ;
				};
			};

		} //monitorMQ;
		
		function _defineQueries(events) {
			// create an array containing queries present in the events object; remove 'any' key if present
			function removeAny(str) {
				return str != '(any)';
			}
			
			var queries = Object.keys(events).filter(removeAny) || [];
			
			return queries;
		}

		function _idQuery() {
			// return active media query; if found
			
			var active = currentMQ || '';
			
			for (var i=0 ;i < mQueries.length; i++) {
				
				if(Modernizr.mq(mQueries[i]) === true){
					active = mQueries[i];
					break;
				}
				
			}
			
			return active;
		}
		
		function _fireCallback(events,index) {

			return typeof(events[index]) === 'function' && events[index]();
				
		}
		
		return monitorMQ; 
	
})();
(function($){
	//@todo: programmatic tab/anchor cycling

	//setup resizeQuery
	var events = {
				'(min-width: 600px)' : function(){
					//Tabs
					if( !$('#entry-tabs').hasClass('ui-tabs') ) {
						$('#entry-tabs').tabs();
						
						$('#entry-tabs li.activate-tab a').on('click', function() {
							var tabindex = $(this).attr('data-tab-index');
							$('#entry-tabs').tabs("option", "active", tabindex);
						});	
				
					}
				},
				'(max-width: 600px)' : function(){

					//Disable tabs for mobile
					if( $('#entry-tabs').hasClass('ui-tabs') ) {
						$('#entry-tabs').tabs('destroy');
						$('#entry-tabs li.activate-tab a').off();
					}
						
			
				}
			};
			
	var rq = resizeQuery(events, true);
	
	//Menu 
	$('#menu-main-menu > .menu-item').attr('tabindex',0).find('.sub-menu .menu-item a').attr('tabindex', -1);
	
	$('.menu-toggle').on({
		click : function(){
			$(this).toggleClass('active');
			$('.header-widget-area').toggleClass('active');	
			$('.menu-item-has-children').not(':has(button)')
				.prepend('<button class="close-btn">✕</button')
				.on({
					focusin : function() { mobileSubNav(this) },
					mouseenter : function() { mobileSubNav(this) }
			});
			
		}
	})
	
	function mobileSubNav(el) {
			$(el).addClass('active');
			$('.close-btn', el)
				.attr('tabindex',0)
				.on('click', function(e) {
					$(this).parent('li').removeClass('active');
				});
	}
	
	// Landing page effects
	$('#landing-page-cta, #landing-page-image').on({
		click : function(){
			$(this).parent('div').addClass('clicked');
		}
	})
	
	$('#landing-page-cta2').on({
		click : function(){
			var action = $('div.entry-action');
			if( !action.hasClass('clicked') )
				action.addClass('clicked');
		}
	})
	
	$('#landing-page-form-close').on({
		click : function(){
			$(this).parents('div.entry-action').removeClass('clicked');
		}
	})
	
	//search form

	$('.search-form').on({
		focusin : function() {
			$(this).addClass('focus');
		},
		focusout : function() {

			var searchfield = $(this).find('input[type=search]');
			//retain focus state while search field has entered value
			if( ! searchfield.attr('value') ) {
				$(this).removeClass('focus');
			}
			
			
		}
	});
	
})(jQuery);