jQuery(document).ready(function($) {

	// Simply load this file & the matching CSS file after superfish files and you will have a lovely mobile menu in place
	// There are a couple of classes that will need to be edited to match your site's markup, refer to comments
	// v1.1
	
	// check screen size to add superfish mobile class and other elements
	$(window).bind("load resize", function() {
		var w = $(window).width();
		if (w < 703) { // change width call as required for your site
			$('.sf-menu').addClass('sf-mobile');
			if ( $('.nav-toggle').length < 1 ) {
				$('.sf-mobile').after('<a class="nav-toggle" href="#"><span></span></a>');
				$('.sf-menu').hide();
			}
			
			var $bodychild = document.body.firstChild;
			$('.main-navigation').insertBefore($bodychild); // Change this to the class of your NAV element, or .sf-menu if no NAV used
		} else {
			$('.sf-menu').removeClass('sf-mobile');
			$('.nav-toggle').remove();
			$('.sf-menu').show();
			$('.main-navigation').insertAfter('.header h2'); // You will need to change this based on the location of the menu in your markup
		}
	});
	
	// mobile menu toggle function
	$(document).on('click', '.nav-toggle', function() {
		$('.sf-menu').slideToggle();
		this.classList.toggle( "active" );
		return false;
	});

});