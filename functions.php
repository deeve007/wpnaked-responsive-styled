<?php
/**
 * WPnaked functions and definitions
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package		WordPress
 * @subpackage	WPnaked Responsive
 * @since		WPnaked Responsive 1.0
 */
 

/*-----------------------------------------------------------------------------------*/
/* Some basic Wordpress stuff
/*-----------------------------------------------------------------------------------*/
/* Add RSS to Head */
add_theme_support( 'automatic-feed-links' );

/* Remove ugly Wordpress toolbar from frontend */
add_filter('show_admin_bar', '__return_false');

add_theme_support('post-thumbnails');
register_nav_menus(array('primary' => 'Primary Navigation'));

if ( ! isset( $content_width ) )
	$content_width = 1200;
	
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
	
/* Add image sizes for use in theme */
add_image_size( 'post-main', 960, 540, true ); // main image for posts and pages


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function load_the_scripts()  { 

	// jquery deregister and re-enqueue to load in footer rather than head
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', '/wp-includes/js/jquery/jquery.js', false, null, true );
	
	// load fluidvids
	wp_enqueue_script( 'load-fluidvids', get_template_directory_uri() . '/js/fluidvids.min.js','',null,true );
	
	// load theme scripts & wordpress jquery
	wp_enqueue_script( 'load-themejs', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ),null,true );
	
	// load CSS reset
	wp_enqueue_style( 'load-reset', '//normalize-css.googlecode.com/svn/trunk/normalize.css','', 'screen' );
	// if you would prefer to use a total reset rather than normalize simply comment out the above line and uncomment the line below
	// wp_enqueue_style( 'load-reset', '//yui.yahooapis.com/3.13.0/build/cssreset/cssreset-min.css','', 'screen' );
	
	// Let's have some superfish menu action
	wp_enqueue_style( 'superfish-css', get_template_directory_uri() . '/css/superfish.css','', 'screen' );
	wp_enqueue_script( 'superfish1-js', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ),null,true );
	wp_enqueue_script( 'superfish2-js', get_template_directory_uri() . '/js/superfish.min.js', array( 'superfish1-js' ),null,true );
	// And mobile superfish
	wp_enqueue_style( 'superfish-mobile-css', get_template_directory_uri() . '/css/superfish-mobile.css','', 'screen' );
	wp_enqueue_script( 'superfish-mobile-js', get_template_directory_uri() . '/js/superfish-mobile.js', array( 'superfish2-js' ),null,true );
	
	// Let's add some nice web fonts for style - comment out or delete if you don't want to use these fonts
	wp_enqueue_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans' );
	wp_enqueue_style( 'font-rokkitt', 'http://fonts.googleapis.com/css?family=Rokkitt' );
	
	// load theme stylesheets
	wp_enqueue_style( 'load-grid', get_template_directory_uri() . '/css/grid.css', array( 'load-reset' ), 'screen' );
	wp_enqueue_style( 'load-style', get_template_directory_uri() . '/style.css', array( 'load-reset' ), 'screen' );
	
	// add support for child themes without needing to manually import parent theme style.css via @import
	// add after parent theme css so it can override settings if required
	if ( get_stylesheet_directory_uri() != get_template_directory_uri() ) {
		wp_register_style( 'childcss', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
		wp_enqueue_style( 'childcss' );
	}
  
}
if (!is_admin()) add_action("wp_enqueue_scripts", "load_the_scripts");

// add html5 shim to header for html5 support for ie8 and below
// respond.js to header for media query support for ie8
// use CDN hosted as simpler to remove when ie8 support no longer required
function add_ie_support () {
	global $is_IE;
	if ($is_IE) {
		echo '<!--[if lt IE 9]>';
    	echo '<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>';
		echo '<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>';
    	echo '<![endif]-->';
	}
}
add_action('wp_head', 'add_ie_support');


/*-----------------------------------------------------------------------------------*/
/* Register sidebar(s)
/*-----------------------------------------------------------------------------------*/
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar 1',
		'before_widget' => '<section class="widget %2$s %1$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}


/*-----------------------------------------------------------------------------------*/
/* Helper functions
/*-----------------------------------------------------------------------------------*/

/* Check if more than one page exists on archive pages, if yes return TRUE to show pagination. */
function show_posts_nav() {
    global $wp_query;
    return ($wp_query->max_num_pages > 1);
}