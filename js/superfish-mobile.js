jQuery(document).ready(function($) {

	// Simply load this file after superfish files and you will have a lovely mobile menu in place
	// v1.0
	
	// check screen size to add superfish mobile class and other elements
	$(window).bind("load resize", function() {
		var w = $(window).width();
		if (w < 720) { // change width call as required for your site
			$('.sf-menu').addClass('sf-mobile');
			if ( $('.togglebutt').length < 1 ) {
				$('.sf-mobile').before('<div class="togglebutt" href="#">Menu</div>');
			}
			// $('.sf-menu').hide();
		} else {
			$('.sf-menu').removeClass('sf-mobile');
			$('.togglebutt').remove();
			$('.sf-menu').show();
		}
	});
	
	// mobile menu toggle function
	$(document).on('click', '.togglebutt', function() {
		$('.sf-menu').toggle();
		return false;
	});

});