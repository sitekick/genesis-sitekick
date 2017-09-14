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
	
	//Owl sliders
	$('#achievements').owlCarousel({
    	items:1,
		loop:true,
	    nav: false,
	    dots: true,
	    autoHeight:true
	});	
	
	
})(jQuery);