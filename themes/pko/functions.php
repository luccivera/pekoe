<?php
/**
 * pekoe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pekoe
 */

if ( ! defined( 'PKO_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'PKO_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pko_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on pekoe, use a find and replace
		* to change 'pko' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pko', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Custom Image Size
	add_image_size( 'pko-image-size', 800, 640 );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-primary' => esc_html__( 'Primary', 'pko' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'pko' ),
		)
	);


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
			

}
add_action( 'after_setup_theme', 'pko_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pko_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pko_content_width', 640 );
}
add_theme_support( 'wp-block-styles' );

add_action( 'after_setup_theme', 'pko_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pko_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pko' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'pko' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pko_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pko_scripts() {
	wp_enqueue_style( 
		'pko-style', 
		get_stylesheet_uri(), 
		array(),
		PKO_VERSION );

		wp_enqueue_style( 
			'typekit', 'https://use.typekit.net/jrk3viq.css', false );

		wp_enqueue_style( 
			'pko-style-css', 
				get_template_directory_uri() . '/assets/css/app.css');


	// wp_enqueue_script( 
	// 	'what-input-script', 
	// 	get_template_directory_uri() . '/assets/js/vendor/what-input.js',
	// 	 array('jquery'),
	// 	  false, 
	// 	  true);

	// wp_enqueue_script( 
	// 	'foundation-script', 
	// 	get_template_directory_uri() . '/assets/js/vendor/foundation.min.js', 
	// 	array('jquery', 
	// 	'what-input-script'), 
	// 	false, 
	// 	true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pko_scripts' );

if (! function_exists('fa_custom_setup_kit') ) {
	function fa_custom_setup_kit($kit_url = '') {
	  foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
		add_action(
		  $action,
		  function () use ( $kit_url ) {
			wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
		  }
		);
	  }
	}
  }
  fa_custom_setup_kit('https://kit.fontawesome.com/A0D25EDE-5E6E-434E-AFE9-05A687CE3EDC');
  
/**
 * Font Awesome CDN Setup SVG
 * 
 * This will load Font Awesome 6 from the Font Awesome Free CDN.
 */
if (! function_exists('fa_custom_setup_cdn_svg') ) {
	function fa_custom_setup_cdn_svg($cdn_url = '', $integrity = null) {
	  $matches = [];
	  $match_result = preg_match('|/([^/]+?)\.js$|', $cdn_url, $matches);
	  $resource_handle_uniqueness = ($match_result === 1) ? $matches[1] : md5($cdn_url);
	  $resource_handle = "font-awesome-cdn-svg-$resource_handle_uniqueness";
  
	  foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
		add_action(
		  $action,
		  function () use ( $cdn_url, $resource_handle ) {
			wp_enqueue_script( $resource_handle, $cdn_url, [], null );
		  }
		);
	  }
  
	  if($integrity) {
		add_filter(
		  'script_loader_tag',
		  function( $html, $handle ) use ( $resource_handle, $integrity ) {
			if ( in_array( $handle, [ $resource_handle ], true ) ) {
			  return preg_replace(
				'/^<script /',
				'<script integrity="' . $integrity .
				'" defer crossorigin="anonymous"',
				$html,
				1
			  );
			} else {
			  return $html;
			}
		  },
		  10,
		  2
		);
	  }
	}
  }
  fa_custom_setup_cdn_svg(
	'https://use.fontawesome.com/releases/v6.0.0/js/all.js',
	'sha384-l+HksIGR+lyuyBo1+1zCBSRt6v4yklWu7RbG0Cv+jDLDD9WFcEIwZLHioVB4Wkau'
  );


  // Enable Gutenberg in WooCommerce
function activate_gutenberg_product( $can_edit, $post_type ) {

    if ( $post_type == 'product' ) {
        $can_edit = true;
    }
    return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );

//  Shorten Excerpt length
add_filter( 'excerpt_length', function($length) {
    return 20;
}, PHP_INT_MAX );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block-editor.
 */
require get_template_directory() . '/inc/block-editor.php';

/**
 * Custom Post Type
 */
require get_template_directory() . '/inc/post-type.php';

/* Custom Post Type Start */

function pko_teas_register_post_type() {
	$args = [
		'label'  => esc_html__( 'Teas', 'pko' ),
		'labels' => [
			'menu_name'          => esc_html__( 'Teas', 'pko' ),
			'name_admin_bar'     => esc_html__( 'Tea', 'pko' ),
			'add_new'            => esc_html__( 'Add Tea', 'pko' ),
			'add_new_item'       => esc_html__( 'Add new Tea', 'pko' ),
			'new_item'           => esc_html__( 'New Tea', 'pko' ),
			'edit_item'          => esc_html__( 'Edit Tea', 'pko' ),
			'view_item'          => esc_html__( 'View Tea', 'pko' ),
			'update_item'        => esc_html__( 'View Tea', 'pko' ),
			'all_items'          => esc_html__( 'All Teas', 'pko' ),
			'search_items'       => esc_html__( 'Search Teas', 'pko' ),
			'parent_item_colon'  => esc_html__( 'Parent Tea', 'pko' ),
			'not_found'          => esc_html__( 'No Teas found', 'pko' ),
			'not_found_in_trash' => esc_html__( 'No Teas found in Trash', 'pko' ),
			'name'               => esc_html__( 'Teas', 'pko' ),
			'singular_name'      => esc_html__( 'Tea', 'pko' ),
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'taxonomies' => [
			'category',
			'tag',
		],
		'rewrite' => true
	];

	register_post_type( 'tea', $args );
}
add_action( 'init', 'pko_teas_register_post_type' );
	/* Custom Post Type End */