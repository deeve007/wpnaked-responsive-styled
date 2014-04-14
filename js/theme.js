jQuery(document).ready(function($) {

	// initiate fluidvids to display videos at 100% width
	fluidvids.init({
	  selector: 'iframe', // runs querySelectorAll()
	  players: ['www.youtube.com', 'player.vimeo.com'] // players to support
	});

});