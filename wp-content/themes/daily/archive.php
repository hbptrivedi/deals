<?php get_header(); ?>

	<?php $layout = of_get_option( 'daily_archive_layout', 'standard' ); ?>

	<section id="primary" class="content-area column">
		
		<?php if ( of_get_option( 'daily_archive_ads' ) ) : ?>
			<div class="archive-ad">
				<?php echo stripslashes( of_get_option( 'daily_archive_ads' ) ); ?>
			</div>
		<?php endif; ?>
				
		<main id="main" class="content-loop category-box <?php echo esc_attr( daily_archive_page_classes() ); ?> column" role="main" <?php hybrid_attr( 'content' ); ?>>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h3 class="widget-title"><strong>
				<?php
					if ( is_category() ) :
						single_cat_title( __( 'Category: ', 'daily' ) );

					elseif ( is_tag() ) :
						single_tag_title( __( 'Tags: ', 'daily' ) );

					elseif ( is_author() ) :
						printf( __( 'Author: %s', 'daily' ), '<span class="vcard">' . get_the_author() . '</span>' );

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'daily' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'daily' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'daily' ) ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'daily' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'daily' ) ) . '</span>' );

					elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
						_e( 'Galleries', 'daily');

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', 'daily');

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', 'daily' );

					elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
						_e( 'Audios', 'daily' );

					else :
						_e( 'Archives', 'daily' );

					endif;
				?>
			</strong></h3>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php if ( 'standard' === $layout ) : ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php elseif ( 'classic' === $layout ) : ?>
					<?php get_template_part( 'content', 'classic' ); ?>
				<?php elseif ( 'grid' === $layout ) : ?>
					<?php get_template_part( 'content', 'grid' ); ?>
				<?php endif; ?>

				<?php endwhile; ?>
				
				<div class="clearfix"></div>
				
				<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->

	<?php get_sidebar( 'secondary' ); ?>

	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>