<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>

		<div class="entry-meta">
			<?php daily_posted_on(); ?> 
			<span class="meta-sep">|</span> 
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'daily' ), __( '1 Comment', 'daily' ), __( '% Comments', 'daily' ) ); ?></span>
				<?php endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php  if( has_post_format( 'video' )) { ?>
	<?php } else { ?>
		<?php if ( of_get_option( 'daily_featured_image', 'on' ) == 'on' ) { ?>
			<?php the_post_thumbnail( 'daily-blog-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
			<div class="clearfix"></div>
		<?php } ?>
	<?php } ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'daily' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'daily' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'daily' ) );

			if ( ! daily_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
			$meta_text = __( '<strong>Tags:</strong> %2$s', 'daily' );
				
			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="entry-cats"><strong>Filed in:</strong> %1$s</span> <span class="entry-tags"><strong>Tags:</strong> %2$s</span>', 'daily' );
				} else {
					$meta_text = __( '<span class="entry-cats"><strong>Filed in:</strong> %1$s</span>', 'daily' );
				}
			} // end check for categories on this blog
			
			printf(
				$meta_text,
				$category_list,
				$tag_list
			);
		?>

	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->