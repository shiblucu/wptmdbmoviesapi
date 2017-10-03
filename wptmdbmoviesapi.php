<?php
/*
Plugin Name: WP TMDB Movies API
Plugin URI: http://tawfiq.me/plugins/wptmdbmoviesapi/
Description: Core framework for dailymoviez.org
Author: Tawfiqur Rahman
Version: 1.0.0
Author URI: http://tawfiq.me
*/

/**
 * Output form on page "submit-post"
 */
add_filter( 'the_content', function( $content ) {
	if ( is_page( 'submit-post' ) ) {
		//only show to logged in users who can edit posts
		if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
			ob_start();?>
			<form id="post-submission-form">
				<div>
					<label for="post-submission-title">
						<?php _e( 'Title', 'wptmdbmoviesapi' ); ?>
					</label>
					<input type="text" name="post-submission-title" id="post-submission-title" required aria-required="true">
				</div>
				<div>
					<label for="post-submission-excerpt">
						<?php _e( 'Excerpt', 'wptmdbmoviesapi' ); ?>
					</label>
					<textarea rows="2" cols="20" name="post-submission-excerpt" id="post-submission-excerpt" required aria-required="true"></textarea>
				</div>
				<div>
					<label for="post-submission-content">
						<?php _e( 'Content', 'wptmdbmoviesapi' ); ?>
					</label>
					<textarea rows="10" cols="20" name="post-submission-content" id="post-submission-content"></textarea>
				</div>
				<div>
				<label for="post-submission-youtube-link">
					<?php _e( 'Youtube Trailer Link', 'wptmdbmoviesapi' ); ?>
				</label>
				<input type="text" name="post-submission-youtube-link" id="post-submission-youtube-link" required aria-required="true">
			</div>
				<input type="submit" value="<?php esc_attr_e( 'Submit', 'wptmdbmoviesapi'); ?>">
			</form>
			<?php
			$content .= ob_get_clean();
		}else{
			$content .=  sprintf( '<a href="%1s">%2s</a>', esc_url( wp_login_url() ), __( 'Click Here To Login', 'wptmdbmoviesapi' ) );
		}
	}

	return $content;
});

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

/*
* Register Custom Meta Boxes
*/
$object_type = 'post';
$args = array( 
    'type'         => 'string',
    'description'  => 'Youtube Trailer Link',
    'single'       => true,
    'show_in_rest' => true,
);
register_meta( $object_type, 'youtube_link', $args );

/**
 * Setup JavaScript
 */
add_action( 'wp_enqueue_scripts', function() {

	//load script
	wp_enqueue_script( 'my-post-submitter', plugin_dir_url( __FILE__ ) . 'post-submitter.js', array( 'jquery' ) );

	//localize data for script
	wp_localize_script( 'my-post-submitter', 'POST_SUBMITTER', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'success' => __( 'Thanks for your submission!', 'wptmdbmoviesapi' ),
			'failure' => __( 'Your submission could not be processed.', 'wptmdbmoviesapi' ),
			'current_user_id' => get_current_user_id()
		)
	);
	

});
