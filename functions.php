<?php

/**
 * Bootscore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bootscore
 * @version 5.3.3
 */


// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


/**
 * Load required files
 */
require_once('inc/theme-setup.php');             // Theme setup and custom theme supports
require_once('inc/breadcrumb.php');              // Breadcrumb
require_once('inc/columns.php');                 // Main/sidebar column width and breakpoints
require_once('inc/comments.php');                // Comments
require_once('inc/container.php');               // Container class
require_once('inc/enable-html.php');             // Enable HTML in category and author description
require_once('inc/enqueue.php');                 // Enqueue scripts and styles
require_once('inc/excerpt.php');                 // Adds excerpt to pages
require_once('inc/hooks.php');                   // Custom hooks
require_once('inc/loop.php');                    // Amount of items in the loop before page gets paginated (set to 24)
require_once('inc/pagination.php');              // Pagination for loop and single posts
require_once('inc/password-protected-form.php'); // Form if post or page is protected by password
require_once('inc/template-tags.php');           // Meta information like author, date, comments, category and tags badges
require_once('inc/template-functions.php');      // Functions which enhance the theme by hooking into WordPress
require_once('inc/widgets.php');                 // Register widget area and disables Gutenberg in widgets
require_once('inc/deprecated.php');              // Fallback functions being dropped in v6


/**
 * Load WooCommerce scripts if plugin is activated
 */
if (class_exists('WooCommerce')) {
  require get_template_directory() . '/woocommerce/wc-functions.php';
}


/**
 * Load Bootstrap 5 Nav Walker and registers menus 
 * Remove this snippet in v6 and add nav-walker to the enqueue list
 * https://github.com/orgs/bootscore/discussions/347
 */
if (!function_exists('register_navwalker')) :
  function register_navwalker() {
    require_once('inc/class-bootstrap-5-navwalker.php');
    // Register Menus
    register_nav_menu('main-menu', 'Main menu');
    register_nav_menu('footer-menu', 'Footer menu');
  }
endif;
add_action('after_setup_theme', 'register_navwalker');


