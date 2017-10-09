<?php
/*
Plugin Name: WP TMDB Movies API
Plugin URI: http://tawfiq.me/plugins/wptmdbmoviesapi/
Description: Core framework for dailymoviez.org
Author: Tawfiqur Rahman
Version: 1.0.0
Author URI: http://tawfiq.me
*/


include_once('template.php');

// constants
define("POSTER_SM", "https://image.tmdb.org/t/p/w150/");
define("POSTER", "https://image.tmdb.org/t/p/w300/");
define("BACKDROP_PATH", "https://image.tmdb.org/t/p/w1000/");
define("YT_TRAILER", "https://www.youtube.com/embed/");

// Register Custom Post Type
function trwtma_movies_post_type() {

	$labels = array(
		'name'                  => _x( 'Movies', 'Post Type General Name', 'wptmdbmoviesapi' ),
		'singular_name'         => _x( 'Movie', 'Post Type Singular Name', 'wptmdbmoviesapi' ),
		'menu_name'             => __( 'Movies', 'wptmdbmoviesapi' ),
		'name_admin_bar'        => __( 'Movies', 'wptmdbmoviesapi' ),
		'archives'              => __( 'Movie Archives', 'wptmdbmoviesapi' ),
		'attributes'            => __( 'Movie Attributes', 'wptmdbmoviesapi' ),
		'parent_item_colon'     => __( 'Parent Movie:', 'wptmdbmoviesapi' ),
		'all_items'             => __( 'All Movies', 'wptmdbmoviesapi' ),
		'add_new_item'          => __( 'Add New Movie', 'wptmdbmoviesapi' ),
		'add_new'               => __( 'Add New Movie', 'wptmdbmoviesapi' ),
		'new_item'              => __( 'New Movie', 'wptmdbmoviesapi' ),
		'edit_item'             => __( 'Edit Movie', 'wptmdbmoviesapi' ),
		'update_item'           => __( 'Update Movie', 'wptmdbmoviesapi' ),
		'view_item'             => __( 'View Movie', 'wptmdbmoviesapi' ),
		'view_items'            => __( 'View Movies', 'wptmdbmoviesapi' ),
		'search_items'          => __( 'Search Movie', 'wptmdbmoviesapi' ),
		'not_found'             => __( 'Movie Not found', 'wptmdbmoviesapi' ),
		'not_found_in_trash'    => __( 'Movie Not found in Trash', 'wptmdbmoviesapi' ),
		'featured_image'        => __( 'Movie Poster', 'wptmdbmoviesapi' ),
		'set_featured_image'    => __( 'Set Movie Poster', 'wptmdbmoviesapi' ),
		'remove_featured_image' => __( 'Remove Movie Poster', 'wptmdbmoviesapi' ),
		'use_featured_image'    => __( 'Use as Movie Poster', 'wptmdbmoviesapi' ),
		'insert_into_item'      => __( 'Insert into Movie', 'wptmdbmoviesapi' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wptmdbmoviesapi' ),
		'items_list'            => __( 'Movies list', 'wptmdbmoviesapi' ),
		'items_list_navigation' => __( 'Movies list navigation', 'wptmdbmoviesapi' ),
		'filter_items_list'     => __( 'Filter Movies list', 'wptmdbmoviesapi' ),
	);
	$args = array(
		'label'                 => __( 'Movie', 'wptmdbmoviesapi' ),
		'description'           => __( 'movies custom post type', 'wptmdbmoviesapi' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-video-alt3',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'movies', $args );

}
add_action( 'init', 'trwtma_movies_post_type', 0 );

// Register single template for custom post type
add_filter('single_template','movies_single_template');
add_filter('archive_template','movies_archive_template');

//Movies single- template
function movies_single_template($single_template){
//   global $post;
  $found = locate_template('single-movies.php');
    $single_template = plugin_dir_path(__FILE__) . '/templates/single-movies.php';
    return $single_template;
}

//Movies archive- template
function movies_archive_template($template){
  if(is_post_type_archive('movies')){
    $theme_files = array('archive-movies.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return plugin_dir_path(__FILE__) . '/templates/archive-movies.php';
    }
  }
  return $template;
}

// Register Custom Taxonomy
function actors_texonomy() {
	
		$labels = array(
			'name'                       => _x( 'Actors', 'Taxonomy General Name', 'wptmdbmoviesapi' ),
			'singular_name'              => _x( 'Actor', 'Taxonomy Singular Name', 'wptmdbmoviesapi' ),
			'menu_name'                  => __( 'Actors', 'wptmdbmoviesapi' ),
			'all_items'                  => __( 'All Actors', 'wptmdbmoviesapi' ),
			'parent_item'                => __( 'Parent Actor', 'wptmdbmoviesapi' ),
			'parent_item_colon'          => __( 'Parent Item:', 'wptmdbmoviesapi' ),
			'new_item_name'              => __( 'New Actor Name', 'wptmdbmoviesapi' ),
			'add_new_item'               => __( 'Add New Actor', 'wptmdbmoviesapi' ),
			'edit_item'                  => __( 'Edit Actor', 'wptmdbmoviesapi' ),
			'update_item'                => __( 'Update Actor', 'wptmdbmoviesapi' ),
			'view_item'                  => __( 'View Actor', 'wptmdbmoviesapi' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'wptmdbmoviesapi' ),
			'add_or_remove_items'        => __( 'Add or remove Actor', 'wptmdbmoviesapi' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wptmdbmoviesapi' ),
			'popular_items'              => __( 'Popular Actors', 'wptmdbmoviesapi' ),
			'search_items'               => __( 'Search Actor', 'wptmdbmoviesapi' ),
			'not_found'                  => __( 'Actor Not Found', 'wptmdbmoviesapi' ),
			'no_terms'                   => __( 'No Actor', 'wptmdbmoviesapi' ),
			'items_list'                 => __( 'Actors list', 'wptmdbmoviesapi' ),
			'items_list_navigation'      => __( 'Actors list navigation', 'wptmdbmoviesapi' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'actors', array( 'movies' ), $args );
	
	}
	add_action( 'init', 'actors_texonomy', 0 );

	function genres_texonomy() {
		
			$labels = array(
				'name'                       => _x( 'Genres', 'Taxonomy General Name', 'wptmdbmoviesapi' ),
				'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'wptmdbmoviesapi' ),
				'menu_name'                  => __( 'Genres', 'wptmdbmoviesapi' ),
				'all_items'                  => __( 'All Genres', 'wptmdbmoviesapi' ),
				'parent_item'                => __( 'Parent Genre', 'wptmdbmoviesapi' ),
				'parent_item_colon'          => __( 'Parent Item:', 'wptmdbmoviesapi' ),
				'new_item_name'              => __( 'New Genre Name', 'wptmdbmoviesapi' ),
				'add_new_item'               => __( 'Add New Genre', 'wptmdbmoviesapi' ),
				'edit_item'                  => __( 'Edit Genre', 'wptmdbmoviesapi' ),
				'update_item'                => __( 'Update Genre', 'wptmdbmoviesapi' ),
				'view_item'                  => __( 'View Genre', 'wptmdbmoviesapi' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'wptmdbmoviesapi' ),
				'add_or_remove_items'        => __( 'Add or remove Genre', 'wptmdbmoviesapi' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'wptmdbmoviesapi' ),
				'popular_items'              => __( 'Popular Genres', 'wptmdbmoviesapi' ),
				'search_items'               => __( 'Search Genre', 'wptmdbmoviesapi' ),
				'not_found'                  => __( 'Genre Not Found', 'wptmdbmoviesapi' ),
				'no_terms'                   => __( 'No Genre', 'wptmdbmoviesapi' ),
				'items_list'                 => __( 'Genres list', 'wptmdbmoviesapi' ),
				'items_list_navigation'      => __( 'Genres list navigation', 'wptmdbmoviesapi' ),
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => false,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => false,
				'show_in_rest'               => true,
			);
			register_taxonomy( 'genres', array( 'movies' ), $args );
		
		}
		add_action( 'init', 'genres_texonomy', 0 );

/*
* Register Custom Meta Boxes
*/
$object_type = 'post';

// openload_link
$args_openload_link = array( 
    'type'         => 'string',
    'description'  => 'openload_link',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'openload_link', $args_openload_link );
// filefactory_link
$args_filefactory_link = array( 
    'type'         => 'string',
    'description'  => 'filefactory_link',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'filefactory_link', $args_filefactory_link );
// magnet_link
$args_magnet_link = array( 
    'type'         => 'string',
    'description'  => 'magnet_link',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'magnet_link', $args_magnet_link );
// original title
$args_org_title = array( 
    'type'         => 'string',
    'description'  => 'original title',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'org_title', $args_org_title );
// year
$args_year = array( 
    'type'         => 'string',
    'description'  => 'year',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'year', $args_year );
// imdb id
$args_imdb_id = array( 
    'type'         => 'string',
    'description'  => 'imdb id',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'imdb_id', $args_imdb_id );
// tmdb id 
$args_tmdb_id = array( 
    'type'         => 'string',
    'description'  => 'tmdb id',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'tmdb_id', $args_tmdb_id );
// language
$args_language = array( 
    'type'         => 'string',
    'description'  => 'language',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'language', $args_language );
// backdrop path
$args_backdrop_path = array( 
    'type'         => 'string',
    'description'  => 'backdrop path',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'backdrop_path', $args_backdrop_path );
// actors
$args_actors = array( 
    'type'         => 'string',
    'description'  => 'actors',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'actors', $args_actors );
// quality
$args_quality = array( 
    'type'         => 'string',
    'description'  => 'quality',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'quality', $args_quality );
// poster url
$args_poster_url = array( 
    'type'         => 'string',
    'description'  => 'poster url',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'poster_url', $args_poster_url );
// genres
$args_genres = array( 
    'type'         => 'string',
    'description'  => 'genres',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'genres', $args_genres );
// overviews
$args_overviews = array( 
    'type'         => 'string',
    'description'  => 'overviews',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'overviews', $args_overviews );
// release date
$args_release_date = array( 
    'type'         => 'string',
    'description'  => 'release date',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'release_date', $args_release_date );
// runtime
$args_runtime = array( 
    'type'         => 'string',
    'description'  => 'runtime',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'runtime', $args_runtime );
// country
$args_country = array( 
    'type'         => 'string',
    'description'  => 'country',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'country', $args_country );
// tagline
$args_tagline = array( 
    'type'         => 'string',
    'description'  => 'tagline',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'tagline', $args_tagline );
// youtube trailer 
$args_youtube_link = array( 
    'type'         => 'string',
    'description'  => '',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'youtube_link', $args_youtube_link );
// vote avarage
$args_vote_avarage = array( 
    'type'         => 'string',
    'description'  => 'vote avarage',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'vote_avarage', $args_vote_avarage );

/**
 * Setup JavaScript
 */
add_action( 'wp_enqueue_scripts', function() {

	//load script
	wp_enqueue_script( 'post-submitter', plugin_dir_url( __FILE__ ) . 'assets/post-submitter.js', array( 'jquery' ) );
	//load stylesheet
	wp_enqueue_style( 'wptmdbmoviesapistyle', plugin_dir_url(__FILE__).'assets/wptmdbmoviesapi.css', false, '');
	
	//localize data for script
	wp_localize_script( 'post-submitter', 'POST_SUBMITTER', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'success' => __( 'Thanks for your submission!', 'wptmdbmoviesapi' ),
			'failure' => __( 'Your submission could not be processed.', 'wptmdbmoviesapi' ),
			'current_user_id' => get_current_user_id()
		)
	);
});




