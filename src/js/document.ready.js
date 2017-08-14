(function($){
	//@todo: programmatic tab/anchor cycling
	//@todo: gulp, concat, minify scripts
	
	$('#menu-main-menu > .menu-item').attr('tabindex',0).find('.sub-menu .menu-item a').attr('tabindex', -1);
	
	$('.menu-toggle').on({
		click : function(){
			$(this).toggleClass('active');
			$('#menu-main-menu').toggleClass('active');
			$('.menu-item-has-children')
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
	
	$('#landing-page-one-cta').on({
		click : function(e){
			$(this).parent('div').toggleClass('clicked');
		}
	})
	
})(jQuery);