/**
 * Load Jetpack compatibility file
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}


function add_scrollcue_scripts() {
	wp_enqueue_style( 'scrollcue-style', get_template_directory_uri() . '/css/scrollCue.css');
	// wp_enqueue_script( 'scrollcue-script', get_template_directory_uri() . '/js/scrollCue.js', array(), "", true );
	wp_enqueue_script( 'scrollcue-min-script', get_template_directory_uri() . '/js/scrollCue.min.js', array(), "", true );
	wp_enqueue_script( 'yg-scrollcue-script', get_template_directory_uri() . '/js/yg-scrollCue.js', array(), "", true );
}
add_action( 'wp_enqueue_scripts', 'add_scrollcue_scripts' );

function add_sticky_navbar() {
	wp_enqueue_script( 'headhesive-min-script', get_template_directory_uri() . '/js/headhesive.js', array(), "", true );
}
add_action( 'wp_enqueue_scripts', 'add_sticky_navbar' );

function add_isotope_script() {
  if( is_page( array( 'portfolios' ) ) ){
	  wp_enqueue_script( 'isotope-script', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), "3.0.6", true );
	  wp_enqueue_script( 'isotope-init-script', get_template_directory_uri() . '/js/jquery.init.js', array(), "3.0.6", true );
  }
}
add_action( 'wp_enqueue_scripts', 'add_isotope_script' );

function add_yg_theme() {
	wp_enqueue_script( 'yg-theme-script', get_template_directory_uri() . '/js/yg-theme.js', array(), "", true );
}

add_action( 'wp_enqueue_scripts', 'add_yg_theme' );

// custom post
add_action('init', function() {
	register_post_type('portfolio', [
		'label' => __('Portfolios', 'txtdomain'),
		'public' => true,
		'menu_position' => 5,
		'hierarchical' => false,
		'menu_icon' => 'dashicons-portfolio',
		'supports' => ['title', 'editor', 'thumbnail','custom-fields'],
		'show_in_rest' => true,
		'taxonomies' => ['portfolio_stack'],
		'rewrite' => ['slug' => 'portfolio'],
		'labels' => [
			'singular_name' => __('Book', 'txtdomain'),
			'add_new_item' => __('Add new portfolio', 'txtdomain'),
			'new_item' => __('New portfolio', 'txtdomain'),
			'view_item' => __('View portfolio', 'txtdomain'),
			'not_found' => __('No portfolios found', 'txtdomain'),
			'not_found_in_trash' => __('No portfolios found in trash', 'txtdomain'),
			'all_items' => __('All portfolios', 'txtdomain'),
			'insert_into_item' => __('Insert into portfolio', 'txtdomain')
		],		
	]);
 
	register_taxonomy('portfolio_stack', ['portfolio'], [
		'label' => __('Stacks', 'txtdomain'),
		'hierarchical' => true,
		'rewrite' => ['slug' => 'portfolio-genre'],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'labels' => [
			'singular_name' => __('Stack', 'txtdomain'),
			'all_items' => __('All Stacks', 'txtdomain'),
			'edit_item' => __('Edit Stack', 'txtdomain'),
			'view_item' => __('View Stack', 'txtdomain'),
			'update_item' => __('Update Stack', 'txtdomain'),
			'add_new_item' => __('Add New Stack', 'txtdomain'),
			'new_item_name' => __('New Stack Name', 'txtdomain'),
			'search_items' => __('Search Stacks', 'txtdomain'),
			'parent_item' => __('Parent Stack', 'txtdomain'),
			'parent_item_colon' => __('Parent Stack:', 'txtdomain'),
			'not_found' => __('No Stacks found', 'txtdomain'),
		]
	]);
	register_taxonomy_for_object_type('portfolio_stack', 'portfolio');
});

// // custom post
// add_action('init', function() {
// 	register_post_type('tour', [
// 		'label' => __('Tours', 'txtdomain'),
// 		'public' => true,
// 		'menu_position' => 5,
// 		'menu_icon' => 'dashicons-car',
// 		'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments'],
// 		'show_in_rest' => true,
// 		'rewrite' => ['slug' => 'tour'],
// 		'taxonomies' => ['portfolio_stack'],
// 		'labels' => [
// 			'singular_name' => __('Book', 'txtdomain'),
// 			'add_new_item' => __('Add new tour', 'txtdomain'),
// 			'new_item' => __('New tour', 'txtdomain'),
// 			'view_item' => __('View tour', 'txtdomain'),
// 			'not_found' => __('No tours found', 'txtdomain'),
// 			'not_found_in_trash' => __('No tours found in trash', 'txtdomain'),
// 			'all_items' => __('All tours', 'txtdomain'),
// 			'insert_into_item' => __('Insert into tour', 'txtdomain')
// 		],		
// 	]);
 
// 	register_taxonomy('portfolio_stack', ['tour'], [
// 		'label' => __('Packages', 'txtdomain'),
// 		'hierarchical' => true,
// 		'rewrite' => ['slug' => 'tour-genre'],
// 		'show_admin_column' => true,
// 		'show_in_rest' => true,
// 		'labels' => [
// 			'singular_name' => __('Package', 'txtdomain'),
// 			'all_items' => __('All Packages', 'txtdomain'),
// 			'edit_item' => __('Edit Package', 'txtdomain'),
// 			'view_item' => __('View Package', 'txtdomain'),
// 			'update_item' => __('Update Package', 'txtdomain'),
// 			'add_new_item' => __('Add New Package', 'txtdomain'),
// 			'new_item_name' => __('New Package Name', 'txtdomain'),
// 			'search_items' => __('Search Packages', 'txtdomain'),
// 			'parent_item' => __('Parent Package', 'txtdomain'),
// 			'parent_item_colon' => __('Parent Package:', 'txtdomain'),
// 			'not_found' => __('No Packages found', 'txtdomain'),
// 		]
// 	]);
// 	register_taxonomy_for_object_type('portfolio_stack', 'tour');
// });


function ygCleanCategoriesFilter($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
};