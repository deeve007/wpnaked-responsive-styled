<?php
/**
 * WPnaked functions and definitions
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package		WordPress
 * @subpackage	WPnaked Responsive
 * @since		WPnaked Responsive 1.1
 */
 

/*-----------------------------------------------------------------------------------*/
/* Some basic Wordpress stuff
/*-----------------------------------------------------------------------------------*/
// Add RSS to Head
add_theme_support( 'automatic-feed-links' );

// Remove ugly Wordpress toolbar from frontend
add_filter('show_admin_bar', '__return_false');

// Add main menu
register_nav_menus(array('primary' => 'Primary Navigation'));
	
// Add thumbnail support & then image sizes for use in theme
add_theme_support('post-thumbnails');
add_image_size( 'post-main', 960, 540, true ); // main image for posts and pages

// Set max content width
if ( ! isset( $content_width ) )
	$content_width = 1200;
	
// Don't add the wp-includes/js/comment-reply.js script to single post pages unless threaded comments are enabled
// adapted from http://bigredtin.com/behind-the-websites/including-wordpress-comment-reply-js/
function comments_js(){
  if (!is_admin()){
    if (is_singular() && (get_option('thread_comments') == 1) && comments_open() && have_comments())
      wp_enqueue_script('comment-reply');
  }
}
add_action('wp_print_scripts', 'comments_js');


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles, Scripts & Fonts
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
	wp_enqueue_style( 'load-reset', '//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css','', 'screen' );
	// if you would prefer to use a total reset rather than normalize simply comment out the above line and uncomment the line below
	// wp_enqueue_style( 'load-reset', '//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css','', 'screen' );
	
	// Let's have some superfish menu action
	wp_enqueue_style( 'superfish-css', '//cdnjs.cloudflare.com/ajax/libs/superfish/1.7.4/superfish.min.css','', 'screen' );
	wp_enqueue_script( 'superfish1-js', '//cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/2013.03.11/hoverintent.min.js', array( 'jquery' ),null,true );
	wp_enqueue_script( 'superfish2-js', '//cdnjs.cloudflare.com/ajax/libs/superfish/1.7.4/superfish.min.js', array( 'superfish1-js' ),null,true );
	// And mobile superfish
	wp_enqueue_style( 'superfish-mobile-css', get_template_directory_uri() . '/css/superfish-mobile.css','', 'screen' );
	wp_enqueue_script( 'superfish-mobile-js', get_template_directory_uri() . '/js/superfish-mobile.js', array( 'superfish2-js' ),null,true );
	
	// Let's add some nice web fonts for style - comment out or delete if you don't want to use these fonts
	wp_enqueue_style( 'open-sans', 'http://fonts.googleapis.com/css?family=PT+Serif' );
	
	// load theme stylesheets
	wp_enqueue_style( 'load-grid', get_template_directory_uri() . '/css/grid.css', array( 'load-reset' ), 'screen' );
	wp_enqueue_style( 'load-style', get_template_directory_uri() . '/style.css', array( 'load-reset' ), 'screen' );
	
	// add support for child themes without needing to manually import parent theme style.css via @import
	// add after parent theme css so it can override settings if required
	if ( get_stylesheet_directory_uri() != get_template_directory_uri() ) {
		wp_register_style( 'child-css', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
		wp_enqueue_style( 'child-css' );
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
    	echo '<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>';
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

/* Better page titles: http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html */
add_filter( 'wp_title', 'rw_title', 10, 3 );
function rw_title( $title, $sep, $seplocation )
{
    global $page, $paged;
    // Don't affect in feeds.
    if ( is_feed() )
        return $title;
    // Add the blog name
    if ( 'right' == $seplocation )
        $title .= get_bloginfo( 'name' );
    else
        $title = get_bloginfo( 'name' ) . $title;
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " {$sep} {$site_description}";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
    return $title;
}

// remove WP version from displaying
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 ); // remove from css
add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 ); // remove from scripts
remove_action( 'wp_head', 'wp_generator' ); // remove from head
// remove from RSS
function remove_wp_version_rss() { return''; }
add_filter('the_generator','remove_wp_version_rss');