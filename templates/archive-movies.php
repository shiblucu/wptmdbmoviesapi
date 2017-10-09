<?php
/**
 * The template for displaying Movies archive page.
 */

get_header();
?>

<div class="wrapper container" id="movies-archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						// the_archive_title( '<h1 class="page-title">', '</h1>' );
						// the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
                    <div class="row">
					<?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>"  class="card-group" style="width: 9rem;" data-toggle="popover" title="<?php echo $post->year; ?> <?php echo $post->vote_avarage; ?>" data-html="true" data-template='<div class="popover"><div class="popover-arrow"></div><h2 class="popover-title"><?php echo get_the_title(); ?></h2><div class="popover-content"><span class="badge badge-secondary"><?php echo $post->year; ?></span> <span class="badge badge-warning"><?php echo $post->quality; ?></span> <span class="badge badge-warning"><?php echo $post->vote_avarage; ?></span></div></div>' data-trigger="hover">
                        <div class="card card-primary mb-3 text-center" >
                            <img class="card-img img-responsive rounded" src="<?php echo POSTER_SM.$post->poster_url; ?>" alt="<?php echo get_the_title();?> movies Poster">
                            <div class="card-img-overlay" >
                                <h2 class="card-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
							</div>
                        </div>
					</article><!-- #post-## -->   
					    
					<?php endwhile; ?>
                    </div>
				<?php else : ?>

					<?php // get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
