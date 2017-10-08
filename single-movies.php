<?php
/**
 * The template for displaying Movies single posts.
 *
 */

get_header();
// $container   = get_theme_mod( 'understrap_container_type' );
// $sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper container" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                    <header class="entry-header">
                        
                    </header><!-- .entry-header -->

                    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

                    <div class="entry-content">
                        
                        <?php if ( 'movies' == get_post_type() ) : ?>
                            <div class="entry-meta row">
                                <div class="col-3">
                                    <img src="<?php echo $post->poster_url; ?>" alt="">
                                </div>
                                <div class="col-9">
                                    <h1 class="entry-title">
                                        <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a> 
                                        <span class="badge badge-secondary"><?php echo $post->year; ?></span> 
                                        <span class="badge badge-warning"><?php echo $post->quality; ?></span> 
                                    </h1>
                                    <hr>
                                    <div>
                                        <a href="<?php echo $post->youtube_link; ?>" target="_blank" class="btn btn-info">Trailer</a>
                                        <a href="<?php echo $post->filefactory_link; ?>" target="_blank" class="btn btn-info">Download (Filefactory)</a>
                                        <a href="<?php echo $post->magnet_link; ?>" target="_blank" class="btn btn-info">Download (Torrent)</a>
                                    </div>
                                    <hr>
                                    <p><?php echo $post->overviews; ?></p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul>
                                                <li>Original Title: <?php echo $post->org_title; ?></li>
                                                <li>Genre: <?php echo $post->genres; ?></li>
                                                <li>Actors: <?php echo $post->actors; ?></li>
                                                <li>Director: <?php echo $post->director; ?> </li>
                                                <li>Country: <?php echo $post->country; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul>
                                                <li>Release Date: <?php echo $post->release_date; ?></li>
                                                <li>Runtime: <?php echo $post->runtime; ?></li>
                                                <li>Tagline: <?php echo $post->tagline; ?></li>
                                                <li>Vote: <?php echo $post->vote_avarage; ?></li>
                                                <li>Language: <?php echo $post->language; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php /*
                                    echo 'Org Title : '.  $post->org_title.'</br>';    
                                    echo 'year : '.  $post->year.'</br>';
                                    echo 'imdb_id : '.  $post->imdb_id.'</br>';
                                    echo 'tmdb_id : '.  $post->tmdb_id.'</br>';
                                    echo 'language : '.  $post->language.'</br>';
                                    echo 'backdrop_path : '.  $post->backdrop_path.'</br>';
                                    echo 'actors : '.  $post->actors.'</br>';
                                    echo 'quality : '.  $post->quality.'</br>';
                                    echo 'poster_url : '.  $post->poster_url.'</br>';
                                    echo 'genres : '.  $post->genres.'</br>';
                                    echo 'overviews : '.  $post->overviews.'</br>';
                                    echo 'release_date : '.  $post->release_date.'</br>'; 
                                    echo 'runtime : '.  $post->runtime.'</br>';
                                    echo 'country : '.  $post->country.'</br>';
                                    echo 'tagline : '.  $post->tagline.'</br>';
                                    echo 'youtube_link : '.  $post->youtube_link.'</br>';
                                    echo 'vote_avarage : '.  $post->vote_avarage.'</br>'; 
                                    */ ?>
                                </div>
                                
                            </div><!-- .entry-meta -->
                            <!-- Watch Movie Online section -->
                            <div class="watch-online">
                                <?php 
                                // if need to check a field is empty or not then use get_field not the_field
                                if ( ! empty ($post->openload_link)) : ?>
                                    <div class="watch-online">
                                        <h2>Watch <?php echo get_the_title(); ?> Online</h2>
                                        <p><em>The video keeps buffering? Just pause it for 5-10 minutes then continue playing! In case of any issue, please switch version</em></p>
                                        <div class="col-md-20 col-sm-20 col-xs-20 col-xs-offset-2 embed-responsive embed-responsive-16by9 text-center">
                                            <iframe class="embed-responsive-item" src="<?php echo $post->openload_link;?>" allowfullscreen="true" name="watch-online-frame" id="watch-online-frame"></iframe>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div style="clear:both"></div>
                            <hr>
                        </div>
                        <!-- Search Term section -->
                        <div class="serach-term">
                            <h3 class="wpmoly headbox imdb movie meta sub-title"><?php _e('Search Terms: ','wpmovielibrary' ) ?></h3>
                            <p><?php echo get_the_title(); ?> , <?php echo get_the_title(); ?> full movie, watch <?php echo get_the_title(); ?> online, watch <?php echo get_the_title(); ?> online hd, <?php echo get_the_title(); ?> watch online, <?php echo get_the_title(); ?> download free, download <?php echo get_the_title(); ?> free, <?php echo get_the_title(); ?> streaming, <?php echo get_the_title(); ?> streaming online, <?php echo get_the_title(); ?> <?php echo $post->year; ?> full movie, watch <?php echo get_the_title(); ?> <?php echo $post->year; ?> online, watch <?php echo get_the_title(); ?> <?php echo $post->year; ?> online hd, <?php echo get_the_title(); ?> <?php echo $post->year; ?> watch online, <?php echo get_the_title(); ?> <?php echo $post->year; ?> download free, download <?php echo get_the_title(); ?> <?php echo $post->year; ?> free, <?php echo get_the_title(); ?> <?php echo $post->year; ?> streaming, <?php echo get_the_title(); ?> <?php echo $post->year; ?> streaming online </p>
                        </div>

                        <?php endif; ?>
                        <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
                            'after'  => '</div>',
                        ) );
                        ?>

                    </div><!-- .entry-content -->

                    <footer class="entry-footer">

                        <?php understrap_entry_footer(); ?>

                    </footer><!-- .entry-footer -->

                </article><!-- #post-## -->

						<?php understrap_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
