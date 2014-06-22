<?php

// REGISTER MENU
function register_my_menus() {
  register_nav_menus(
    array('header-menu' => __( 'Header Menu' ) )
  );
}

add_theme_support( 'menus' );
add_action( 'init', 'register_my_menus' );

// REGISTER SIDEBAR
if ( function_exists('register_sidebar') )
    register_sidebar();


// SET CONTENT WIDTH
if ( ! isset( $content_width ) )
	$content_width = 540;

// ENABLE THUMBNAILS
add_theme_support( 'post-thumbnails' );

// SIZES
	add_image_size('header', 960, 208, true);
	add_image_size('post-thumbnail-big', 530, 265, true);
	
// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	
// Load some sh*t
	if ( !is_admin() ) {
//				wp_register_script('addons_script', 'http://cdn.jquerytools.org/1.2.5/all/jquery.tools.min.js', array('jquery'), '');
//	        	wp_register_script('addons_script', 'http://dev.circumstances.hu/wp-content/themes/litracon/js/jquery.scrollTo-min.js', array('jquery'), '');

//	        	wp_enqueue_script('addons_script');
	}

// MULTIPLE POST thumbnails
	
	if (class_exists('MultiPostThumbnails')) {
		$types = array('post', 'page');
		foreach($types as $type) {
			$thumb = new MultiPostThumbnails(array(
				'label' => 'Fejléc',
				'id' => 'header',
				'post_type' => $type
				)
			);
		}
	}


// PRODUCT POST TYPE REGISTER	
//add_action( 'init', 'create_product_post_type' );
//function create_product_post_type() {
		
	// Register PRODUCT post type
//	register_post_type( 'collegue',
//			array(
//				'labels' => array(
//					'name' => __( 'Collegues' ),
//					'singular_name' => __( 'Collegue' )
//				),
//			'public' => true,
//	        'show_ui' => true,  
//	        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')  ,
//	        'hierarchical' => true,  
//			'has_archive' => true
//			)
//	);
//}

//function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
//    create_product_post_type();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
//    flush_rewrite_rules();
//}

//register_activation_hook( __FILE__, 'my_rewrite_flush' );