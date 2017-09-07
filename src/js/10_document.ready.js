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
	
	//background
	
	var backgroundImage = function() {
		
		var obj = document.getElementById('svgBg');
		
		var selected = [];
		var current = '';
		var rows = 7;
		var cols = 36;
		var i = 1;
		var maxlegs = 10;
		
		var backgroundTime = setInterval( function() {
			
			var select;
				
			if( current === '') {
				select = startHex();
			} else {
				select = directHex(current);
			}	
			
			selected.push(select);
			current = select;
			currentSelector = '.hex-' + current;
			//console.log(currentSelector);
			var svgDoc = obj.contentDocument;
			var select = svgDoc.querySelector( currentSelector );
			select.classList.add('select');
			
			if (i >= maxlegs) {
				clearInterval(backgroundTime);
			} else {
				i++;
			}
			
		}, 500);
		
		function startHex() {
				
				var random = randHex(rows, cols);
				
				if ( selected.indexOf( random ) === -1 ) {
					return random;
				} else {
					startHex();
				}
				
		};
			
		function randHex(maxrows, maxcols) {
			var row = Math.floor( Math.random() * maxrows ) + 1;
			var col = Math.floor( Math.random() * maxcols ) + 1;
		
		return col.toString() + '-' + row.toString();
		
		}
		
		function directHex(hex) {
				 
				var delimeterPos = hex.indexOf('-');
				var col = Number( hex.substr(0, delimeterPos) );
				var row = Number( hex.substr(delimeterPos + 1) );
				var odd = col % 2 > 0 ? true : false;
				var direction = Math.floor(Math.random() * 6) + 1;
				
				return proposeDirection(direction);
				
/*
				function returnHex() {
					
					
					var nextHex = proposeDirection(direction);
					
					if ( selected.indexOf( nextHex ) === -1 ) {
						return nextHex;
					} else {
						returnHex();
					}
				};
*/
				
				
				function proposeDirection(dir) {
					
					var newcol, newrow;
					
					switch (dir) {
						 case 1: 
						 //odd mode upper right: col + 1, row -1					 
						 //even mode upper right: col + 1, row =
						 newcol = col + 1;
						 newrow = odd ? row - 1 : row;
						 break;
						 case 2: 
						 //odd mode right: col + 2, row =
						 //even mode right: col + 2, row =
						 newcol = col + 2;
						 newrow = row;
						 break;
						 case 3:
						 //odd mode lower right: col + 1, row =
						 //even mode lower right: col + 1, row +1
						 newcol = col + 1;
						 newrow = odd ? row : row + 1;
						 break;
						 case 4:
						 //odd mode lower left right: col - 1, row =
						 //even mode lower left right: col - 1, row +1
						 newcol = col - 1;
						 newrow = odd ? row : row + 1;
						 break;
						 case 5:
						 //odd mode left : col - 2, row =
						 //even mode left : col - 2, row =
						 newcol = col - 2;
						 newrow = row;
						 break;
						 case 6:
						 //odd mode upper left : col - 1, row -1
						 //even mode upper left : col - 1, row =
						 newcol = col - 1;
						 newrow = odd ? row - 1 : row;
						 break;
						 default:
						 newcol = col;
						 newrow = row;
					}//switch
					
					return newcol + '-' + newrow;
				
				}
				
				
				
				
			}
	}();
	
	
	
	
/*
	var hex = function(init) {
		var start = init ? init : ;
	}
*/
	
	
	
	
})(jQuery);