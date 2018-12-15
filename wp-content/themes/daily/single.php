<?php get_header(); ?>

	<section id="primary" class="content-area column">
		<main id="main" class="site-main column" role="main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php daily_post_author(); ?>

				<?php daily_social_share(); ?>

				<?php daily_newsletter_form(); ?> 

				<div class="clearfix"></div>

				<?php daily_related_posts() // Related posts. ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

	<?php get_sidebar( 'secondary' ); ?>

	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>